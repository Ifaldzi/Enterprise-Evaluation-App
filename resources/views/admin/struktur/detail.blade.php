@extends('layouts.admin_header')

@section('title', 'Detail Struktur')

@section('content')
    @if ($errors->any())
        <div class="row alert alert-danger mx-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <div class="row alert alert-success mx-3">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <div class="row mx-3">
        <div class="col-5">
            <form action="{{ route('struktur.update', $struktur) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="name" class="form-label">Nama Struktur</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $struktur->nama_struktur }}">
                <input type="submit" class="btn btn-primary" value="Save">
                <a href={{ route('struktur.index') }} role="button" class="btn btn-secondary inline">Cancel</a>
            </form>
        </div>
    </div>
@endsection
