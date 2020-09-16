<?php

namespace Tests\Feature;

use App\Alerta;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Probar Tarea
 */
class AlertaTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Probar método cambiarNoLeidoFalse
     *
     */
    public function test_probar_metodo_cambiar_no_leido_false()
    {
        // Popula una base de datos de prueba
        $this->artisan('migrate:fresh', ['--seed' => true]);
        $alerta = Alerta::find(1);
        // La alerta no ha sido leída
        $this->assertTrue($alerta->no_leido);

        Alerta::find(1)->cambiarNoLeidoFalse();
        $alerta = Alerta::find(1);
        // La alerta ya fue leída
        $this->assertFalse($alerta->no_leido);
    }
}
