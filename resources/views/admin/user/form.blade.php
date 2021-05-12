@extends('layouts.admin_header')

@section('title', "Tambah User")

@section('content')
<body>
    <form action={{ route('user.store') }} method="POST">
        @csrf
        <label for="name">Nama</label><br>
        <input type="text" name="name"><br>
        <label for="email">E-mail</label><br>
        <input type="email" name="email" id="email"><br>
        <label for="username">Username</label><br>
        <input type="text" name="username"><br>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>
@endsection
