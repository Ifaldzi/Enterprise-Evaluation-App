@extends('layouts.header')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Hasil Evaluasi
        </div>
        <div class="card-body text-center">
            <div class="row mb-2">
                <div class="col text-right">
                    Skor Efektivitas :
                </div>
                <div class="col text-left">
                    {{ $hasil->score_efektivitas }}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col text-right">
                    Skor Fungsionalitas :
                </div>
                <div class="col text-left">
                    {{ $hasil->score_fungsionalitas }}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col text-right">
                    Status :
                </div>
                <div class="col text-left">
                    {{ $hasil->keterangan }}
                </div>
            </div>
            @isset($message)
            <div class="row alert alert-danger">
                {{ $message }}
            </div>
            @endisset
            <div class="row justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>
    </div>
@endsection
