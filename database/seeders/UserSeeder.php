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
            'registration_date' => '2021-10-11',
            'expiry_date' => '2022-10-11',
            'active' => true,
            'role_id'=>1,

        ]);
    }
}
