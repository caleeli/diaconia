<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@coredump.com',
            'password' => 'admin',
            'role' => 'Administrador',            
        ]);

        User::create([
            'name' => 'audit',
            'email' => 'audit@coredump.com',
            'password' => 'audit',
            'role' => 'Auditores',            
        ]);

        User::create([
            'name' => 'superv',
            'email' => 'superv@coredump.com',
            'password' => 'superv',
            'role' => 'Supervisores',            
        ]);

        User::create([
            'name' => 'autor',
            'email' => 'autor@coredump.com',
            'password' => 'autor',
            'role' => 'Autorizadores',            
        ]);
    }
}
