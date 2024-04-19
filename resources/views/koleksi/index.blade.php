@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <h4>Buku yang dikoleksi</h4>
    <hr>
    @if(count($collections) != 0)
    <table class="table table-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($collections as $key => $book)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                        <form action="/delete_koleksi/{{ $user->collections->where('book_id', $book->id)->first()->id }}" method="POST">
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
@endsection