<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LearningModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        /**
         * ================================
         * MODULE 1 — VIDEO + POPUP QUIZ
         * ================================
         */
        $moduleId = DB::table('learning_modules')->insertGetId([
            'title' => 'Phishing Awareness',
            'description' => 'Pelatihan mengenali serangan phishing.',
            'estimated_minutes' => 10,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Assignment ke semua user
        DB::table('learning_module_assignments')->insert([
            'module_id' => $moduleId,
            'scope' => 'all',
            'scope_value' => null,
            'is_mandatory' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Video utama
        $videoId = DB::table('learning_contents')->insertGetId([
            'module_id' => $moduleId,
            'type' => 'video',
            'title' => 'Video Phishing',
            'body' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'order_no' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Popup Quiz di detik 30
        $popupQuiz1 = DB::table('learning_contents')->insertGetId([
            'module_id' => $moduleId,
            'type' => 'quiz',
            'title' => 'Quiz Popup 30s',
            'order_no' => 2,
            'parent_content_id' => $videoId,
            'trigger_second' => 30,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Popup Quiz di detik 90
        $popupQuiz2 = DB::table('learning_contents')->insertGetId([
            'module_id' => $moduleId,
            'type' => 'quiz',
            'title' => 'Quiz Popup 90s',
            'order_no' => 3,
            'parent_content_id' => $videoId,
            'trigger_second' => 90,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Text bacaan
        DB::table('learning_contents')->insert([
            'module_id' => $moduleId,
            'type' => 'text',
            'title' => 'Cara Menghindari Phishing',
            'body' => 'Jangan klik link sembarangan...',
            'order_no' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Final Quiz (standalone)
        $finalQuiz = DB::table('learning_contents')->insertGetId([
            'module_id' => $moduleId,
            'type' => 'quiz',
            'title' => 'Final Quiz',
            'order_no' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->insertQuiz($popupQuiz1, $now);
        $this->insertQuiz($popupQuiz2, $now);
        $this->insertQuiz($finalQuiz, $now);

        /**
         * ================================
         * MODULE 2 — QUIZ ONLY
         * ================================
         */
        $quizOnlyModuleId = DB::table('learning_modules')->insertGetId([
            'title' => 'Security Pretest',
            'description' => 'Pretest sebelum pelatihan security.',
            'estimated_minutes' => 5,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('learning_module_assignments')->insert([
            'module_id' => $quizOnlyModuleId,
            'scope' => 'all',
            'scope_value' => null,
            'is_mandatory' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $quizOnlyContent = DB::table('learning_contents')->insertGetId([
            'module_id' => $quizOnlyModuleId,
            'type' => 'quiz',
            'title' => 'Pretest Quiz',
            'order_no' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->insertQuiz($quizOnlyContent, $now);
    }

    private function insertQuiz($contentId, $now)
    {
        $questionId = DB::table('learning_quiz_questions')->insertGetId([
            'content_id' => $contentId,
            'question' => 'Apa yang harus dilakukan jika menerima email mencurigakan?',
            'type' => 'multiple_choice',
            'order_no' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('learning_quiz_options')->insert([
            [
                'question_id' => $questionId,
                'option_text' => 'Klik linknya',
                'is_correct' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => $questionId,
                'option_text' => 'Laporkan ke IT / abaikan',
                'is_correct' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
