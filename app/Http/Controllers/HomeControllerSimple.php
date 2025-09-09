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
     * Estatísticas de entregas mensais
     */
    private function getMonthlyDeliveries()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = [
                'month' => $date->locale('pt_BR')->isoFormat('MMM/YY'),
                'count' => DeliveryRecord::whereMonth('delivered_at', $date->month)
                                       ->whereYear('delivered_at', $date->year)
                                       ->count()
            ];
        }
        return $months;
    }

    /**
     * Estatísticas gerais de entregas
     */
    private function getDeliveryStats()
    {
        return [
            'scheduled' => Delivery::where('status', 'scheduled')->count(),
            'in_progress' => Delivery::where('status', 'in_progress')->count(),
            'completed' => Delivery::where('status', 'completed')->count(),
            'cancelled' => Delivery::where('status', 'cancelled')->count(),
        ];
    }
}
