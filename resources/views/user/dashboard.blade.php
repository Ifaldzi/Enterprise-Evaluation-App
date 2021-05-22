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

    <div class="row">
        <a href="{{ route('user.lihat_hasil') }}" class="btn btn-primary">Lihat Hasil</a>
    </div>

    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-secondary" type="submit">Logout</button>
    </form>
</div>
@endsection
