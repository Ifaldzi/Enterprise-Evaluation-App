@extends('layouts.header')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Hasil Evaluasi {{ $tipeEvaluasi->nama_tipe_evaluasi }}
        </div>
        <div class="card-body text-center">
            <div class="row mb-2">
                <div class="col text-right">
                    Score Evaluasi {{ $tipeEvaluasi->nama_tipe_evaluasi }} :
                </div>
                <div class="col text-left">
                    {{ $score }} / {{ $maxScore }}
                </div>
            </div>
            <div class="row justify-content-center">
                <a href="#" class="btn btn-primary">Cetak Hasil</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>
    </div>
@endsection
