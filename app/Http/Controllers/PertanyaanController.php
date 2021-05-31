<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Struktur;
use App\Models\TipeEvaluasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PertanyaanController extends Controller
{
    public function index()
    {
        $data = Pertanyaan::all();
        return view('admin.pertanyaan', ['data' => $data]);
        // return $data;
    }

    public function insert(Request $request)
    {
        $rules = [
            'type' => 'required',
            'pertanyaan' => 'required|max:255',
            'struktur' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $question = new Pertanyaan();
        $question->tipe_evaluasi_id = $request->type;
        $question->pertanyaan = $request->pertanyaan;
        $question->struktur_id = $request->struktur;

        if($question->save())
        {
            return redirect()->route('list_pertanyaan')->with('message', 'Berhasil menambahkan pertanyaan');
        }
        else
        {
            return redirect()->route('form_pertanyaan')->withErrors('Gagal menambahkan pertanyaan');
        }
    }

    public function detail($id)
    {
        $question = Pertanyaan::find($id);
        $types = TipeEvaluasi::all();
        $structures = Struktur::all();
        return view('admin.detail_pertanyaan', [
            "pertanyaan" => $question,
            "types" => $types,
            "structures" => $structures
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'tipe' => 'required',
            'pertanyaan' => 'required|max:255',
            'struktur' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $question = Pertanyaan::find($id);
        $question->pertanyaan = $request->pertanyaan;
        $question->tipe_evaluasi_id = $request->tipe;
        $question->struktur_id  = $request->struktur;

        if($question->save())
        {
            return redirect()->route('detail_pertanyaan', $id)->with('message', 'Berhasil mengupdate pertanyaan');
        }
        else
        {
            return redirect()->route('detail_pertanyaan', $id);
        }
    }

    public function delete($id)
    {
        $question = Pertanyaan::find($id);
        if($question->delete())
        {
            return redirect()->route('list_pertanyaan')->with('message', 'Pertanyaan dihapus');
        }
        else
        {
            return back();
        }
    }
}
