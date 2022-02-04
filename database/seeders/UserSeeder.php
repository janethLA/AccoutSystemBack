<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            
            'name' => 'Admin',
            'user_name' => 'Admin',
            'password' => bcrypt('admin2021'),
            'telephone' => '78787878',
            'registration_date' => now(),
            'expiry_date' => null,
            'active' => true,
            'role_id'=>1,

        ]);
    }
}
