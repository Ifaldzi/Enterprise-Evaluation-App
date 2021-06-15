@extends('layouts.header')

@section('content')
<div class="container">
    <h2>User Dashboard</h2>

    @if (session('message'))
        <div class="row alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @error('print_score')
        <div class="row alert alert-danger">{{ $message }}</div>
    @enderror

    @if ($hasil && $hasil->keterangan)
    <div class="row mb-3">
        <div class="col-8 p-0 mx-auto card">
            <div class="text-center card-header">
                Hasil Evaluasi Terakhir
            </div>
            <div class="text-center card-body">
                <div class="row mb-2">
                    <div class="col text-right">
                        Tanggal Evaluasi :
                    </div>
                    <div class="col text-left">
                        {{ $hasil->updated_at }}
                    </div>
                </div>
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
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-8 mx-auto btn btn-info py-5">
            <h2>Evaluasi</h2>
            <a href="{{ route('user.evaluasi') }}" class="stretched-link"></a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-8 mx-auto btn btn-warning py-2 my-auto">
            <h3>Cetak Hasil</h3>
            <a href="{{ route('user.hasil_evaluasi') }}" class="stretched-link"></a>
        </div>
    </div>

    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-secondary" type="submit">Logout</button>
    </form>
</div>
@endsection
