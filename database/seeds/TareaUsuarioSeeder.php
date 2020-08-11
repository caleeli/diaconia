<?php

use App\TareaUsuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
            ['tarea_id' => 1, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 1', 'created_at' => '22-06-2020'],
            ['tarea_id' => 2, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 2', 'created_at' => '28-06-2020'],
            ['tarea_id' => 3, 'user_id' => 1, 'responsabilidad' => 'responsabilidad 3', 'created_at' => '22-06-2020'],
            ['tarea_id' => 4, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 4', 'created_at' => '25-06-2020'],
            ['tarea_id' => 5, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 5', 'created_at' => '01-07-2020'],
            ['tarea_id' => 6, 'user_id' => 2, 'responsabilidad' => 'responsabilidad 6', 'created_at' => '22-06-2020'],
            ['tarea_id' => 7, 'user_id' => 3, 'responsabilidad' => 'responsabilidad 7', 'created_at' => '22-06-2020'],
            ['tarea_id' => 8, 'user_id' => 3, 'responsabilidad' => 'responsabilidad 8', 'created_at' => '22-06-2020'],
            ['tarea_id' => 9, 'user_id' => 4, 'responsabilidad' => 'responsabilidad 9', 'created_at' => '02-06-2020'],
            ['tarea_id' => 10, 'user_id' => 4, 'responsabilidad' => 'responsabilidad 10', 'created_at' => '12-06-2020'],
        ]);
    }
}
