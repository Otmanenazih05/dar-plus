<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyMediaResource;
use App\Models\BlueprintMediaSlot;
use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyMediaController extends Controller
{
    public function upload(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $request->validate([
            'slot_id'   => 'required|exists:blueprint_media_slots,id',
            'file'      => 'required|file|max:51200|mimes:jpeg,png,jpg,webp,mp4,mov,avi',
            'is_cover'  => 'sometimes|boolean',
        ]);

        $slot = BlueprintMediaSlot::where('id', $request->slot_id)
            ->where('category_id', $property->category_id)
            ->firstOrFail();

        $existingCount = PropertyMedia::where('property_id', $property->id)
            ->where('blueprint_media_slot_id', $slot->id)
            ->count();

        if ($existingCount >= $slot->max_count) {
            return response()->json([
                'message' => "This slot allows a maximum of {$slot->max_count} file(s).",
            ], 422);
        }

        $file     = $request->file('file');
        $fileType = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';
        $path     = $file->store("properties/{$propertyId}", 'public');

        if ($request->boolean('is_cover') && $fileType === 'image') {
            PropertyMedia::where('property_id', $property->id)
                ->where('is_cover', true)
                ->update(['is_cover' => false]);
        }

        $media = PropertyMedia::create([
            'property_id'            => $property->id,
            'blueprint_media_slot_id'=> $slot->id,
            'file_path'              => $path,
            'file_type'              => $fileType,
            'is_cover'               => $request->boolean('is_cover') && $fileType === 'image',
        ]);

        $this->refreshScore($property);

        $media->load('slot');

        return new PropertyMediaResource($media);
    }

    public function delete(Request $request, $propertyId, $mediaId)
    {
        $property = Property::findOrFail($propertyId);

        if ($property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $media = PropertyMedia::where('id', $mediaId)
            ->where('property_id', $property->id)
            ->firstOrFail();

        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        $this->refreshScore($property);

        return response()->json(['message' => 'Media deleted.']);
    }

    private function refreshScore(Property $property): void
    {
        $requiredFieldIds = $property->category->blueprintFields()
            ->where('is_required', true)
            ->pluck('id');

        $requiredSlotIds = $property->category->blueprintMediaSlots()
            ->where('is_required', true)
            ->pluck('id');

        $totalRequired = $requiredFieldIds->count() + $requiredSlotIds->count();

        if ($totalRequired === 0) {
            $property->update(['completion_score' => 100]);
            return;
        }

        $filledFields = $property->fieldValues()
            ->whereIn('blueprint_field_id', $requiredFieldIds)
            ->whereNotNull('value')
            ->where('value', '!=', '')
            ->count();

        $uploadedSlots = $property->media()
            ->whereIn('blueprint_media_slot_id', $requiredSlotIds)
            ->count();

        $score = (int) min(100, round((($filledFields + $uploadedSlots) / $totalRequired) * 100));

        $property->update(['completion_score' => $score]);
    }
}
