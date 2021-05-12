@extends('layouts.admin_header')

@section('content')
    <h2>Detail User</h2>
    <form action="{{ route('user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama</label><br>
        <input type="text" name="name" value="{{ $user->name }}"><br>
        <label for="email">E-mail</label><br>
        <input type="email" name="email" id="email" value="{{ $user->email }}"><br>
        <label for="username">Username</label><br>
        <input type="text" name="username" disabled="disabled" value="{{ $user->username }}"><br>
        <label for="password">Password</label><br>
        <input type="text" name="password" disabled="disabled" value="{{Crypt::decrypt($user->password)}}"><br>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <a href={{ route('user.index') }} role="button" class="btn btn-secondary">Cancel</a>
@endsection
