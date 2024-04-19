@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="/buku" class="btn btn-danger">Kembali</a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('img/'. $book->cover) }}" alt="cover" class="w-75 h-100">
                </div>
                <div class="col-md-8">
                    <table border="0" class="w-75 h-100">
                        <tr>
                            <td>Judul</td>
                            <td>:</td>
                            <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td>:</td>
                            <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                            <td>Tahun Rilis</td>
                            <td>:</td>
                            <td>{{ $book->publication_year }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>
                                @foreach ($book->categories as $category)
                                    {{ $category->name }}<br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Stok Buku</td>
                            <td>:</td>
                            <td>{{ $book->stock }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection