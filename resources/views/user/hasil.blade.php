@extends('layouts.header')

@section('content')
    <div class="card">
        <div class="card-header">
            Score
        </div>
        <div class="card-body text-center">
            {{ $score }}
        </div>
    </div>
@endsection
