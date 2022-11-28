<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Lecture;
use App\Collager;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'      => 'Developer',
            'username'  => 'developer',
            'email'     => 'developer@dev.com',
            'password'  =>  bcrypt('devpass'),
            'picture'   => 'avatar.png',
            'school_id' => 123
        ]);
        $admin->assignRole('admin');

        $teacher = User::create([
            'name'      => 'Teacher Dev',
            'username'  => 'teacherdev',
            'email'     => 'teacher@dev.com',
            'password'  =>  bcrypt('devpass'),
            'picture'   => 'avatar.png',
            'school_id' => 123
        ]);
        $teacher->assignRole('teacher');

        $student = User::create([
            'name'      => 'Student Dev',
            'username'  => 'studentdev',
            'email'     => 'student@dev.com',
            'password'  =>  bcrypt('devpass'),
            'picture'   => 'avatar.png',
            'school_id' => 123
        ]);
        $student->assignRole('student');
        
        for($i=0; $i<2; $i++) {
            $user = User::create([
                'name'      => 'User ' . ($i + 1),
                'username'  => 'user_' . ($i + 1),
                'email'     => 'user' . ($i + 1) . '@dev.com',
                'password'  =>  bcrypt('userpass'),
                'picture'   => 'avatar.png',
                'school_id' => 123
            ]);
            $user->assignRole('student');

            Collager::create([
                'user_id' => $user->id,
            ]);
        }

        Lecture::create([
            'user_id' => $teacher->id,
        ]);

        Collager::create([
           'user_id' => $admin->id,
        ]);
        Collager::create([
           'user_id' => $teacher->id,
        ]);
        Collager::create([
           'user_id' => $student->id,
        ]);
    }
}