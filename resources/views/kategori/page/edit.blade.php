@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4>Ubah Kategori</h4>
            <hr>
            <form action="/update_kategori/{{ $category->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-4">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name  }}">
                </div>
                <button class="btn btn-primary w-100">Kirim</button>
                <a href="/kategori" class="btn btn-danger w-100 mt-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection