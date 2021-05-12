@extends('layouts.admin_header')

@section('content')
    <h2>Detail Struktur</h2>
    <form action="{{ route('struktur.update', $struktur) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama Struktur</label>
        <input name="name" id="name" value="{{ $struktur->nama_struktur }}">
        <br>
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
    <a href={{ route('struktur.index') }} role="button" class="btn btn-secondary">Cancel</a>
@endsection
