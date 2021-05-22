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
    <div class="row">
        <div class="col card bg-info mx-2 align-items-center">
            <div class="card-body text-center">
                <p>Evaluasi A...</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Fungsionalitas')->first()) }}" class="stretched-link"></a>
            </div>
        </div>

        <div class="col card mx-2">
            <div class="card-body">
                <p>Evaluasi B...</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Efektivitas')->first()) }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="row">
        <a href="{{ route('user.lihat_hasil') }}" class="btn btn-primary">Lihat Hasil</a>
        <a href="{{ route('user.hasil_evaluasi') }}" class="btn btn-warning">Cetak Hasil</a>
    </div>

    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-secondary" type="submit">Logout</button>
    </form>
</div>
@endsection
