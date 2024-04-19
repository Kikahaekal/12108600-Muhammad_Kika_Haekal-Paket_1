@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @include('kategori.add-card')
        </div>
        <div class="col-md-8">
            <h4>Data Kategori</h4>
            <hr>
            @if(count($categories) != 0)
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex gap-2">
                            <a href="/edit_kategori/{{ $category->id }}" class="btn btn-primary">Edit</a>
                            <form action="/delete_kategori/{{ $category->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="bg-light p-4 text-center">
                <p>Tidak ada data</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection