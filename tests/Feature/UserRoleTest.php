<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Probas la relación user-role
 */
class UserRoleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test user role relationship.
     */
    public function testUserRole()
    {
        // Crea un usuario, rol y menues
        $role0 = Role::create([
            'role' => 'admin',
        ]);
        $role0->createMenu([
            'code' => 'users',
            'name' => 'Users',
            'path' => '/users',
            'icon' => 'fas fa-users',
            'variant' => 'info',
        ]);
        $role0->createMenu([
            'code' => 'roles',
            'name' => 'Roles',
            'path' => '/roles',
            'icon' => 'fas fa-user-tie',
            'variant' => 'info',
        ]);

        $user = factory(User::class)->create([
            'role' => 'admin',
        ]);
        $role = $user->roleObject;

        // Assertion: Check user is admin
        $this->assertEquals($role0->getKey(), $role->getKey());
        $this->assertCount(2, $user->allMenus());

        // Obtiene los usuarios de tipo rol admin
        $users = $role->users;

        // Assertion: Verifica que existe un usuario tipo admin
        $this->assertCount(1, $users);
        // Assertion: Verifica que el usuario es el que creado previamente
        $this->assertEquals($user->getKey(), $users[0]->getKey());

        // Obtiene la lista de todos los roles del sistema a travez del role admin
        $roles = $role->todosRoles();

        // Assertion: Se obtiene un array con los roles del sistema
        $this->assertEquals(['admin'], $roles);
    }
}
