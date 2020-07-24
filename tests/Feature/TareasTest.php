<?php

namespace Tests\Feature;

use App\Tarea;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

/**
 * Probar Tarea
 */
class TareasTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Probar modelo Tarea
     *
     */
    public function test_probar_metodo_todos_usuarios()
    {
        // Popula una base de datos de prueba
        $this->artisan('migrate:fresh', ['--seed' => true]);
        $tarea = Tarea::find(1);
        
        $count = User::count();

        $this->assertCount($count, $tarea->todosUsuarios());
    }

    /**
     * Probar la validación de los campos de una tarea
     *
     */
    public function test_probar_crear_tarea_invalida()
    {
        // Al crear una tarea sin nombre se generará una excepción de Validación
        $this->expectException(ValidationException::class);
        $tarea = new Tarea();
        $tarea->save();
    }

    /**
     * Prueba crear una tarea
     *
     */
    public function test_probar_crear_una_tarea()
    {
        // Crea una tarea con entregable tipo array
        $tarea = new Tarea();
        $tarea->nombre = 'Prueba tarea';
        $tarea->estado = 'pendiente';
        $tarea->creador_id = 1;
        $tarea->entregable = ['name' => 'entregable.png', 'mime' => 'image/png'];
        $tarea->save();

        // Verifica que el entregable se guardo y tambien la fecha del entregable
        $this->assertNotEmpty($tarea->entregable_fecha);
        $this->assertIsArray($tarea->entregable);

        // Crea una tarea con entregable tipo string
        $tarea = new Tarea();
        $tarea->nombre = 'Prueba tarea';
        $tarea->estado = 'pendiente';
        $tarea->creador_id = 1;
        $tarea->entregable = '{"name": "entregable.png", "mime": "image/png"}';
        $tarea->save();

        // Verifica que el entregable se guardo y tambien la fecha del entregable
        $this->assertNotEmpty($tarea->entregable_fecha);
        $this->assertIsArray($tarea->entregable);
    }

    /**
     * Prueba el método datosGantt
     * 
     */
    public function test_probar_el_metodo_datos_gantt()
    {
        // Popula una base de datos de prueba
        $this->artisan('migrate:fresh', ['--seed' => true]);
        // Crea el objeto tarea
        $tarea = new Tarea();
        // Llamam al método datosGantt
        $resultado = $tarea->datosGantt();
        // Verificar que el resultado sea un arreglo
        $this->assertIsArray($resultado);
    }
}
