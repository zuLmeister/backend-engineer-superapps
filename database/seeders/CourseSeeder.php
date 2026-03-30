<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Course 1
        $c1 = Course::create([
            'title' => 'Belajar React Dasar',
            'description' => 'Pengenalan React: komponen, props, state.',
            // Gunakan link youtube (bisa watch url atau embed). ReactPlayer mendukung banyak format.
            'video_url' => 'https://www.youtube.com/watch?v=Ke90Tje7VS0',
        ]);

        $c1->quizzes()->createMany([
            [
                'time' => 10,
                'question' => 'Apa itu komponen di React?',
                'answer' => 'bagian UI', // contoh sederhana
            ],
            [
                'time' => 30,
                'question' => 'Hook useState dipakai untuk?',
                'answer' => 'state',
            ],
        ]);

        // Course 2
        $c2 = Course::create([
            'title' => 'HTML & CSS Fundamental',
            'description' => 'Dasar-dasar struktur HTML dan styling dengan CSS.',
            'video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
        ]);

        $c2->quizzes()->createMany([
            [
                'time' => 8,
                'question' => 'Tag HTML untuk paragraf apa?',
                'answer' => 'p',
            ],
            [
                'time' => 25,
                'question' => 'Properti CSS untuk warna teks?',
                'answer' => 'color',
            ],
        ]);
    }
}
