<?php

use App\Answer;
use Illuminate\Database\Seeder;
use App\Question;
use App\Quiz;
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
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(QuizCategorysTableSeeder::class);
        $this->call(QuizTypesTableSeeder::class);
        $this->call(QuizsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(QuizTemporaryTableSeeder::class);
        $this->call(LeaderboardSeeder::class);

        // custom
        School::find(123)->update([
            'category' => 'SMA'
        ]);
    }
}
