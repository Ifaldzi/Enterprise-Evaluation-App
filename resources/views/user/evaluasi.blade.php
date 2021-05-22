@extends('layouts.header')

@section('content')
<div class="container">
    <h2>Pilih Evaluasi</h2>

    <div class="row">
        <div class="col card bg-info mx-2 align-items-center">
            <div class="card-body text-center">
                <p>Evaluasi Fungsionalitas</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Fungsionalitas')->first()) }}" class="stretched-link"></a>
            </div>
        </div>

        <div class="col card mx-2">
            <div class="card-body text-center">
                <p>Evaluasi Efektivitas</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Efektivitas')->first()) }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

</div>
@endsection
