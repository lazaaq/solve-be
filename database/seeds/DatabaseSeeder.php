<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Lecture;
use App\Collager;
use App\School;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'teacher']);

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
        Lecture::create([
           'user_id' => $teacher->id,
        ]);

        $student = User::create([
            'name'      => 'Student Dev',
            'username'  => 'studentdev',
            'email'     => 'student@dev.com',
            'password'  =>  bcrypt('devpass'),
            'picture'   => 'avatar.png',
            'school_id' => 123
        ]);
        $student->assignRole('student');
        Collager::create([
           'user_id' => $student->id,
        ]);

        $this->call(QuizCategorysTableSeeder::class);
        $this->call(QuizTypesTableSeeder::class);
        $this->call(QuizsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(QuizTemporaryTableSeeder::class);

        // custom
        School::find(123)->update([
            'category' => 'SMA'
        ]);
    }
}
