@extends('layouts.admin_header')

@section('title', 'Detail Pertanyaan')

@section('content')
    @if ($errors->any())
        <div class="row alert alert-danger">
        </ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        <ul>
        </div>
    @endif
    @if (session('message'))
        <div class="row alert alert-success mx-3">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif
    <div class="row mx-3">
        <form action={{ route('update_pertanyaan', $pertanyaan->id) }} method="POST">
            @csrf
            <div class="row form-check form-check-inline">
                <label for="tipe_evaluasi" class="form-label">Tipe Evaluasi</label>
                @foreach ($types as $type)
                    <input value={{ $type->id }} type="radio" name="tipe" id="{{ $type->id }}" class="form-check-input"
                    @if ($type->id == $pertanyaan->tipe_evaluasi_id)
                        checked
                    @endif>
                    <label for="{{ $type->id }}" class="form-check-label">{{ $type->nama_evaluasi }}</label>
                @endforeach
            </div>
            <div class="row">
                <label for="struktur" class="form-label">Struktur</label>
                <select name="struktur" id="struktur" class="form-control">
                    @foreach ($structures as $structure)
                        <option value={{ $structure->id }} @if ($structure->id == $pertanyaan->struktur_id)
                            selected="selected"
                        @endif>{{ $structure->nama_struktur }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="5">{{ $pertanyaan->pertanyaan }}</textarea>
            </div>
            <div class="row mt-2">
                <input type="submit" class="btn btn-primary mr-2" value="Save">
                <a href={{ route('list_pertanyaan') }} role="button" class="btn btn-secondary inline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
