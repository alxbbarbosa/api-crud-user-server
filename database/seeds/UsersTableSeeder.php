<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
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
            'email' => 'admin@test.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => date("Y-m-d g:i:s")
        ]);
    }
}
