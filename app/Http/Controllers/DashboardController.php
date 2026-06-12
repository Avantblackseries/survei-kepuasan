<?php
namespace App\Http\Controllers;
use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function admin() {
        $totalSurveys = Survey::count();
        $totalResponses = Response::count();
        $totalUsers = User::where('role', 'user')->count();
        $surveys = Survey::withCount('responses')->get();
        return view('admin.dashboard', compact('totalSurveys', 'totalResponses', 'totalUsers', 'surveys'));
    }

    public function user() {
        $surveys = Survey::where('is_active', true)->get();
        $completedSurveyIds = Response::where('user_id', Auth::id())->pluck('survey_id')->toArray();
        return view('user.dashboard', compact('surveys', 'completedSurveyIds'));
    }
}