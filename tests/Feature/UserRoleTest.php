<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use JDD\Workflow\Facades\Workflow;
use Tests\TestCase;

/**
 * Workflow
 */
class UserRoleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test user role relationship.
     */
    public function testUserRole()
    {
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

        $user = new User([
            'role' => 'admin',
        ]);
        $role = $user->roleObject;

        // Check user is admin
        $this->assertEquals($role0->getKey(), $role->getKey());
        $this->assertCount(2, $user->allMenus());
    }
}
