@extends('layouts.admin_header')

@section('title', "Tambah Struktur")

@section('content')
<body>
    <form action={{ route('struktur.store') }} method="POST">
        @csrf
        <label for="name">Pertanyaan</label><br>
        <input type="text" name="name"><br>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>
@endsection
