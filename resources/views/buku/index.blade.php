@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @include('Buku.add-card')
        </div>
        <div class="col-md-8">
            <h4>Data Buku</h4>
            <hr>
            @if(count($books) != 0)
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $key => $book)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td class="d-flex gap-2">
                            <a href="/detail_buku/{{ $book->id }}" class="btn btn-success">Detail</a>
                            <a href="/edit_buku/{{ $book->id }}" class="btn btn-primary">Edit</a>
                            <form action="/delete_kategori/{{ $book->id }}" method="POST">
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
<script>
    $(document).ready(function() {
        $('.categoryAdd').select2()
    })
</script>
@endsection