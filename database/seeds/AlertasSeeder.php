<?php

use App\Alerta;
use Illuminate\Database\Seeder;

class AlertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alerta::insert([
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
            ['texto' => 'Some text', 'user_id' => '1', 'no_leido' => true],
        ]);
    }
}
