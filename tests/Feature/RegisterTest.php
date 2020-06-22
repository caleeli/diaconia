<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Application pages
 */
class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterUser()
    {
        // Ir a la pagina de registro
        $response = $this->get('/register');

        // Assertion: Verificar que carga (status 200) y es el blade de login
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        // POST request, with the user to register
        $response = $this->call('POST', '/register', [
            'name' => 'test',
            'email' => 'test@coredump.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        // Assertion: Se registro el usuario
        $this->assertEquals(1, User::count());
        $response->assertRedirect('/home');
    }
}
