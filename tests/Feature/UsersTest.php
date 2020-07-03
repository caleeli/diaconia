<?php

namespace Tests\Feature;

use App\Tarea;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * Probar usuarios
 */
class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test user api routes.
     *
     */
    public function testApi()
    {
        // Login a API
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        // Obtener lista de usuarios
        $response = $this->call('GET', '/api/data/users');

        // Assertion: Devuelve status 200 y dos elementos (meta y data)
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $json = $response->json();
        $this->assertArrayHasKey('meta', $json);
        $this->assertArrayHasKey('data', $json);

        // Post inválido
        $response = $this->postJson('/api/data/users', [
            'data' => [
                'type' => 'App.User',
                'attributes' => [
                    'name' => '',
                ],
            ],
        ]);
        $response->assertStatus(422);
        $json = $response->json();
        $this->assertArrayHasKey('errors', $json);
        $this->assertArrayHasKey('name', $json['errors']);
    }

    /**
     * Probar tareas de usuarios
     *
     */
    public function test_obtener_tareas_del_usuario()
    {
        // Popula una base de datos de prueba
        $this->artisan('migrate:fresh', ['--seed' => true]);
        // Obtiene las tareas de usuario 1
        $user = User::find(1);
        $tareas =  $user->tareas;
        // Assertion: Se verifica que el resultado es un array de tareas
        $this->assertContainsOnlyInstancesOf(Tarea::class, $tareas);

        // Obtiene los usuarios de la tarea
        $tarea = $tareas[0];
        $users = $tarea->users;
        // Assertion: Se verifica que la tarea tiene un unico usuario asignado
        $this->assertCount(1, $users);
        $this->assertEquals($user->id, $users[0]->id);
    }
}
