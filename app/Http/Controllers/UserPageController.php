<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\TipeEvaluasi;
use App\Models\User;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    private const MAX_POINT = 3;

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
        $user = User::find(Auth::id());
        foreach($answers as $key => $answer)
        {
            $pertanyaanId = str_replace('jawaban', '', $key);
            if($user->pertanyaan()->wherePivot('pertanyaan_id', $pertanyaanId)->exists())
                $user->pertanyaan()->updateExistingPivot($pertanyaanId, ['jawaban' => $answer]);
            else
                $user->pertanyaan()->attach($pertanyaanId, ['jawaban' => $answer]);
            $score += $answer;
        }
        return redirect()->route('home')->with('message', 'Evaluasi '.$tipeEvaluasi->nama_evaluasi.' Berhasil Dilaksanakan');
    }

    public function showResult()
    {
        $user = User::find(Auth::id());
        $hasil = $user->hasil()->orderBy('created_at', 'desc')->first();
        // return $hasil;
        return view('user.hasil', compact('hasil'));
    }

    public function printResult()
    {
        $user = User::find(Auth::id());
        $count = $user->pertanyaan->countBy('tipe_evaluasi_id')->count();
        if($count == 2)
        {
            // return "continue";
            $types = TipeEvaluasi::all();
            $scores = collect();
            $unapprovedEvaluationType = collect();
            $hasil = new Hasil();
            $hasil->user_id = $user->id;
            $approved = true;
            foreach($types as $type)
            {
                $maxScore = $type->pertanyaan->count() * self::MAX_POINT;
                $score = $user->pertanyaan->where('tipe_evaluasi_id', $type->id)->sum('jawaban.jawaban');
                if($score <= ($maxScore/2))
                {
                    $approved = false;
                    $unapprovedEvaluationType->push($type->nama_evaluasi);
                }
                if($type->nama_evaluasi == 'Fungsionalitas')
                    $hasil->score_fungsionalitas = $score;
                else
                    $hasil->score_efektivitas = $score;
                $scores->put($type->id, $score);
            }
            if($approved)
                $keterangan = 'Diterima / Masih sesuai';
            else
                $keterangan = 'Tidak diterima / Perlu dirancang ulang';
            $hasil->keterangan = $keterangan;
            $hasil->save();
            if($approved)
                return view('user.hasil', compact('hasil'));
            $message = 'Skor' . implode(" & ", $unapprovedEvaluationType->toArray()) . 'Tidak Memenuhi';
            return view('user.hasil', compact('hasil'))->with('message', $message);
        }
        return redirect()->back()->withErrors(['print_score' => 'Tidak bisa mencetak hasil dikarenakan belum melakukan evaluasi']);
    }
}
