<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configurar locale e timezone do Carbon para Brasil
        Carbon::setLocale('pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');

        // Configurar Bootstrap para paginação
        Paginator::useBootstrapFour();
    }
}
