@extends('layouts.admin_header')

@section('title', 'Detail User')

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
    <div class="col-3">
        <form action="{{ route('user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
            <label for="username">Username</label>
            <input type="text" name="username" disabled="disabled" value="{{ $user->username }}" class="form-control">
            <label for="password">Password</label>
            <input type="text" name="password" disabled="disabled" value="{{Crypt::decrypt($user->password)}}" class="form-control">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href={{ route('user.index') }} role="button" class="btn btn-secondary inline">Cancel</a>
        </form>
    </div>
</div>
@endsection
