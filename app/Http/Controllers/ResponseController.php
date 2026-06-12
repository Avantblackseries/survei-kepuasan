<?php
namespace App\Http\Controllers;
use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller {
    public function take(Survey $survey) {
        $alreadyDone = Response::where('survey_id', $survey->id)
            ->where('user_id', Auth::id())->exists();
        if ($alreadyDone) {
            return redirect()->route('user.dashboard')->with('error', 'Kamu sudah mengisi survei ini!');
        }
        $survey->load('questions');
        return view('user.take_survey', compact('survey'));
    }

    public function submit(Request $request, Survey $survey) {
        $alreadyDone = Response::where('survey_id', $survey->id)
            ->where('user_id', Auth::id())->exists();
        if ($alreadyDone) {
            return redirect()->route('user.dashboard')->with('error', 'Kamu sudah mengisi survei ini!');
        }

        $response = Response::create([
            'survey_id' => $survey->id,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->answers as $questionId => $answerText) {
            Answer::create([
                'response_id' => $response->id,
                'question_id' => $questionId,
                'answer_text' => is_array($answerText) ? implode(', ', $answerText) : $answerText,
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Terima kasih! Survei berhasil dikirim!');
    }

    public function myResponses() {
        $responses = Response::where('user_id', Auth::id())
            ->with('survey', 'answers.question')->latest()->get();
        return view('user.my_responses', compact('responses'));
    }
}