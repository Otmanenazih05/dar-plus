<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlueprintFieldSeeder extends Seeder
{
    /**
     * Seed blueprint fields (structured data inputs) for all 5 categories.
     * Fields are category-specific and drive the guided listing creation form.
     */
    public function run(): void
    {
        // Helper to fetch category id by slug
        $cat = fn(string $slug): int => DB::table('categories')->where('slug', $slug)->value('id');

        $fields = [

            // ─────────────────────────────────────────────
            // APARTMENT
            // ─────────────────────────────────────────────
            ['category' => 'apartment', 'field_key' => 'surface_area',    'field_label' => 'Surface totale (m²)',      'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 1],
            ['category' => 'apartment', 'field_key' => 'rooms_count',      'field_label' => 'Nombre de pièces',         'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 2],
            ['category' => 'apartment', 'field_key' => 'bathrooms_count',  'field_label' => 'Nombre de salles de bain', 'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 3],
            ['category' => 'apartment', 'field_key' => 'floor_number',     'field_label' => 'Étage',                    'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 4],
            ['category' => 'apartment', 'field_key' => 'total_floors',     'field_label' => 'Nombre total d\'étages',   'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 5],
            ['category' => 'apartment', 'field_key' => 'building_age',     'field_label' => 'Âge du bâtiment (ans)',    'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 6],
            ['category' => 'apartment', 'field_key' => 'condition',        'field_label' => 'État du bien',             'field_type' => 'select',  'options' => ['Neuf', 'Très bon état', 'Bon état', 'À rénover'],               'is_required' => true,  'sort_order' => 7],
            ['category' => 'apartment', 'field_key' => 'orientation',      'field_label' => 'Orientation',              'field_type' => 'select',  'options' => ['Nord', 'Sud', 'Est', 'Ouest', 'Nord-Est', 'Nord-Ouest', 'Sud-Est', 'Sud-Ouest'], 'is_required' => true, 'sort_order' => 8],
            ['category' => 'apartment', 'field_key' => 'furnished',        'field_label' => 'Meublé',                   'field_type' => 'boolean', 'options' => null,                                                              'is_required' => true,  'sort_order' => 9],
            ['category' => 'apartment', 'field_key' => 'parking',          'field_label' => 'Place de parking',         'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 10],
            ['category' => 'apartment', 'field_key' => 'elevator',         'field_label' => 'Ascenseur',                'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 11],
            ['category' => 'apartment', 'field_key' => 'balcony',          'field_label' => 'Balcon / Terrasse',        'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 12],

            // ─────────────────────────────────────────────
            // VILLA
            // ─────────────────────────────────────────────
            ['category' => 'villa', 'field_key' => 'surface_area',         'field_label' => 'Surface habitable (m²)',   'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 1],
            ['category' => 'villa', 'field_key' => 'land_area',            'field_label' => 'Surface terrain (m²)',     'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 2],
            ['category' => 'villa', 'field_key' => 'rooms_count',          'field_label' => 'Nombre de pièces',         'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 3],
            ['category' => 'villa', 'field_key' => 'bathrooms_count',      'field_label' => 'Nombre de salles de bain', 'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 4],
            ['category' => 'villa', 'field_key' => 'floors_count',         'field_label' => 'Nombre de niveaux',        'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 5],
            ['category' => 'villa', 'field_key' => 'building_age',         'field_label' => 'Âge de la construction',   'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 6],
            ['category' => 'villa', 'field_key' => 'condition',            'field_label' => 'État du bien',             'field_type' => 'select',  'options' => ['Neuf', 'Très bon état', 'Bon état', 'À rénover'],               'is_required' => true,  'sort_order' => 7],
            ['category' => 'villa', 'field_key' => 'pool',                 'field_label' => 'Piscine',                  'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 8],
            ['category' => 'villa', 'field_key' => 'garden',               'field_label' => 'Jardin',                   'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 9],
            ['category' => 'villa', 'field_key' => 'garage',               'field_label' => 'Garage / Parking couvert', 'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 10],
            ['category' => 'villa', 'field_key' => 'furnished',            'field_label' => 'Meublée',                  'field_type' => 'boolean', 'options' => null,                                                              'is_required' => true,  'sort_order' => 11],
            ['category' => 'villa', 'field_key' => 'security',             'field_label' => 'Gardiennage / Sécurisée',  'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 12],

            // ─────────────────────────────────────────────
            // HOUSE (Maison / Riad)
            // ─────────────────────────────────────────────
            ['category' => 'house', 'field_key' => 'surface_area',         'field_label' => 'Surface habitable (m²)',   'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 1],
            ['category' => 'house', 'field_key' => 'land_area',            'field_label' => 'Superficie du terrain',    'field_type' => 'number',  'options' => null,                                                              'is_required' => false, 'sort_order' => 2],
            ['category' => 'house', 'field_key' => 'rooms_count',          'field_label' => 'Nombre de pièces',         'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 3],
            ['category' => 'house', 'field_key' => 'bathrooms_count',      'field_label' => 'Nombre de salles de bain', 'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 4],
            ['category' => 'house', 'field_key' => 'floors_count',         'field_label' => 'Nombre de niveaux',        'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 5],
            ['category' => 'house', 'field_key' => 'building_age',         'field_label' => 'Âge du bien (ans)',        'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 6],
            ['category' => 'house', 'field_key' => 'condition',            'field_label' => 'État du bien',             'field_type' => 'select',  'options' => ['Neuf', 'Très bon état', 'Bon état', 'À rénover'],               'is_required' => true,  'sort_order' => 7],
            ['category' => 'house', 'field_key' => 'type',                 'field_label' => 'Type de maison',           'field_type' => 'select',  'options' => ['Maison individuelle', 'Riad', 'Dar traditionnel', 'Duplex'],    'is_required' => true,  'sort_order' => 8],
            ['category' => 'house', 'field_key' => 'furnished',            'field_label' => 'Meublée',                  'field_type' => 'boolean', 'options' => null,                                                              'is_required' => true,  'sort_order' => 9],
            ['category' => 'house', 'field_key' => 'garden',               'field_label' => 'Jardin / Patio',           'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 10],
            ['category' => 'house', 'field_key' => 'parking',              'field_label' => 'Parking',                  'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 11],

            // ─────────────────────────────────────────────
            // LAND (Terrain)
            // ─────────────────────────────────────────────
            ['category' => 'land', 'field_key' => 'surface_area',          'field_label' => 'Superficie (m²)',          'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 1],
            ['category' => 'land', 'field_key' => 'land_type',             'field_label' => 'Type de terrain',          'field_type' => 'select',  'options' => ['Constructible', 'Agricole', 'Industriel', 'Mixte'],             'is_required' => true,  'sort_order' => 2],
            ['category' => 'land', 'field_key' => 'zone',                  'field_label' => 'Zonage / Classification',  'field_type' => 'text',    'options' => null,                                                              'is_required' => false, 'sort_order' => 3],
            ['category' => 'land', 'field_key' => 'facade_length',         'field_label' => 'Longueur de façade (m)',   'field_type' => 'number',  'options' => null,                                                              'is_required' => false, 'sort_order' => 4],
            ['category' => 'land', 'field_key' => 'road_access',           'field_label' => 'Accès route / voirie',     'field_type' => 'boolean', 'options' => null,                                                              'is_required' => true,  'sort_order' => 5],
            ['category' => 'land', 'field_key' => 'electricity',           'field_label' => 'Raccordement électricité', 'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 6],
            ['category' => 'land', 'field_key' => 'water',                 'field_label' => 'Raccordement eau',         'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 7],
            ['category' => 'land', 'field_key' => 'title_deed',            'field_label' => 'Titre foncier (TF)',       'field_type' => 'boolean', 'options' => null,                                                              'is_required' => true,  'sort_order' => 8],

            // ─────────────────────────────────────────────
            // COMMERCIAL (Local commercial / Bureau)
            // ─────────────────────────────────────────────
            ['category' => 'commercial', 'field_key' => 'surface_area',    'field_label' => 'Surface (m²)',             'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 1],
            ['category' => 'commercial', 'field_key' => 'commercial_type', 'field_label' => 'Type de local',            'field_type' => 'select',  'options' => ['Magasin', 'Bureau', 'Entrepôt', 'Restaurant', 'Showroom', 'Autre'], 'is_required' => true, 'sort_order' => 2],
            ['category' => 'commercial', 'field_key' => 'floor_number',    'field_label' => 'Étage',                    'field_type' => 'number',  'options' => null,                                                              'is_required' => true,  'sort_order' => 3],
            ['category' => 'commercial', 'field_key' => 'facade_width',    'field_label' => 'Largeur de façade (m)',    'field_type' => 'number',  'options' => null,                                                              'is_required' => false, 'sort_order' => 4],
            ['category' => 'commercial', 'field_key' => 'condition',       'field_label' => 'État du local',            'field_type' => 'select',  'options' => ['Neuf', 'Très bon état', 'Bon état', 'À aménager'],              'is_required' => true,  'sort_order' => 5],
            ['category' => 'commercial', 'field_key' => 'activity_type',   'field_label' => 'Activité autorisée',       'field_type' => 'text',    'options' => null,                                                              'is_required' => false, 'sort_order' => 6],
            ['category' => 'commercial', 'field_key' => 'parking',         'field_label' => 'Parking disponible',       'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 7],
            ['category' => 'commercial', 'field_key' => 'climate_control', 'field_label' => 'Climatisation',            'field_type' => 'boolean', 'options' => null,                                                              'is_required' => false, 'sort_order' => 8],
            ['category' => 'commercial', 'field_key' => 'storage_room',    'field_label' => 'Réserve / Arrière-boutique','field_type' => 'boolean','options' => null,                                                              'is_required' => false, 'sort_order' => 9],
        ];

        foreach ($fields as $field) {
            $categoryId = $cat($field['category']);

            DB::table('blueprint_fields')->updateOrInsert(
                [
                    'category_id' => $categoryId,
                    'field_key'   => $field['field_key'],
                ],
                [
                    'field_label' => $field['field_label'],
                    'field_type'  => $field['field_type'],
                    'options'     => $field['options'] ? json_encode($field['options']) : null,
                    'is_required' => $field['is_required'],
                    'sort_order'  => $field['sort_order'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }
    }
}
