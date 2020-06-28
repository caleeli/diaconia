<?php

use App\Role;
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
        $configuracion = $administrador->createMenu([
            'code' => 'configuracion',
            'name' => 'Configuración',
            'path' => '',
            'icon' => 'fas fa-cogs',
            'variant' => 'info',
        ]);
        $administrador->createMenu([
            'parent' => $configuracion->getKey(),
            'code' => 'tipos_auditoria',
            'name' => 'Tipos Auditoria',
            'path' => '/plantillas',
            'icon' => 'fas fa-book',
            'variant' => 'info',
        ]);

        $administrador->createMenu([
            'parent' => $configuracion->getKey(),
            'code' => 'sucursales',
            'name' => 'Sucursales',
            'path' => '/sucursales',
            'icon' => 'far fa-building',
            'variant' => 'info',
        ]);

        $administrador->createMenu([
            'parent' => $configuracion->getKey(),
            'code' => 'clasificaciones',
            'name' => 'Clasificaciones',
            'path' => '/clasificaciones',
            'icon' => 'fas fa-sitemap',
            'variant' => 'info',
        ]);

        $administrador->createMenu([
            'parent' => $configuracion->getKey(),
            'code' => 'riesgos',
            'name' => 'Riesgos',
            'path' => '/riesgos',
            'icon' => 'fas fa-exclamation-triangle',
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
