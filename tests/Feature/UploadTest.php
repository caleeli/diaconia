<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * UploadTest
 */
class UploadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Upload a single file.
     *
     * @return void
     */
    public function testUploadSingleFile()
    {
        // Sube un archivo como fake
        Storage::fake('public');
        $response = $this->json('POST', '/api/uploadfile', [
            'file' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['name', 'mime', 'path', 'url']);
        $json = $response->json();

        // Assertion: El archivo fue cargado
        Storage::disk('public')->assertExists($json['path']);
    }

    /**
     * Upload multiple files.
     *
     * @return void
     */
    public function testUploadMultipleFiles()
    {
        // Sube un archivo como fake
        Storage::fake('public');
        $response = $this->json('POST', '/api/uploadfile', [
            'file' => [
                UploadedFile::fake()->image('image1.jpg'),
                UploadedFile::fake()->image('image2.jpg'),
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([['name', 'mime', 'path', 'url']]);
        $json = $response->json();

        // Assertion: Los archivos fueron cargados
        foreach ($json as $file) {
            Storage::disk('public')->assertExists($file['path']);
        }
    }
}
