<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar permissões
        $permissions = [
            // Usuários
            ['name' => 'users.view', 'display_name' => 'Visualizar Usuários', 'description' => 'Pode visualizar lista de usuários', 'module' => 'users'],
            ['name' => 'users.create', 'display_name' => 'Criar Usuários', 'description' => 'Pode criar novos usuários', 'module' => 'users'],
            ['name' => 'users.edit', 'display_name' => 'Editar Usuários', 'description' => 'Pode editar usuários existentes', 'module' => 'users'],
            ['name' => 'users.delete', 'display_name' => 'Excluir Usuários', 'description' => 'Pode excluir usuários', 'module' => 'users'],
            ['name' => 'users.manage_roles', 'display_name' => 'Gerenciar Roles de Usuários', 'description' => 'Pode atribuir e remover roles de usuários', 'module' => 'users'],

            // Participantes
            ['name' => 'participants.view', 'display_name' => 'Visualizar Participantes', 'description' => 'Pode visualizar lista de participantes', 'module' => 'participants'],
            ['name' => 'participants.create', 'display_name' => 'Cadastrar Participantes', 'description' => 'Pode cadastrar novos participantes', 'module' => 'participants'],
            ['name' => 'participants.edit', 'display_name' => 'Editar Participantes', 'description' => 'Pode editar dados de participantes', 'module' => 'participants'],
            ['name' => 'participants.delete', 'display_name' => 'Excluir Participantes', 'description' => 'Pode excluir participantes', 'module' => 'participants'],

            // Entregas
            ['name' => 'deliveries.view', 'display_name' => 'Visualizar Entregas', 'description' => 'Pode visualizar entregas de cestas', 'module' => 'deliveries'],
            ['name' => 'deliveries.create', 'display_name' => 'Criar Entregas', 'description' => 'Pode criar novas entregas', 'module' => 'deliveries'],
            ['name' => 'deliveries.edit', 'display_name' => 'Editar Entregas', 'description' => 'Pode editar entregas', 'module' => 'deliveries'],
            ['name' => 'deliveries.delete', 'display_name' => 'Excluir Entregas', 'description' => 'Pode excluir entregas', 'module' => 'deliveries'],
            ['name' => 'deliveries.manage', 'display_name' => 'Gerenciar Entregas', 'description' => 'Pode gerenciar processo de entrega', 'module' => 'deliveries'],

            // Roles e Permissões
            ['name' => 'roles.view', 'display_name' => 'Visualizar Roles', 'description' => 'Pode visualizar roles do sistema', 'module' => 'roles'],
            ['name' => 'roles.create', 'display_name' => 'Criar Roles', 'description' => 'Pode criar novas roles', 'module' => 'roles'],
            ['name' => 'roles.edit', 'display_name' => 'Editar Roles', 'description' => 'Pode editar roles existentes', 'module' => 'roles'],
            ['name' => 'roles.delete', 'display_name' => 'Excluir Roles', 'description' => 'Pode excluir roles', 'module' => 'roles'],

            // Dashboard
            ['name' => 'dashboard.admin', 'display_name' => 'Dashboard Administrativo', 'description' => 'Acesso ao dashboard administrativo', 'module' => 'dashboard'],
            ['name' => 'dashboard.operator', 'display_name' => 'Dashboard Operacional', 'description' => 'Acesso ao dashboard operacional', 'module' => 'dashboard'],

            // Sistema
            ['name' => 'system.settings', 'display_name' => 'Configurações do Sistema', 'description' => 'Pode alterar configurações do sistema', 'module' => 'system'],
            ['name' => 'system.logs', 'display_name' => 'Visualizar Logs', 'description' => 'Pode visualizar logs do sistema', 'module' => 'system'],

            // Relatórios
            ['name' => 'reports.participants', 'display_name' => 'Relatórios de Participantes', 'description' => 'Pode gerar relatórios de participantes', 'module' => 'reports'],
            ['name' => 'reports.deliveries', 'display_name' => 'Relatórios de Entregas', 'description' => 'Pode gerar relatórios de entregas', 'module' => 'reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Criar roles
        $adminRole = Role::firstOrCreate(
            ['name' => 'administrador'],
            [
                'display_name' => 'Administrador',
                'description' => 'Acesso total ao sistema. Pode gerenciar usuários, roles, permissões e todas as funcionalidades.'
            ]
        );

        $operatorRole = Role::firstOrCreate(
            ['name' => 'operador'],
            [
                'display_name' => 'Operador',
                'description' => 'Acesso operacional ao sistema. Pode gerenciar ações solidárias e participantes.'
            ]
        );

        $participantRole = Role::firstOrCreate(
            ['name' => 'participante'],
            [
                'display_name' => 'Participante',
                'description' => 'Acesso básico ao sistema. Pode participar de ações solidárias.'
            ]
        );

        // Atribuir permissões às roles

        // Administrador - todas as permissões
        $adminPermissions = Permission::all();
        $adminRole->permissions()->sync($adminPermissions->pluck('id'));

        // Operador - permissões operacionais
        $operatorPermissions = Permission::whereIn('name', [
            'users.view',
            'users.create',
            'users.edit',
            'dashboard.operator',
            'actions.view',
            'actions.create',
            'actions.edit',
            'system.logs'
        ])->get();
        $operatorRole->permissions()->sync($operatorPermissions->pluck('id'));

        // Participante - permissões básicas
        $participantPermissions = Permission::whereIn('name', [
            'actions.view',
            'actions.participate'
        ])->get();
        $participantRole->permissions()->sync($participantPermissions->pluck('id'));

        // Atribuir role de administrador ao usuário admin existente
        $adminUser = User::where('email', 'admin@solidariedade.com')->first();
        if ($adminUser && !$adminUser->hasRole('administrador')) {
            $adminUser->assignRole($adminRole);
        }

        $this->command->info('Roles e permissões criadas com sucesso!');
        $this->command->info('- Administrador: ' . $adminRole->permissions->count() . ' permissões');
        $this->command->info('- Operador: ' . $operatorRole->permissions->count() . ' permissões');
        $this->command->info('- Participante: ' . $participantRole->permissions->count() . ' permissões');
    }
}
