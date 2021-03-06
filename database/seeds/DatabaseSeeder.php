<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CombosSeeder::class);
        $this->call(OperacionesSeeder::class);
        $this->call(TareasSeeder::class);
        $this->call(TareaUsuarioSeeder::class);
        $this->call(AlertasSeeder::class);
    }
}
