<?php

namespace Tests\Feature;

use App\Plantilla;
use App\Respuesta;
use App\Revision;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RevisionTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Crear una revision y agregar preguntas.
     */
    public function testrevisionAgregarPreguntas()
    {
        // Crea una plantilla
        $plantilla = Plantilla::create(['name' => 'prueba']);
        // Agregar pregunta a la plantilla
        $pregunta = $plantilla->preguntas()->create([
            'grupo' => 'a',
            'descripcion' => 'Pregunta A',
        ]);

        // Crear una revision
        $revision = factory(Revision::class)->create();

        // Agregar respuesta a la revision
        $respuesta = factory(Respuesta::class)->make([
            'pregunta_id' => $pregunta->getKey(),
        ])->toArray();
        $respuesta = $revision->respuestas()->create($respuesta);

        // Assertion: Verificar relación entre respuesta y revision
        $this->assertEquals($revision->getKey(), $respuesta->revision->getKey());
    }
}
