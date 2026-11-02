<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            User::updateOrCreate(
                ['email' => 'admin@smacdigital.com'],
                [
                    'name' => 'SMAC Digital Admin',
                    'password' => Hash::make('Admin@smac22'),
                    'role' => 'superadmin',
                    'permissions' => json_encode(['all'])
                ]
            );
        } catch (\Throwable $e) {
            // Silently continue if database or table not ready
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
