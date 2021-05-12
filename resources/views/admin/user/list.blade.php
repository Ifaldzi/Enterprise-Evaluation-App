@extends('layouts.admin_header')

@section('title', 'User')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <a href={{ route('user.show', $user) }}>{{ $user->name }}</a>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td class="form-inline">
                    <a href={{ route('user.show', $user) }} class="btn btn-warning form-group" role="button">Edit</a>
                    <form action={{ route('user.destroy', $user) }} method="POST" class="form-group">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href={{ route('user.create') }} class="btn btn-info" role="button">Add</a>
@endsection
