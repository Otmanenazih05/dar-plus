<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * blueprint_media_slots defines which photos/videos are required or optional
     * for each property category. The completion score is calculated against these slots.
     * Each slot ties to a specific area (facade, kitchen, living_room, etc.).
     */
    public function up(): void
    {
        Schema::create('blueprint_media_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('slot_key', 100);             // e.g. "facade", "living_room", "video_tour"
            $table->string('slot_label', 150);            // e.g. "Façade du bâtiment", "Salon"
            $table->enum('media_type', [
                'image',
                'video',
                'both',                                   // slot accepts either image or video
            ])->default('image');
            $table->boolean('is_required')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('hint', 255)->nullable();      // Helper text shown in the upload UI
            $table->unsignedTinyInteger('max_count')->default(1); // Max files per slot (e.g. 3 for extra bedrooms)
            $table->timestamps();

            // A category cannot have two media slots with the same key
            $table->unique(['category_id', 'slot_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blueprint_media_slots');
    }
};
