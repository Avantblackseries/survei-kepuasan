<?php
namespace Database\Seeders;
use App\Models\Survey;
use App\Models\Question;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder {
    public function run(): void {
        $survey = Survey::create([
            'title' => 'Survei Kepuasan Pelanggan 2024',
            'description' => 'Bantu kami meningkatkan layanan dengan mengisi survei ini.',
            'is_active' => true,
        ]);

        $questions = [
            ['question_text' => 'Bagaimana penilaian Anda terhadap kualitas produk kami?', 'question_type' => 'rating', 'order' => 1],
            ['question_text' => 'Bagaimana penilaian Anda terhadap pelayanan kami?', 'question_type' => 'rating', 'order' => 2],
            ['question_text' => 'Bagaimana penilaian Anda terhadap harga produk kami?', 'question_type' => 'rating', 'order' => 3],
            ['question_text' => 'Seberapa besar kemungkinan Anda merekomendasikan kami kepada orang lain?', 'question_type' => 'rating', 'order' => 4],
            ['question_text' => 'Dari mana Anda mengetahui produk kami?', 'question_type' => 'multiple_choice', 'options' => 'Media Sosial,Teman/Keluarga,Iklan Online,Lainnya', 'order' => 5],
            ['question_text' => 'Saran dan masukan Anda untuk kami:', 'question_type' => 'text', 'order' => 6],
        ];

        foreach ($questions as $q) {
            Question::create(array_merge($q, ['survey_id' => $survey->id]));
        }
    }
}