@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <h4>Daftar Buku yang Dipinjam</h4>
    <hr>
    @if(count($user->books) != 0)
    <table class="table table-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Dipinjam pada</th>
                <th>Dikembalikan pada</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->books as $key => $book)
                <td>{{ ++$key }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ \Carbon\Carbon::parse($book->pivot->borrow_date)->format('j F Y') }}</td>
                <td>{{ $book->pivot->return_date != null ? \Carbon\Carbon::parse($book->pivot->return_date)->format('j F Y') : 'Belum dikembalikan' }}</td>
                <td>{{ $book->pivot->status == 1 ? 'Dipinjam' : 'Dikembalikan' }}</td>
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