<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlueprintMediaSlotSeeder extends Seeder
{
    /**
     * Seed media upload slots (photos / videos) for all 5 categories.
     * These slots drive the upload UI and the listing completion score.
     * 
     * Rules:
     *  - is_required = true  → slot is mandatory for publishing (counts toward 80% threshold)
     *  - is_required = false → optional but encouraged
     *  - max_count          → how many files the seller can upload for this slot
     *  - hint               → helper text shown in the upload card
     */
    public function run(): void
    {
        $cat = fn(string $slug): int => DB::table('categories')->where('slug', $slug)->value('id');

        $slots = [

            // ─────────────────────────────────────────────
            // APARTMENT
            // ─────────────────────────────────────────────
            ['category' => 'apartment', 'slot_key' => 'facade',          'slot_label' => 'Façade du bâtiment',        'media_type' => 'image', 'is_required' => true,  'sort_order' => 1,  'max_count' => 3, 'hint' => 'Photo extérieure du bâtiment, de préférence de face.'],
            ['category' => 'apartment', 'slot_key' => 'living_room',     'slot_label' => 'Salon',                     'media_type' => 'image', 'is_required' => true,  'sort_order' => 2,  'max_count' => 3, 'hint' => 'Photo grand angle du salon montrant l\'espace et la luminosité.'],
            ['category' => 'apartment', 'slot_key' => 'kitchen',         'slot_label' => 'Cuisine',                   'media_type' => 'image', 'is_required' => true,  'sort_order' => 3,  'max_count' => 3, 'hint' => 'Photo montrant la cuisine, la robinetterie et les équipements.'],
            ['category' => 'apartment', 'slot_key' => 'master_bedroom',  'slot_label' => 'Chambre principale',        'media_type' => 'image', 'is_required' => true,  'sort_order' => 4,  'max_count' => 3, 'hint' => 'Photo de la chambre principale avec dimensions visibles.'],
            ['category' => 'apartment', 'slot_key' => 'bathroom',        'slot_label' => 'Salle de bain',             'media_type' => 'image', 'is_required' => true,  'sort_order' => 5,  'max_count' => 2, 'hint' => 'Montrez clairement la plomberie, la douche et/ou la baignoire.'],
            ['category' => 'apartment', 'slot_key' => 'extra_bedroom',   'slot_label' => 'Chambres supplémentaires',  'media_type' => 'image', 'is_required' => false, 'sort_order' => 6,  'max_count' => 5, 'hint' => 'Photos des autres chambres si applicable.'],
            ['category' => 'apartment', 'slot_key' => 'balcony',         'slot_label' => 'Balcon / Terrasse',         'media_type' => 'image', 'is_required' => false, 'sort_order' => 7,  'max_count' => 2, 'hint' => 'Vue depuis le balcon ou terrasse.'],
            ['category' => 'apartment', 'slot_key' => 'entrance',        'slot_label' => 'Entrée / Couloir',          'media_type' => 'image', 'is_required' => false, 'sort_order' => 8,  'max_count' => 2, 'hint' => 'Photo de l\'entrée principale de l\'appartement.'],
            ['category' => 'apartment', 'slot_key' => 'video_tour',      'slot_label' => 'Visite vidéo',              'media_type' => 'video', 'is_required' => false, 'sort_order' => 9,  'max_count' => 1, 'hint' => 'Vidéo walkthrough de 1 à 3 minutes couvrant toutes les pièces.'],

            // ─────────────────────────────────────────────
            // VILLA
            // ─────────────────────────────────────────────
            ['category' => 'villa', 'slot_key' => 'exterior_front',      'slot_label' => 'Façade avant',              'media_type' => 'image', 'is_required' => true,  'sort_order' => 1,  'max_count' => 3, 'hint' => 'Vue frontale de la villa, montrant la façade complète.'],
            ['category' => 'villa', 'slot_key' => 'exterior_back',       'slot_label' => 'Extérieur arrière',         'media_type' => 'image', 'is_required' => false, 'sort_order' => 2,  'max_count' => 3, 'hint' => 'Vue arrière de la villa et du jardin.'],
            ['category' => 'villa', 'slot_key' => 'living_room',         'slot_label' => 'Salon / Séjour',            'media_type' => 'image', 'is_required' => true,  'sort_order' => 3,  'max_count' => 3, 'hint' => 'Salon principal, grand angle.'],
            ['category' => 'villa', 'slot_key' => 'kitchen',             'slot_label' => 'Cuisine',                   'media_type' => 'image', 'is_required' => true,  'sort_order' => 4,  'max_count' => 3, 'hint' => 'Cuisine équipée ou semi-équipée, plomberie visible.'],
            ['category' => 'villa', 'slot_key' => 'master_bedroom',      'slot_label' => 'Chambre principale',        'media_type' => 'image', 'is_required' => true,  'sort_order' => 5,  'max_count' => 3, 'hint' => 'Suite principale ou chambre maîtresse.'],
            ['category' => 'villa', 'slot_key' => 'bathroom',            'slot_label' => 'Salle de bain',             'media_type' => 'image', 'is_required' => true,  'sort_order' => 6,  'max_count' => 2, 'hint' => 'Salle de bain principale avec équipements visibles.'],
            ['category' => 'villa', 'slot_key' => 'garden',              'slot_label' => 'Jardin',                    'media_type' => 'image', 'is_required' => false, 'sort_order' => 7,  'max_count' => 4, 'hint' => 'Vue du jardin, pelouse, plantations.'],
            ['category' => 'villa', 'slot_key' => 'pool',                'slot_label' => 'Piscine',                   'media_type' => 'image', 'is_required' => false, 'sort_order' => 8,  'max_count' => 3, 'hint' => 'Photo de la piscine si présente.'],
            ['category' => 'villa', 'slot_key' => 'garage',              'slot_label' => 'Garage / Parking',          'media_type' => 'image', 'is_required' => false, 'sort_order' => 9,  'max_count' => 2, 'hint' => 'Photo du garage ou espace de stationnement.'],
            ['category' => 'villa', 'slot_key' => 'video_tour',          'slot_label' => 'Visite vidéo',              'media_type' => 'video', 'is_required' => false, 'sort_order' => 10, 'max_count' => 1, 'hint' => 'Visite virtuelle complète de la villa, 2 à 5 minutes.'],

            // ─────────────────────────────────────────────
            // HOUSE
            // ─────────────────────────────────────────────
            ['category' => 'house', 'slot_key' => 'facade',              'slot_label' => 'Façade de la maison',       'media_type' => 'image', 'is_required' => true,  'sort_order' => 1,  'max_count' => 3, 'hint' => 'Vue frontale de la maison ou du riad.'],
            ['category' => 'house', 'slot_key' => 'living_room',         'slot_label' => 'Salon / Pièce principale',  'media_type' => 'image', 'is_required' => true,  'sort_order' => 2,  'max_count' => 3, 'hint' => 'Pièce principale ou salon.'],
            ['category' => 'house', 'slot_key' => 'kitchen',             'slot_label' => 'Cuisine',                   'media_type' => 'image', 'is_required' => true,  'sort_order' => 3,  'max_count' => 2, 'hint' => 'Cuisine complète, robinetterie et équipements visibles.'],
            ['category' => 'house', 'slot_key' => 'master_bedroom',      'slot_label' => 'Chambre principale',        'media_type' => 'image', 'is_required' => true,  'sort_order' => 4,  'max_count' => 2, 'hint' => 'Chambre principale.'],
            ['category' => 'house', 'slot_key' => 'bathroom',            'slot_label' => 'Salle de bain',             'media_type' => 'image', 'is_required' => true,  'sort_order' => 5,  'max_count' => 2, 'hint' => 'Salle de bain ou hammam.'],
            ['category' => 'house', 'slot_key' => 'patio_courtyard',     'slot_label' => 'Patio / Jardin intérieur',  'media_type' => 'image', 'is_required' => false, 'sort_order' => 6,  'max_count' => 3, 'hint' => 'Patio ou cour intérieure si applicable (surtout pour riads).'],
            ['category' => 'house', 'slot_key' => 'rooftop',             'slot_label' => 'Terrasse / Toit',           'media_type' => 'image', 'is_required' => false, 'sort_order' => 7,  'max_count' => 2, 'hint' => 'Terrasse sur le toit si disponible.'],
            ['category' => 'house', 'slot_key' => 'video_tour',          'slot_label' => 'Visite vidéo',              'media_type' => 'video', 'is_required' => false, 'sort_order' => 8,  'max_count' => 1, 'hint' => 'Vidéo walkthrough de la maison.'],

            // ─────────────────────────────────────────────
            // LAND
            // ─────────────────────────────────────────────
            ['category' => 'land', 'slot_key' => 'land_overview',        'slot_label' => 'Vue générale du terrain',   'media_type' => 'image', 'is_required' => true,  'sort_order' => 1,  'max_count' => 4, 'hint' => 'Photo panoramique ou grand angle du terrain.'],
            ['category' => 'land', 'slot_key' => 'land_boundary',        'slot_label' => 'Limites et clôtures',       'media_type' => 'image', 'is_required' => true,  'sort_order' => 2,  'max_count' => 3, 'hint' => 'Photos des délimitations du terrain.'],
            ['category' => 'land', 'slot_key' => 'road_access',          'slot_label' => 'Accès route',               'media_type' => 'image', 'is_required' => true,  'sort_order' => 3,  'max_count' => 2, 'hint' => 'Photo montrant l\'accès depuis la route.'],
            ['category' => 'land', 'slot_key' => 'surroundings',         'slot_label' => 'Environnement / Quartier',  'media_type' => 'image', 'is_required' => false, 'sort_order' => 4,  'max_count' => 3, 'hint' => 'Photos des alentours et de l\'environnement immédiat.'],
            ['category' => 'land', 'slot_key' => 'title_deed_photo',     'slot_label' => 'Document / Titre foncier',  'media_type' => 'image', 'is_required' => false, 'sort_order' => 5,  'max_count' => 2, 'hint' => 'Photo lisible du titre foncier (TF) si disponible.'],
            ['category' => 'land', 'slot_key' => 'drone_view',           'slot_label' => 'Vue aérienne (drone)',      'media_type' => 'both',  'is_required' => false, 'sort_order' => 6,  'max_count' => 2, 'hint' => 'Vue drone du terrain et de son contexte si disponible.'],

            // ─────────────────────────────────────────────
            // COMMERCIAL
            // ─────────────────────────────────────────────
            ['category' => 'commercial', 'slot_key' => 'facade',         'slot_label' => 'Façade extérieure',         'media_type' => 'image', 'is_required' => true,  'sort_order' => 1,  'max_count' => 3, 'hint' => 'Façade du local, devanture, vitrine.'],
            ['category' => 'commercial', 'slot_key' => 'interior_main',  'slot_label' => 'Intérieur principal',       'media_type' => 'image', 'is_required' => true,  'sort_order' => 2,  'max_count' => 4, 'hint' => 'Espace principal intérieur, sol, plafond, éclairage.'],
            ['category' => 'commercial', 'slot_key' => 'storage_room',   'slot_label' => 'Réserve / Arrière-boutique','media_type' => 'image', 'is_required' => false, 'sort_order' => 3,  'max_count' => 2, 'hint' => 'Photo de la réserve ou arrière-boutique si disponible.'],
            ['category' => 'commercial', 'slot_key' => 'bathroom_wc',    'slot_label' => 'WC / Sanitaires',           'media_type' => 'image', 'is_required' => false, 'sort_order' => 4,  'max_count' => 1, 'hint' => 'Photo des sanitaires du local.'],
            ['category' => 'commercial', 'slot_key' => 'parking_area',   'slot_label' => 'Parking / Accès livraison', 'media_type' => 'image', 'is_required' => false, 'sort_order' => 5,  'max_count' => 2, 'hint' => 'Zone de parking ou accès pour livraisons.'],
            ['category' => 'commercial', 'slot_key' => 'video_tour',     'slot_label' => 'Visite vidéo du local',     'media_type' => 'video', 'is_required' => false, 'sort_order' => 6,  'max_count' => 1, 'hint' => 'Vidéo walkthrough de l\'ensemble du local commercial.'],
        ];

        foreach ($slots as $slot) {
            $categoryId = $cat($slot['category']);

            DB::table('blueprint_media_slots')->updateOrInsert(
                [
                    'category_id' => $categoryId,
                    'slot_key'    => $slot['slot_key'],
                ],
                [
                    'slot_label'  => $slot['slot_label'],
                    'media_type'  => $slot['media_type'],
                    'is_required' => $slot['is_required'],
                    'sort_order'  => $slot['sort_order'],
                    'max_count'   => $slot['max_count'],
                    'hint'        => $slot['hint'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }
    }
}
