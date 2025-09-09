<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryRecord;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Dashboard simplificado para todos os usuários
        $data = [
            'totalParticipants' => Participant::count(),
            'activeParticipants' => Participant::where('status', 'active')->count(),
            'totalUsers' => User::count(),
            'totalDeliveries' => Delivery::count(),
            'upcomingDeliveries' => Delivery::where('delivery_date', '>', now())->count(),
            'completedDeliveries' => Delivery::where('status', 'completed')->count(),
            'thisMonthDeliveries' => DeliveryRecord::whereMonth('delivered_at', now()->month)
                                                  ->whereYear('delivered_at', now()->year)
                                                  ->count(),
            'recentParticipants' => Participant::orderBy('created_at', 'desc')
                                              ->take(5)
                                              ->get(),
            'recentDeliveries' => Delivery::orderBy('delivery_date', 'desc')
                                         ->take(5)
                                         ->get(),
        ];

        // Dados para gráficos
        $data['monthlyDeliveries'] = $this->getMonthlyDeliveries();
        $data['deliveryStats'] = $this->getDeliveryStats();

        return view('home', $data);
    }

    /**
     * Dashboard do Administrador
     */
    private function adminDashboard()
    {
        $data = [
            'totalParticipants' => Participant::count(),
            'activeParticipants' => Participant::active()->count(),
            'totalUsers' => User::count(),
            'totalDeliveries' => Delivery::count(),
            'upcomingDeliveries' => Delivery::upcoming()->count(),
            'completedDeliveries' => Delivery::completed()->count(),
            'thisMonthDeliveries' => DeliveryRecord::whereMonth('delivered_at', now()->month)
                                                  ->whereYear('delivered_at', now()->year)
                                                  ->count(),
            'recentParticipants' => Participant::with('registeredBy')
                                              ->orderBy('created_at', 'desc')
                                              ->take(5)
                                              ->get(),
            'recentDeliveries' => Delivery::with('createdBy')
                                         ->orderBy('created_at', 'desc')
                                         ->take(5)
                                         ->get(),
            'nextDelivery' => $this->getNextDelivery(),
            'monthlyStats' => $this->getMonthlyStats(),
            'participantsByState' => $this->getParticipantsByState()
        ];

        return view('dashboards.admin', $data);
    }

    /**
     * Dashboard do Operador
     */
    private function operatorDashboard()
    {
        $data = [
            'totalParticipants' => Participant::active()->count(),
            'todayDeliveries' => DeliveryRecord::today()->count(),
            'upcomingDeliveries' => Delivery::upcoming()->count(),
            'recentParticipants' => Participant::with('registeredBy')
                                              ->orderBy('created_at', 'desc')
                                              ->take(5)
                                              ->get(),
            'nextDelivery' => $this->getNextDelivery(),
            'activeDelivery' => Delivery::where('status', 'in_progress')
                                      ->whereDate('delivery_date', today())
                                      ->with('deliveryRecords')
                                      ->first(),
            'monthlyDeliveries' => DeliveryRecord::whereMonth('delivered_at', now()->month)
                                                 ->whereYear('delivered_at', now()->year)
                                                 ->count(),
            'weeklyStats' => $this->getWeeklyStats()
        ];

        return view('dashboards.operator', $data);
    }

    /**
     * Dashboard do Participante
     */
    private function participantDashboard()
    {
        // Para o dashboard do participante, vamos mostrar informações gerais
        // já que não temos uma relação direta entre User e Participant
        $data = [
            'nextDelivery' => $this->getNextDelivery(),
            'lastDeliveries' => collect(), // Vazio por enquanto
            'totalReceived' => 0, // Será implementado quando tiver a funcionalidade completa
            'thisYearReceived' => 0
        ];

        return view('dashboards.participant', $data);
    }

    /**
     * Calcula a próxima entrega (último sábado do mês)
     */
    private function getNextDelivery()
    {
        $nextMonth = now()->addMonth();
        $lastSaturday = Delivery::getLastSaturdayOfMonth($nextMonth->year, $nextMonth->month);

        return [
            'date' => $lastSaturday,
            'formatted_date' => $lastSaturday->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY'),
            'days_until' => now()->diffInDays($lastSaturday, false),
            'title' => Delivery::generateTitle($lastSaturday)
        ];
    }

    /**
     * Estatísticas mensais para o admin
     */
    private function getMonthlyStats()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = [
                'month' => $date->locale('pt_BR')->isoFormat('MMM/YY'),
                'participants' => Participant::whereMonth('created_at', $date->month)
                                           ->whereYear('created_at', $date->year)
                                           ->count(),
                'deliveries' => DeliveryRecord::whereMonth('delivered_at', $date->month)
                                            ->whereYear('delivered_at', $date->year)
                                            ->count()
            ];
        }
        return $months;
    }

    /**
     * Estatísticas semanais para o operador
     */
    private function getWeeklyStats()
    {
        $weeks = [];
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = now()->subWeeks($i)->startOfWeek();
            $endOfWeek = now()->subWeeks($i)->endOfWeek();

            $weeks[] = [
                'week' => $startOfWeek->locale('pt_BR')->isoFormat('DD/MM') . ' - ' . $endOfWeek->locale('pt_BR')->isoFormat('DD/MM'),
                'deliveries' => DeliveryRecord::whereBetween('delivered_at', [$startOfWeek, $endOfWeek])->count()
            ];
        }
        return $weeks;
    }

    /**
     * Participantes por estado
     */
    private function getParticipantsByState()
    {
        return Participant::selectRaw('state, COUNT(*) as count')
                         ->groupBy('state')
                         ->orderBy('count', 'desc')
                         ->get();
    }
}
