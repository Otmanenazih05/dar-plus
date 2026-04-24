<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlueprintFieldResource;
use App\Http\Resources\BlueprintMediaSlotResource;
use App\Models\Category;

class BlueprintController extends Controller
{
    public function getByCategorySlug($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with(['blueprintFields', 'blueprintMediaSlots'])
            ->firstOrFail();

        $fields = BlueprintFieldResource::collection($category->blueprintFields);
        $slots  = BlueprintMediaSlotResource::collection($category->blueprintMediaSlots);

        return response()->json([
            'category_id'   => $category->id,
            'category_slug' => $category->slug,
            'fields' => [
                'required' => $fields->filter(fn($f) => $f->is_required)->values(),
                'optional' => $fields->filter(fn($f) => !$f->is_required)->values(),
            ],
            'media_slots' => [
                'required' => $slots->filter(fn($s) => $s->is_required)->values(),
                'optional' => $slots->filter(fn($s) => !$s->is_required)->values(),
            ],
        ]);
    }
}
