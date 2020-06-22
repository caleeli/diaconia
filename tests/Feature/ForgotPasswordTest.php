<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Application pages
 */
class ForgotPasswordTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterUser()
    {
        // Crear un usuario de prueba
        $password = '1234';
        factory(User::class)->create([
            'email' => 'test@coredump.com',
            'password' => $password,
        ]);

        // Ir a la pagina de registro
        $response = $this->get('/password/reset');

        // Assertion: Verificar que carga (status 200) y es el blade de login
        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.email');

        // POST request, with the user to register
        $response = $this->call('POST', '/password/email', [
            'email' => 'test@coredump.com',
        ]);

        // Assertion: Verificar que vuelve a /paswword/reset
        $response->assertRedirect('/password/reset');
    }
}
