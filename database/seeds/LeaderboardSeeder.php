<?php

use App\Collager;
use App\QuizCollager;
use Illuminate\Database\Seeder;

class LeaderboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collagers = Collager::all()->count();
        for($i=0; $i<3; $i++) {
            for($j=0; $j<$collagers; $j++) {
                QuizCollager::create([
                    "quiz_id" => $i + 1,
                    "collager_id" => $j + 1,
                    "total_score" => rand(1, 100)
                ]);
            }
        }
    }
}
