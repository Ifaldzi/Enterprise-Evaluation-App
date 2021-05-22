@extends('layouts.admin_header')

@section('title', "Tambah Pertanyaan")

@section('content')
<body>
    <h1>Form Pertanyaan</h1>
    <form action={{ route('insert_pertanyaan') }} method="POST">
        @csrf
        <label for="tipe">Tipe Evaluasi</label><br>
        @foreach ($types as $type)
            <label for={{ $type->id }}>{{ $type->nama_evaluasi }}</label>
            <input type="radio" name="type" id={{ $type->id }} value={{ $type->id }}>
        @endforeach
        <select name="struktur" id="">
            <option value="" disabled="disabled" selected="true">Struktur</option>
            @foreach ($structures as $structure)
                <option value={{ $structure->id }}>{{ $structure->nama_struktur }}</option>
            @endforeach
        </select>
        <br><label for="pertanyaan">Pertanyaan</label><br>
        <input type="text" name="pertanyaan"><br>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>
@endsection
