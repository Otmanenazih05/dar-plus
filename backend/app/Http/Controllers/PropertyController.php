<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\BlueprintField;
use App\Models\BlueprintMediaSlot;
use App\Models\Property;
use App\Models\PropertyFieldValue;
use App\Models\SavedProperty;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    private function calculateScore(Property $property): int
    {
        $categoryId = $property->category_id;

        $requiredFields = BlueprintField::where('category_id', $categoryId)
            ->where('is_required', true)
            ->pluck('id');

        $requiredSlots = BlueprintMediaSlot::where('category_id', $categoryId)
            ->where('is_required', true)
            ->pluck('id');

        $totalRequired = $requiredFields->count() + $requiredSlots->count();

        if ($totalRequired === 0) {
            return 100;
        }

        $filledFields = PropertyFieldValue::where('property_id', $property->id)
            ->whereIn('blueprint_field_id', $requiredFields)
            ->whereNotNull('value')
            ->where('value', '!=', '')
            ->count();

        $uploadedSlots = $property->media()
            ->whereIn('blueprint_media_slot_id', $requiredSlots)
            ->count();

        $filled = $filledFields + $uploadedSlots;

        return (int) min(100, round(($filled / $totalRequired) * 100));
    }

    public function index(Request $request)
    {
        $query = Property::where('status', 'published')
            ->with(['category', 'user', 'coverMedia']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $this->applySorting($query, $request->sort_by);

        $properties = $query->paginate(12);

        return PropertyResource::collection($properties);
    }

    public function search(Request $request)
    {
        $query = Property::where('status', 'published')
            ->with(['category', 'user', 'coverMedia']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhere('city', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_size')) {
            $query->whereHas('fieldValues', function ($q) use ($request) {
                $q->whereHas('blueprintField', fn($bf) => $bf->where('field_key', 'surface_area'))
                  ->where('value', '>=', $request->min_size);
            });
        }

        if ($request->filled('max_size')) {
            $query->whereHas('fieldValues', function ($q) use ($request) {
                $q->whereHas('blueprintField', fn($bf) => $bf->where('field_key', 'surface_area'))
                  ->where('value', '<=', $request->max_size);
            });
        }

        if ($request->filled('rooms_count')) {
            $query->whereHas('fieldValues', function ($q) use ($request) {
                $q->whereHas('blueprintField', fn($bf) => $bf->where('field_key', 'rooms_count'))
                  ->where('value', $request->rooms_count);
            });
        }

        if ($request->filled('min_completion_score')) {
            $query->where('completion_score', '>=', $request->min_completion_score);
        }

        $this->applySorting($query, $request->sort_by);

        $properties = $query->paginate(12);

        return PropertyResource::collection($properties);
    }

    private function applySorting($query, ?string $sortBy): void
    {
        match ($sortBy) {
            'price_asc'   => $query->orderBy('price', 'asc'),
            'price_desc'  => $query->orderBy('price', 'desc'),
            'most_viewed' => $query->orderBy('views_count', 'desc'),
            default       => $query->latest(),
        };
    }

    public function show($id)
    {
        $property = Property::where('id', $id)
            ->where('status', 'published')
            ->with(['category', 'user', 'media.slot', 'fieldValues.blueprintField', 'coverMedia'])
            ->firstOrFail();

        $property->increment('views_count');

        return new PropertyResource($property);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'seller') {
            return response()->json(['message' => 'Only sellers can create listings.'], 403);
        }

        $data = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:200',
            'description'  => 'nullable|string',
            'price'        => 'nullable|integer|min:0',
            'city'         => 'nullable|string|max:100',
            'address'      => 'nullable|string',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'field_values' => 'nullable|array',
        ]);

        $property = DB::transaction(function () use ($request, $data) {
            $property = Property::create([
                'user_id'     => $request->user()->id,
                'category_id' => $data['category_id'],
                'title'       => $data['title'],
                'description' => $data['description'] ?? null,
                'price'       => $data['price'] ?? null,
                'city'        => $data['city'] ?? null,
                'address'     => $data['address'] ?? null,
                'latitude'    => $data['latitude'] ?? null,
                'longitude'   => $data['longitude'] ?? null,
                'status'      => 'draft',
            ]);

            if (!empty($data['field_values'])) {
                foreach ($data['field_values'] as $fieldId => $value) {
                    $field = BlueprintField::where('id', $fieldId)
                        ->where('category_id', $property->category_id)
                        ->first();

                    if ($field) {
                        PropertyFieldValue::updateOrCreate(
                            ['property_id' => $property->id, 'blueprint_field_id' => $field->id],
                            ['value' => $value]
                        );
                    }
                }
            }

            $score = $this->calculateScore($property);
            $property->update(['completion_score' => $score]);

            return $property;
        });

        $property->load(['category', 'user', 'fieldValues.blueprintField', 'coverMedia']);

        return new PropertyResource($property);
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $data = $request->validate([
            'title'        => 'sometimes|string|max:200',
            'description'  => 'sometimes|nullable|string',
            'price'        => 'sometimes|nullable|integer|min:0',
            'city'         => 'sometimes|nullable|string|max:100',
            'address'      => 'sometimes|nullable|string',
            'latitude'     => 'sometimes|nullable|numeric',
            'longitude'    => 'sometimes|nullable|numeric',
            'field_values' => 'sometimes|array',
        ]);

        $oldPrice = $property->price;

        DB::transaction(function () use ($property, $data) {
            $property->update($data);

            if (!empty($data['field_values'])) {
                foreach ($data['field_values'] as $fieldId => $value) {
                    $field = BlueprintField::where('id', $fieldId)
                        ->where('category_id', $property->category_id)
                        ->first();

                    if ($field) {
                        PropertyFieldValue::updateOrCreate(
                            ['property_id' => $property->id, 'blueprint_field_id' => $field->id],
                            ['value' => $value]
                        );
                    }
                }
            }

            $score = $this->calculateScore($property);
            $property->update(['completion_score' => $score]);
        });

        if (isset($data['price']) && $data['price'] !== $oldPrice) {
            $saverIds = SavedProperty::where('property_id', $property->id)->pluck('user_id');
            $service  = new NotificationService();

            foreach ($saverIds as $userId) {
                $service->priceChanged($userId, [
                    'property_title' => $property->title,
                    'property_id'    => $property->id,
                    'old_price'      => $oldPrice,
                    'new_price'      => $data['price'],
                ]);
            }
        }

        $property->load(['category', 'user', 'fieldValues.blueprintField', 'coverMedia']);

        return new PropertyResource($property);
    }

    public function destroy(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $property->delete();

        return response()->json(['message' => 'Listing deleted.']);
    }

    public function publish(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($property->completion_score < 80) {
            return response()->json([
                'message'          => 'Listing must be at least 80% complete to publish.',
                'completion_score' => $property->completion_score,
            ], 422);
        }

        $property->update(['status' => 'published']);

        (new NotificationService())->listingPublished($property->user_id, [
            'property_title' => $property->title,
            'property_id'    => $property->id,
        ]);

        return new PropertyResource($property);
    }

    public function markAsSold(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $property->update(['status' => 'sold']);

        return new PropertyResource($property);
    }

    public function toggleArchive(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $newStatus = $property->status === 'archived' ? 'draft' : 'archived';
        $property->update(['status' => $newStatus]);

        return new PropertyResource($property);
    }
}
