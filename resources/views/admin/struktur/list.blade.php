@extends('layouts.admin_header')

@section('title', 'Pertanyaan')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Struktur</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($struktur as $data)
            <tr>
                <td>
                    <a href={{ route('struktur.show', $data) }}>{{ $data->nama_struktur }}</a>
                </td>
                <td class="form-inline">
                    <a href={{ route('struktur.show', $data) }} class="btn btn-warning form-group" role="button">Edit</a>
                    <form action={{ route('struktur.destroy', $data) }} method="POST" class="form-group">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href={{ route('struktur.create') }} class="btn btn-info" role="button">Add</a>
@endsection
