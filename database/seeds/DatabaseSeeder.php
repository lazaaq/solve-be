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

        // custom
        School::find(123)->update([
            'category' => 'SMA'
        ]);
        $ksnk21Quiz = Quiz::create([
            'quiz_type_id' => 25,
            'code' => 'KSNK2021',
            'title' => 'Soal KSN-K Matematika SMA 2021',
            'description' => 'KSN-K merupakan singkatan dari Kompetisi Sains Nasional tingkat Kota/Kabupaten',
            'pic_url' => 'blank.jpg',
            'sum_question' => 10,
            'tot_visible' => 10,
            'status' => 'active',
            'start_time' => '2019-12-01 00:00:00',
            'end_time' => '2024-12-31 23:59:00',
            'created_at' => '2019-12-18 11:20:37',
            'updated_at' => '2019-12-20 06:17:22',
            'deleted_at' => NULL,
        ]);
        $questions = array(
            'Pada suatu lingkaran dengan jari-jari r, terdapat segiempat talibusur ABC D dengan AB = 8 dan C D = 5. Sisi AB dan DC diperpanjang dan berpotongan di luar lingkaran di titik P. Jika ∠APD = 60◦ dan BP = 6, maka nilai dari r^2 adalah',
            'Bilangan 1,2,3,··· ,999 digit-digitnya disusun membentuk angka baru m dengan menuliskan semua
            digit bilangan-bilangan tadi dari kiri ke kanan. Jadi, m = 1234 · 91011 ··· 999. Hasil penjumlahan digit
            ke-2021, 2022, 2023 dari m adalah',
            'Diketahui ada 6 pasang suami-istri. Dari keenam pasangan tersebut, dipilih 6 orang secara acak. Banyaknya cara untuk memilih 6 orang tersebut sehingga paling banyak terdapat sepasang suami-istri adalah',
            'Diketahui segitiga ABC dengan AB > AC. Garis bagi sudut BAC memotong BC di titik D. Titik E dan F
            berturut-turut terletak pada sisi AC dan AB sehingga DE sejajar AB dan DF sejajar AC. Lingkaran luar
            4BC E memotong sisi AB di titik K. Jika luas segitiga C DE adalah 75 dan luas segitiga DE F adalah 85,
            maka luas segiempat DEK F adalah',
            'Jika dua digit terakhir dari a^777 adalah 77, maka dua digit terkahir dari a adalah',
            'Banyak fungsi (pemetaan) dari A = {1, 2, 3, 4, 5} ke B = {6, 7, 8, 9, 10} dengan syarat 9 dan 10 mempunyai prapeta, yaitu ada x dan y di A sehingga f(x) = 9 dan f(y) = 10 adalah',
            'Banyaknya barisan ternary (sukunya 0, 1 atau 2) yang memuat 15 suku, memuat tepat 5 (angka) 0 dan
            setiap di antara dua (angka) 0 ada paling sedikit dua suku bukan 0 adalah',
            'Sebuah papan catur berukuran 109 × 21 akan dipasangi beberapa ubin berukuran 3 × 1. Berapa ubin
            terbanyak yang bisa dipasang pada papan sehingga tidak ada 2 ubin yang bertumpuk atau bersentuhan?
            (Bersentuhan pada titik sudut ubin juga tidak diperbolehkan)',
            'Misalkan a, b, c bilangan real tak negatif dengan a + 2b + 3c = 1. Nilai maksimum
            dari ab + 2ac adalah',
            'Suatu komite yang terdiri dari beberapa anggota hendak menghadiri 40 rapat. Diketahui bahwa setiap rapat dihadiri tepat 10 anggota komite dan setiap dua anggota
            menghadiri rapat bersama paling banyak satu kali. Banyaknya anggota komite
            terkecil yang mungkin adalah'
        );
        $options = array('A', 'B', 'C', 'D', 'E');
        $answers = array(
            array('41','42','43','44','45',),
            array('8','9','10','11','12',),
            array('542','543','544','545','546',),
            array('94','95','96','97','98',),
            array('14','15','16','17','18',),
            array('1024','512','19280','10000','17920',),
            array('240','260','280','300','320',),
            array('14','15','16','17','18',),
            array('1/6','1/3','1/2','1/5','1/4',),
            array('61','62','63','64','65',),
        );
        $correctAnswer = array(2, 0, 2, 1, 3, 4, 2, 2, 0, 0);
        for($i=0; $i<count($questions); $i++) {
            $newQuestion = Question::create([
                'quiz_id' => $ksnk21Quiz->id,
                'question' => $questions[$i],
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ]);
            for($j=0; $j<count($answers[$i]); $j++) {
                if($correctAnswer[$i] == $j) {
                    Answer::create([
                        'question_id' => $newQuestion->id,
                        'option' => $options[$j],
                        'content' => $answers[$i][$j],
                        'pic_url' => '',
                        'isTrue' => 1,
                        'created_at' => '2019-12-18 11:23:29',
                        'updated_at' => '2019-12-18 11:23:29',
                        'deleted_at' => NULL,
                    ]);
                } else {
                    Answer::create([
                        'question_id' => $newQuestion->id,
                        'option' => $options[$j],
                        'content' => $answers[$i][$j],
                        'pic_url' => '',
                        'isTrue' => 0,
                        'created_at' => '2019-12-18 11:23:29',
                        'updated_at' => '2019-12-18 11:23:29',
                        'deleted_at' => NULL,
                    ]);
                }
            }
        }
    }
}
