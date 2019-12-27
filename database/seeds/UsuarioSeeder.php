<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'Administradores',
            'guard_name'=>'web'
        ]);
        DB::table('roles')->insert([
            'name'=>'Operadores',
            'guard_name'=>'web'
        ]);
        DB::table('roles')->insert([
            'name'=>'Conductores',
            'guard_name'=>'web'
        ]);
        DB::table('roles')->insert([
            'name'=>'Hoteles',
            'guard_name'=>'web'
        ]);
        DB::table('roles')->insert([
            'name'=>'Usuarios',
            'guard_name'=>'web'
        ]);
        DB::table('users')->insert([
            'nombre' => 'Juan Sebastian',
            'apellido' => 'Moscoso',
            'email' => 'juanmos@gmail.com',
            'password' => bcrypt('123456'),
            'telefono' => '0991704980'
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type' => 'App\Models\User',
            'model_id' => '1'
        ]);
    }
}
