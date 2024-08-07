<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Defina o número total de usuários que deseja criar
        $totalUsers = 20;

        // Criar usuário Admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'role' => 'manager'
        ]);

        // Criar 1 funcionário específico
        User::factory()->create([
            'name' => 'funcionário',
            'email' => 'fun@fun',
            'password' => Hash::make('func'),
            'role' => 'employee'
        ]);

        // Criar 3 gerentes adicionais (totalizando 4, incluindo o Admin)
        User::factory()->count(3)->create([
            'role' => 'manager',
            'password' => Hash::make('man'), // Senha fixa para gerentes
        ]);

        // Criar o restante como employees com senhas aleatórias
        User::factory()->count($totalUsers - 5)->create([
            'role' => 'employee',
        ]);
    }
}
