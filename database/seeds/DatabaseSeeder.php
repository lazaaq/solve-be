<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([['name' => 'admin'],['name' => 'user']]);
        $user = User::create([
            'name'      => 'Developer',
            'username'  => 'developer',
            'email'     => 'developer@dev.com',
            'password'  =>  bcrypt('devpass'),
        ]);

        $user->assignRole('admin');
    }
}
