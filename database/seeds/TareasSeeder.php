<?php

use App\Tareas;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tareas::insert([
            ['nombre' => 'Tarea 1','entregable' => '{"name":"archivo.txt","url":"https://homepages.cae.wisc.edu/~ece533/images/cat.png","mime":"image/png","path":"https://homepages.cae.wisc.edu/~ece533/images/cat.png"}', 'entregable_fecha' => Carbon::now(), 'vencimiento' => '12-12-2032', 'estado' => 'estado 1', 'creador_id' => '1'],
            ['nombre' => 'Tarea 2','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 2', 'creador_id' => '1'],
            ['nombre' => 'Tarea 3','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 3', 'creador_id' => '1'],
            ['nombre' => 'Tarea 4','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 4', 'creador_id' => '2'],
            ['nombre' => 'Tarea 5','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 5', 'creador_id' => '2'],
            ['nombre' => 'Tarea 6','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 6', 'creador_id' => '2'],
            ['nombre' => 'Tarea 7','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 7', 'creador_id' => '3'],
            ['nombre' => 'Tarea 8','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 8', 'creador_id' => '3'],
            ['nombre' => 'Tarea 9','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 9', 'creador_id' => '4'],
            ['nombre' => 'Tarea 10','entregable' => null, 'entregable_fecha' => null, 'vencimiento' => '12-12-2032', 'estado' => 'estado 10', 'creador_id' => '4'],
        ]);
    }
}
