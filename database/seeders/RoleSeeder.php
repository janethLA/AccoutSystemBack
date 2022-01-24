<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            
            'role_name' => 'ROLE_ADMIN',
            'description' => 'El admin se encarga de registrar usuarios',

        ]);

        Role::create([
            
            'role_name' => 'ROLE_USER_FINAL',
            'description' => 'El usuario va a poder registrar sus ingresos y egresos',

        ]);
    }
}
