@extends('layouts.admin_header')

@section('content')
    <h2>Detail Pertanyaan</h2>
    <form action={{ route('update_pertanyaan', $pertanyaan->id) }} method="POST">
        @csrf
        <label for="tipe_evaluasi">Tipe Evaluasi</label>
        <select name="tipe" id="tipe_evaluasi">
            @foreach ($types as $type)
                <option value={{ $type->id }} @if ($type->id == $pertanyaan->tipe_evaluasi_id)
                    selected = "selected"
                @endif>{{ $type->nama_tipe_evaluasi }}</option>
            @endforeach
        </select>
        <br>
        <label for="struktur">Struktur</label>
        <select name="struktur" id="struktur">
            @foreach ($structures as $structure)
                <option value={{ $structure->id }} @if ($structure->id == $pertanyaan->struktur_id)
                    selected="selected"
                @endif>{{ $structure->nama_struktur }}</option>
            @endforeach
        </select>
        <br>
        <label for="pertanyaan">Pertanyaan</label>
        <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="5">{{ $pertanyaan->pertanyaan }}</textarea>
        <br>
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
    <a href={{ url()->previous() }} role="button" class="btn btn-secondary">Cancel</a>
@endsection
