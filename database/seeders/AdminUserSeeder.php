<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@solidariedade.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Atribuir role de administrador
        $adminRole = Role::where('name', 'administrador')->first();
        if ($adminRole) {
            $user->assignRole($adminRole);
        }

        $this->command->info('Usuário administrador criado com sucesso!');
        $this->command->info('Email: admin@solidariedade.com');
        $this->command->info('Senha: admin123');
    }
}
