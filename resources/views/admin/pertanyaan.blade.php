@extends('layouts.admin_header')

@section('title', 'Pertanyaan')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Pertanyaan</th>
            <th>Tipe Evaluasi</th>
            <th>Struktur</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $pertanyaan)
            <tr>
                <td>
                    <a href={{ route('detail_pertanyaan', $pertanyaan->id) }}>{{ $pertanyaan->pertanyaan }}</a>
                </td>
                <td>{{ $pertanyaan->nama_tipe_evaluasi}}</td>
                <td>{{ $pertanyaan->nama_struktur }}</td>
                <td class="form-inline">
                    <a href={{ route('detail_pertanyaan', $pertanyaan->id) }} class="btn btn-warning form-group" role="button">Edit</a>
                    <form action={{ route('delete_pertanyaan', $pertanyaan->id) }} method="POST" class="form-group">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href={{ route('form_pertanyaan') }} class="btn btn-info" role="button">Add</a>
@endsection
