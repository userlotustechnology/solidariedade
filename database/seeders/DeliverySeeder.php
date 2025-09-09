<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
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

        // Entrega do mês passado (completada)
        $lastMonth = now()->subMonth();
        $lastSaturday = Delivery::getLastSaturdayOfMonth($lastMonth->year, $lastMonth->month);

        Delivery::create([
            'title' => Delivery::generateTitle($lastSaturday),
            'delivery_date' => $lastSaturday,
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'description' => 'Entrega mensal de cestas básicas para as famílias cadastradas.',
            'total_baskets' => 50,
            'delivered_baskets' => 48,
            'status' => 'completed',
            'observations' => 'Entrega realizada com sucesso. 2 participantes faltaram.',
            'created_by' => $adminUser->id
        ]);

        // Entrega deste mês (agendada)
        $thisMonth = now();
        $thisSaturday = Delivery::getLastSaturdayOfMonth($thisMonth->year, $thisMonth->month);

        Delivery::create([
            'title' => Delivery::generateTitle($thisSaturday),
            'delivery_date' => $thisSaturday,
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'description' => 'Entrega mensal de cestas básicas para as famílias cadastradas.',
            'total_baskets' => 55,
            'delivered_baskets' => 0,
            'status' => 'scheduled',
            'observations' => 'Entrega agendada. Lista de participantes será finalizada uma semana antes.',
            'created_by' => $adminUser->id
        ]);

        // Entrega do próximo mês (agendada)
        $nextMonth = now()->addMonth();
        $nextSaturday = Delivery::getLastSaturdayOfMonth($nextMonth->year, $nextMonth->month);

        Delivery::create([
            'title' => Delivery::generateTitle($nextSaturday),
            'delivery_date' => $nextSaturday,
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'description' => 'Entrega mensal de cestas básicas para as famílias cadastradas.',
            'total_baskets' => 60,
            'delivered_baskets' => 0,
            'status' => 'scheduled',
            'observations' => 'Planejamento inicial. Detalhes serão definidos próximo à data.',
            'created_by' => $adminUser->id
        ]);

        $this->command->info('Entregas de exemplo criadas com sucesso!');
        $this->command->info('- Entrega do mês passado: ' . $lastSaturday->format('d/m/Y') . ' (Completada)');
        $this->command->info('- Entrega deste mês: ' . $thisSaturday->format('d/m/Y') . ' (Agendada)');
        $this->command->info('- Entrega do próximo mês: ' . $nextSaturday->format('d/m/Y') . ' (Agendada)');
    }
}
