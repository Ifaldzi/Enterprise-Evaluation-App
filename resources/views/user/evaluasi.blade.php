@extends('layouts.header')

@section('content')
<div class="container">
    <h2>Pilih Evaluasi</h2>

    @if (session('message'))
        <div class="row alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (isset($complete))
        <div class="row mt-2 alert alert-success">
            Sudah melakukan evaluasi, silakan cetak hasil
        </div>
        <div class="row mt-2">
            <div class="col-8 mx-auto btn btn-primary py-2 my-auto">
                <h3>Cetak Hasil</h3>
                <a href="{{ route('user.hasil_evaluasi') }}" class="stretched-link"></a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-8 mx-auto py-2 my-auto justify-content-center btn btn-warning">
                <form action="{{ route('user.ulang_evaluasi') }}" method="post">
                    @csrf
                    <h3>Lakukan Evaluasi Ulang</h3>
                    <button type="hidden" class="btn btn-warning stretched-link"></button>
                </form>
            </div>
        </div>
    @else
        <div class="row">
            @if (!isset($empty) || $empty=='fungsionalitas')
                <div class="col card bg-info mx-2 align-items-center">
                    <div class="card-body text-center">
                        <p>Evaluasi Fungsionalitas</p>
                        <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Fungsionalitas')->first()) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endif
            @if (!isset($empty) || $empty=='efektivitas')
                <div class="col card mx-2">
                    <div class="card-body text-center">
                        <p>Evaluasi Efektivitas</p>
                        <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::where('nama_evaluasi', '=', 'Efektivitas')->first()) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="row mt-2">
        <div class="col">
            <a  class="btn btn-secondary" href="{{ route('home') }}">Dashboard</a>
        </div>
    </div>

</div>
@endsection
