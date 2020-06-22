<?php

namespace Tests\Feature;

use App\Plantilla;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PlantillasTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * El nombre de la plantilla es requerido.
     */
    public function testPlantillaValidation()
    {
        $this->expectException(ValidationException::class);
        Plantilla::create([]);
    }

    /**
     * Crear una plantilla y agregar preguntas.
     */
    public function testPlantillaAgregarPreguntas()
    {
        // Crear una plantilla
        $plantilla = Plantilla::create(['name' => 'prueba']);
        // Agregar pregunta a la plantilla
        $pregunta = $plantilla->preguntas()->create([
            'grupo' => 'a',
            'descripcion' => 'Pregunta A',
        ]);
        // Assertion: Verificar relación entre pregunta y plantilla
        $this->assertEquals($plantilla->getKey(), $pregunta->plantilla->getKey());

        // No se puede crear una pregunta sin grupo o descripcion
        $this->expectException(ValidationException::class);
        $pregunta = $plantilla->preguntas()->create([
            'grupo' => '',
            'descripcion' => '',
        ]);
    }
}
