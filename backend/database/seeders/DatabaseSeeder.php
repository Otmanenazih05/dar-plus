<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Run order matters:
     *  1. Categories must exist before blueprint fields and media slots (FK dependency).
     *  2. BlueprintFieldSeeder and BlueprintMediaSlotSeeder can run in any order after categories.
     */
    public function run(): void
    {
        // ── Core data ──────────────────────────────────
        $this->call([
            CategorySeeder::class,
            BlueprintFieldSeeder::class,
            BlueprintMediaSlotSeeder::class,
        ]);

        // ── Demo users (as documented in README) ────────
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@darplus.ma'],
            [
                'name'     => 'Admin Dar+',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'city'     => 'Beni Mellal',
                'is_active'=> true,
            ]
        );

        // Demo Seller
        User::updateOrCreate(
            ['email' => 'seller@darplus.ma'],
            [
                'name'     => 'Ahmed Seller',
                'password' => Hash::make('password'),
                'role'     => 'seller',
                'phone'    => '0600000001',
                'city'     => 'Casablanca',
                'bio'      => 'Agent immobilier avec 5 ans d\'expérience.',
                'is_active'=> true,
            ]
        );

        // Demo Buyer
        User::updateOrCreate(
            ['email' => 'buyer@darplus.ma'],
            [
                'name'     => 'Fatima Buyer',
                'password' => Hash::make('password'),
                'role'     => 'buyer',
                'phone'    => '0600000002',
                'city'     => 'Marrakech',
                'is_active'=> true,
            ]
        );
    }
}
