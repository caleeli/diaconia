<?php

use App\TareaUsuario;
use Illuminate\Database\Seeder;

class TareaUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TareaUsuario::insert([
            ['tarea_id' => 1, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 1'],
            ['tarea_id' => 2, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 2'],
            ['tarea_id' => 3, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 3'],
            ['tarea_id' => 4, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 4'],
            ['tarea_id' => 5, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 5'],
            ['tarea_id' => 6, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 6'],
            ['tarea_id' => 7, 'user_id' => 3, 'responsabilidad' => 'responsabilidad 7'],
            ['tarea_id' => 8, 'user_id' => 3, 'responsabilidad' => 'responsabilidad 8'],
            ['tarea_id' => 9, 'user_id' => 4, 'responsabilidad' => 'responsabilidad 9'],
            ['tarea_id' => 10, 'user_id' => 4, 'responsabilidad' => 'responsabilidad 10'],
        ]);
    }
}
