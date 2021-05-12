@extends('layouts.header')

@section('content')
<div class="container">
    <h2>User Dashboard</h2>
    <div class="row">
        <div class="col card bg-info mx-2 align-items-center">
            <div class="card-body text-center">
                <p>Evaluasi A...</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::find(46)) }}" class="stretched-link"></a>
            </div>
        </div>

        <div class="col card mx-2">
            <div class="card-body">
                <p>Evaluasi B...</p>
                <a href="{{ route('user.pertanyaan', App\Models\TipeEvaluasi::find(47)) }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-secondary" type="submit">Logout</button>
    </form>
</div>
@endsection
