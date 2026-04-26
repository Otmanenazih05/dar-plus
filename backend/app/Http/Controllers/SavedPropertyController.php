<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\SavedProperty;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class SavedPropertyController extends Controller
{
    public function index(Request $request)
    {
        $savedIds = SavedProperty::where('user_id', $request->user()->id)
            ->latest('created_at')
            ->pluck('property_id');

        $properties = Property::whereIn('id', $savedIds)
            ->with(['category', 'user', 'coverMedia'])
            ->get()
            ->sortBy(fn($p) => $savedIds->search($p->id))
            ->values();

        return PropertyResource::collection($properties);
    }

    public function toggle(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $existing = SavedProperty::where('user_id', $request->user()->id)
            ->where('property_id', $property->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['saved' => false]);
        }

        SavedProperty::create([
            'user_id'     => $request->user()->id,
            'property_id' => $property->id,
        ]);

        if ($property->user_id !== $request->user()->id) {
            (new NotificationService())->listingSaved($property->user_id, [
                'buyer_name'     => $request->user()->name,
                'buyer_id'       => $request->user()->id,
                'property_title' => $property->title,
                'property_id'    => $property->id,
            ]);
        }

        return response()->json(['saved' => true]);
    }

    public function check(Request $request, $propertyId)
    {
        $saved = SavedProperty::where('user_id', $request->user()->id)
            ->where('property_id', $propertyId)
            ->exists();

        return response()->json(['saved' => $saved]);
    }
}
