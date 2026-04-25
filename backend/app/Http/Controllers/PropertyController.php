<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\BlueprintField;
use App\Models\BlueprintMediaSlot;
use App\Models\Property;
use App\Models\PropertyFieldValue;
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

        $properties = $query->latest()->paginate(12);

        return PropertyResource::collection($properties);
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
