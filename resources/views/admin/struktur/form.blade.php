@extends('layouts.admin_header')

@section('title', "Tambah Struktur")

@section('content')
<body>
    @if ($errors->any())
        <div class="row alert alert-danger mx-3">
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        </div>
    @endif
    <div class="row mx-3">
        <form action={{ route('struktur.store') }} method="POST">
            @csrf
            <label for="name" class="form-label">Nama Struktur</label><br>
            <input type="text" name="name" class="form-control"><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
@endsection
