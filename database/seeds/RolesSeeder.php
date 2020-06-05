<?php

use App\Menu;
use App\MenuRole;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador Role
        $administrador = Role::create([
            'role' => 'Administrador',
        ]);
        $administrador->createMenu([
            'code' => 'users',
            'name' => 'Users',
            'path' => '/users',
            'icon' => 'fas fa-users',
            'variant' => 'info',
        ]);
        $administrador->createMenu([
            'code' => 'roles',
            'name' => 'Roles',
            'path' => '/roles',
            'icon' => 'fas fa-user-tie',
            'variant' => 'info',
        ]);

        // Auditores Role
        $auditor = Role::create([
            'role' => 'Auditores',
        ]);

        // Supervisores Role
        $supervisor = Role::create([
            'role' => 'Supervisores',
        ]);

        // Autorizadores Role
        $autorizador = Role::create([
            'role' => 'Autorizadores',
        ]);
    }
}
