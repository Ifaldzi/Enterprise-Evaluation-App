<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\TipeEvaluasi;
use App\Models\User;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class UserPageController extends Controller
{
    private const MAX_POINT = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->is_admin)
            return redirect()->route('admin.dashboard');
        $hasil = Hasil::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->first();
        return view('user.dashboard', compact('hasil'));
    }

    public function showQuestion(TipeEvaluasi $tipeEvaluasi)
    {
        $pertanyaan = $tipeEvaluasi->pertanyaan->sortBy('struktur_id')->values()->all();
        return view('user.list_pertanyaan', compact('pertanyaan', 'tipeEvaluasi'));
    }

    public function showEvaluationPage()
    {
        $user = Auth::user();
        $hasil = $user->hasil->sortByDesc('created_at')->first();
        // return $hasil;
        if(!$hasil)
        {
            Hasil::create(['user_id' => $user->id]);
            return view('user.evaluasi');
        }
        if(!isset($hasil->score_fungsionalitas) && !isset($hasil->score_efektivitas))
            return view('user.evaluasi');
        if(!isset($hasil->score_fungsionalitas))
            return view('user.evaluasi')->with('empty', 'fungsionalitas');
        if(!isset($hasil->score_efektivitas))
            return view('user.evaluasi')->with('empty', 'efektivitas');
        return view('user.evaluasi')->with('complete', true);
    }

    public function submitAnswer(TipeEvaluasi $tipeEvaluasi, Request $answers)
    {
        $pertanyaan = $tipeEvaluasi->pertanyaan;
        $valids = array();
        foreach ($pertanyaan as $data) {
            $valids['jawaban'.$data->id] = "required";
        }
        $validator = validator($answers->all(), $valids);
        if($validator->fails())
        {
            return redirect()->back()->withErrors(['submit' => 'Semua pertanyaan belum terisi'])->withInput($answers->all());
        }
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
        $hasil = $user->hasil()->orderBy('created_at', 'desc');
        if($hasil)
        {
            if($tipeEvaluasi->nama_evaluasi == 'Fungsionalitas')
                $hasil->update(['score_fungsionalitas' => $score]);
            else
                $hasil->update(['score_efektivitas' => $score]);
        }
        return redirect()->route('user.evaluasi')->with('message', 'Evaluasi '.$tipeEvaluasi->nama_evaluasi.' Berhasil Dilaksanakan');
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
        $hasil = $user->hasil()->orderBy('created_at', 'desc')->first();
        if($hasil)
        {
            if($hasil->keterangan)
                return view('user.hasil', compact('hasil'));
            if(isset($hasil->score_fungsionalitas) && isset($hasil->score_efektivitas))
            {
                // return "continue";
                $types = TipeEvaluasi::all();
                $scores = collect();
                $unapprovedEvaluationType = collect();
                // $hasil->user_id = $user->id;
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
                    $scores->put($type->id, $score);
                }
                if($approved)
                    $keterangan = 'Diterima / Masih sesuai';
                else
                    $keterangan = 'Tidak diterima / Perlu dirancang ulang';

                $hasil->update(['keterangan' => $keterangan]);
                if($approved)
                    return view('user.hasil', compact('hasil'));
                $message = 'Skor' . implode(" & ", $unapprovedEvaluationType->toArray()) . 'Tidak Memenuhi';
                return view('user.hasil', compact('hasil'))->with('message', $message);
            }
        }
        return redirect()->back()->withErrors(['print_score' => 'Tidak bisa mencetak hasil dikarenakan belum melakukan semua evaluasi']);
    }

    public function reattemptEvaluation()
    {
        $user = Auth::user();
        Hasil::create(['user_id' => $user->id]);
        return route('user.evaluasi');
    }
}
