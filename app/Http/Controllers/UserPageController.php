<?php

namespace App\Http\Controllers;

use App\Models\TipeEvaluasi;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showQuestion(TipeEvaluasi $tipeEvaluasi)
    {
        $pertanyaan = $tipeEvaluasi->pertanyaan->sortBy('struktur_id')->values()->all();
        return view('user.list_pertanyaan', compact('pertanyaan', 'tipeEvaluasi'));
    }

    public function submitAnswer(TipeEvaluasi $tipeEvaluasi, Request $answers)
    {
        $answers = $answers->except('_token');
        $score = 0;
        foreach($answers as $answer)
        {
            $score += $answer;
        }
        return redirect()->route('user.hasil', ['score' => $score, 'tipeEvaluasi' => $tipeEvaluasi]);
    }

    public function showScore(TipeEvaluasi $tipeEvaluasi, Request $request)
    {
        $score = $request->score;
        return view('user.hasil', compact('tipeEvaluasi', 'score'));
    }
}
