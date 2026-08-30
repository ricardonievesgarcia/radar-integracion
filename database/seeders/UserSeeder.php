<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@radar.local',
            ],
            [
                'name' => 'Administrador Radar',
                'password' => 'Radar123*',
                'estado' => UserStatus::ACTIVO,
                'must_change_password' => true,
                'password_changed_at' => null,
            ]
        );
    }
}
