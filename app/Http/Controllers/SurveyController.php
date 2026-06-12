<?php
namespace App\Http\Controllers;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use App\Models\Answer;
use Illuminate\Http\Request;

class SurveyController extends Controller {
    public function index() {
        $surveys = Survey::withCount('responses')->latest()->get();
        return view('admin.surveys.index', compact('surveys'));
    }

    public function create() {
        return view('admin.surveys.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $survey = Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->questions) {
            foreach ($request->questions as $i => $q) {
                if (!empty($q['question_text'])) {
                    Question::create([
                        'survey_id' => $survey->id,
                        'question_text' => $q['question_text'],
                        'question_type' => $q['question_type'],
                        'options' => $q['options'] ?? null,
                        'order' => $i + 1,
                    ]);
                }
            }
        }

        return redirect()->route('surveys.index')->with('success', 'Survei berhasil dibuat!');
    }

    public function show(Survey $survey) {
        $survey->load('questions', 'responses.answers.question', 'responses.user');
        $avgRatings = [];
        foreach ($survey->questions->where('question_type', 'rating') as $q) {
            $answers = Answer::where('question_id', $q->id)->get();
            $avgRatings[$q->id] = $answers->count() > 0 ? round($answers->avg('answer_text'), 1) : 0;
        }
        return view('admin.surveys.show', compact('survey', 'avgRatings'));
    }

    public function edit(Survey $survey) {
        $survey->load('questions');
        return view('admin.surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey) {
        $request->validate(['title' => 'required|string|max:255']);
        $survey->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('surveys.index')->with('success', 'Survei berhasil diperbarui!');
    }

    public function destroy(Survey $survey) {
        $survey->delete();
        return redirect()->route('surveys.index')->with('success', 'Survei berhasil dihapus!');
    }
}