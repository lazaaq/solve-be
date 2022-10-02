<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Lana',
            'username'  => 'lana10',
            'email'     => 'lana10@gmail.com',
            'password'  =>  bcrypt('password'),
            'picture'   => 'avatar.png',
        ]);
        $user->assignRole('student');
    }
}