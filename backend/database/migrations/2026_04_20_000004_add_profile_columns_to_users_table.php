<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add Dar+ profile columns to the existing users table.
     * This migration exists because the users table was already created
     * by the default Laravel migration before these columns were added.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['buyer', 'seller', 'admin'])->default('buyer')->after('password');
            $table->string('phone', 20)->nullable()->after('role');
            $table->string('city', 100)->nullable()->after('phone');
            $table->string('avatar_url')->nullable()->after('city');
            $table->text('bio')->nullable()->after('avatar_url');
            $table->boolean('is_active')->default(true)->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'city', 'avatar_url', 'bio', 'is_active']);
        });
    }
};
