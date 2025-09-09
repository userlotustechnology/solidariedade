<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:assign {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign admin role to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Usuário com email {$email} não encontrado!");
            return 1;
        }

        $adminRole = Role::where('name', 'administrador')->first();
        if (!$adminRole) {
            $this->error("Role de administrador não encontrada!");
            return 1;
        }

        if ($user->hasRole('administrador')) {
            $this->info("Usuário já possui role de administrador!");
            return 0;
        }

        $user->assignRole($adminRole);
        $this->info("Role de administrador atribuída com sucesso!");

        return 0;
    }
}
