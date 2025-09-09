<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\DeliveryRecord;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@solidariedade.com')->first();
        $completedDelivery = Delivery::where('status', 'completed')->first();

        if (!$adminUser || !$completedDelivery) {
            $this->command->error('Usuário administrador ou entrega completada não encontrados!');
            return;
        }

        // Buscar alguns participantes para criar registros de entrega
        $participants = Participant::take(4)->get();

        if ($participants->count() === 0) {
            $this->command->error('Nenhum participante encontrado!');
            return;
        }

        $deliveryTime = $completedDelivery->delivery_date->setTime(9, 0);

        foreach ($participants as $index => $participant) {
            // Varia o horário de entrega
            $deliveredAt = $deliveryTime->copy()->addMinutes($index * 30);

            DeliveryRecord::create([
                'delivery_id' => $completedDelivery->id,
                'participant_id' => $participant->id,
                'delivered_at' => $deliveredAt,
                'document_verified' => $participant->document_type . ': ' . $participant->document_number,
                'observations' => $this->getRandomObservation(),
                'delivered_by' => $adminUser->id
            ]);
        }

        // Atualizar o contador da entrega
        $completedDelivery->updateDeliveredCount();

        $this->command->info('Registros de entrega criados com sucesso!');
        $this->command->info('Total de registros: ' . $participants->count());
        $this->command->info('Entrega: ' . $completedDelivery->title);
    }

    /**
     * Retorna uma observação aleatória para o registro
     */
    private function getRandomObservation(): string
    {
        $observations = [
            'Entrega realizada normalmente.',
            'Participante chegou no horário.',
            'Documento verificado com sucesso.',
            'Família muito agradecida.',
            'Entrega sem intercorrências.',
            'Participante trouxe sacola própria.',
            'Primeira vez recebendo a cesta.',
            'Documento apresentado: original.'
        ];

        return $observations[array_rand($observations)];
    }
}
