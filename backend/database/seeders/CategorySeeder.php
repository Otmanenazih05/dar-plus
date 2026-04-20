<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Seed the 5 property categories for Dar+.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Apartment',
                'slug'        => 'apartment',
                'icon'        => 'building-2',          // Lucide icon
                'description' => 'Appartements dans des immeubles résidentiels, studios inclus.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Villa',
                'slug'        => 'villa',
                'icon'        => 'house',
                'description' => 'Villas et maisons d\'architecte avec jardin ou piscine.',
                'is_active'   => true,
            ],
            [
                'name'        => 'House',
                'slug'        => 'house',
                'icon'        => 'home',
                'description' => 'Maisons individuelles et riads traditionnels.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Land',
                'slug'        => 'land',
                'icon'        => 'land-plot',
                'description' => 'Terrains constructibles, agricoles ou industriels.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Commercial',
                'slug'        => 'commercial',
                'icon'        => 'store',
                'description' => 'Locaux commerciaux, bureaux, entrepôts et fonds de commerce.',
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
