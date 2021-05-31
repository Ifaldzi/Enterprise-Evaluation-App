@extends('layouts.admin_header')

@section('title', "Tambah User")

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

<div class="row mx-3">
    <div class="col-3">
        <form action={{ route('user.store') }} method="POST">
            @csrf
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
