@extends('layouts.header')

@section('content')
<div class="container my-3">
    @error('submit')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <form action="{{ route('user.submit_answer', $tipeEvaluasi) }}" method="POST">
        @csrf
        <div class="border bg-white p-2">
            @foreach ($pertanyaan as $data)
                <div class="row align-item-center">
                <div class="col">
                    <p>{{ $data->struktur->nama_struktur }}</p>
                </div>
                <div class="col">
                    <p>{{ $data->pertanyaan }}</p>
                </div>
                <div class="col">
                    @for ($i=0; $i<4; $i++)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jawaban{{$data->id}}" id="jawaban{{$data->id}}" value="{{ $i }}" @if ((old('jawaban'.$data->id)) != null && old('jawaban'.$data->id) == $i)
                            checked="false"
                        @endif>
                        <label class="form-check-label" for="jawaban{{$data->id}}">{{$i}}</label>
                    </div>
                    @endfor
                </div>
                </div>
            @endforeach
        </div>
        <input type="submit" value="submit" class="btn btn-primary mt-2">
    </form>
</div>
@endsection
