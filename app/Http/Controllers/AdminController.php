<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;
use App\Models\TipeEvaluasi;

class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function showQuestionForm()
    {
        $types = TipeEvaluasi::all();
        $structures = Struktur::all();
        return view('admin.form_pertanyaan', [
            'types' => $types,
            'structures' => $structures
        ]);
    }
}
