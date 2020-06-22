<?php

namespace Tests\Feature;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Application pages
 */
class PagesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Probar pagina raiz
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Go to root page
        $response = $this->get('/');

        // Assertion: Expects a 200 response
        $response->assertStatus(200);
    }

    /**
     * Probar acceder paginas sin autorización.
     *
     * @return void
     */
    public function testAuthenticatedPageWithoutLogin()
    {
        // Go to home page
        $response = $this->get('/home');

        // Assertion: Expects a 302 response
        $response->assertStatus(302);

        // Go to home page as json
        $response = $this->json('get', '/api/data/users');

        // Assertion: Expects a 401 response
        $response->assertStatus(401);
    }

    /**
     * Probar login.
     *
     * @return void
     */
    public function testLogin()
    {
        // Crear un usuario de prueba
        $password = '1234';
        $user = factory(User::class)->create([
            'email' => 'test@coredump.com',
            'password' => $password,
        ]);

        // Ir a la pagina de login
        $response = $this->get('/login');

        // Assertion: Verificar que carga (status 200) y es el blade de login
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

        // Mock para verificar el captcha
        NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);

        // Ingresa al sistema con el usuario de prueba
        $response = $this->post('/login', [
            'g-recaptcha-response' => '1',
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assertion: Verifica que se redirecciona a la pagina home
        $response->assertRedirect('/home');

        // Re abrir home
        $response = $this->get('/home');

        // Assertion: Verificar que carga (status 200) y es el blade de login
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }
}
