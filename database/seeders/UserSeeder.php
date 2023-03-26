<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Volvick',
            'last_name' => 'Derose',
            'name' => 'Admin',
            'role' => 1,
            'email' => 'admin@gmail.com',
            'phone_number' => '7000009909',
            'password' => bcrypt('123456')
        ]);
        
    }
}
