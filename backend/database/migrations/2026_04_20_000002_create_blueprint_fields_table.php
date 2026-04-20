<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * blueprint_fields stores structured data fields (text, number, select, boolean)
     * that sellers must fill in per category — e.g. surface_area, floor_number, orientation.
     * These are distinct from media slots (photos/videos), which live in blueprint_media_slots.
     */
    public function up(): void
    {
        Schema::create('blueprint_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('field_key', 100);
            $table->string('field_label', 150);
            $table->enum('field_type', [
                'text',
                'number',
                'select',
                'boolean',
            ]);
            $table->json('options')->nullable();
            $table->boolean('is_required')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['category_id', 'field_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blueprint_fields');
    }
};
