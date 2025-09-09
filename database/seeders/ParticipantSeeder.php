<?php

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@solidariedade.com')->first();

        if (!$adminUser) {
            $this->command->error('Usuário administrador não encontrado!');
            return;
        }

        $participants = [
            [
                'name' => 'Maria Silva Santos',
                'document_type' => 'CPF',
                'document_number' => '12345678901',
                'birth_date' => '1985-03-15',
                'phone' => '(11) 98765-4321',
                'email' => 'maria.silva@email.com',
                'address' => 'Rua das Flores, 123, Ap 45',
                'neighborhood' => 'Jardim das Rosas',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01234567',
                'gender' => 'F',
                'family_members' => 4,
                'monthly_income' => 1500.00,
                'observations' => 'Família com 2 crianças pequenas',
                'registered_by' => $adminUser->id,
                'registered_at' => now()
            ],
            [
                'name' => 'João Oliveira Costa',
                'document_type' => 'CPF',
                'document_number' => '98765432100',
                'birth_date' => '1978-11-22',
                'phone' => '(11) 91234-5678',
                'email' => null,
                'address' => 'Av. Principal, 456',
                'neighborhood' => 'Centro',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01234000',
                'gender' => 'M',
                'family_members' => 2,
                'monthly_income' => 800.00,
                'observations' => 'Desempregado, mora com a esposa',
                'registered_by' => $adminUser->id,
                'registered_at' => now()->subDays(5)
            ],
            [
                'name' => 'Ana Paula Ferreira',
                'document_type' => 'RG',
                'document_number' => '123456789',
                'birth_date' => '1992-07-08',
                'phone' => '(11) 95555-0000',
                'email' => 'ana.ferreira@gmail.com',
                'address' => 'Rua Nova Esperança, 789',
                'neighborhood' => 'Vila Progresso',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '08765432',
                'gender' => 'F',
                'family_members' => 3,
                'monthly_income' => 1200.00,
                'observations' => 'Mãe solteira com 2 filhos',
                'registered_by' => $adminUser->id,
                'registered_at' => now()->subDays(10)
            ],
            [
                'name' => 'Carlos Eduardo Mendes',
                'document_type' => 'CPF',
                'document_number' => '11122233344',
                'birth_date' => '1965-12-03',
                'phone' => '(11) 97777-8888',
                'email' => null,
                'address' => 'Travessa da Paz, 321',
                'neighborhood' => 'Bairro Novo',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05432109',
                'gender' => 'M',
                'family_members' => 5,
                'monthly_income' => 2000.00,
                'observations' => 'Aposentado, família grande',
                'registered_by' => $adminUser->id,
                'registered_at' => now()->subDays(15)
            ],
            [
                'name' => 'Lucia Santos Pereira',
                'document_type' => 'CPF',
                'document_number' => '55566677788',
                'birth_date' => '1980-05-20',
                'phone' => '(11) 94444-3333',
                'email' => 'lucia.pereira@yahoo.com',
                'address' => 'Rua do Comércio, 654, Casa 2',
                'neighborhood' => 'Comercial',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '09876543',
                'gender' => 'F',
                'family_members' => 1,
                'monthly_income' => 600.00,
                'observations' => 'Mora sozinha, auxílio emergencial',
                'registered_by' => $adminUser->id,
                'registered_at' => now()->subDays(20)
            ]
        ];

        foreach ($participants as $participantData) {
            Participant::create($participantData);
        }

        $this->command->info('Participantes de exemplo criados com sucesso!');
        $this->command->info('Total de participantes: ' . count($participants));
    }
}
