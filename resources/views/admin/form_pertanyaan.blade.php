@extends('layouts.admin_header')

@section('title', "Tambah Pertanyaan")

@section('content')
<body>
    @if ($errors->any())
        <div class="row alert alert-danger mx-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-left mx-3">
        <form action={{ route('insert_pertanyaan') }} method="POST">
            @csrf
            <label for="tipe" class="form-label">Tipe Evaluasi</label>
            @foreach ($types as $type)
            <div class="form-check form-check-inline">
                <input type="radio" name="type" id={{ $type->id }} value={{ $type->id }} class="form-check-input">
                <label for={{ $type->id }} class="form-check-label">{{ $type->nama_evaluasi }}</label>
            </div>
            @endforeach
            <select name="struktur" id="" class="custom-select">
                <option value="" disabled="disabled" selected="true" class="dropdown-item">Struktur</option>
                @foreach ($structures as $structure)
                    <option value={{ $structure->id }} class="dropdown-item">{{ $structure->nama_struktur }}</option>
                @endforeach
            </select>
            <label for="pertanyaan" class="form-label">Pertanyaan</label>
            <input type="text" name="pertanyaan" value="{{ old('pertanyaan') }}" class="form-control">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
@endsection
