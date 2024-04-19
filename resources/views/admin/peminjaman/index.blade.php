@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="d-flex">
        <h4>Daftar Peminjaman</h4>
        <a href="/export_peminjaman" class="btn btn-primary ms-auto">Export</a>
    </div>
    <hr>
    <table class="table table-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku yang dipinjam</th>
                <th>Dipinjam pada</th>
                <th>Dikembalikan pada</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            @if(count($user->books) != 0)
            @foreach ($user->books as $book)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ \Carbon\Carbon::parse($book->pivot->borrow_date)->format('j F Y') }}</td>
                <td>{{ $book->pivot->return_date != null ? \Carbon\Carbon::parse($book->pivot->return_date)->format('j F Y') : 'Belum dikembalikan' }}</td>
                <td>{{ $book->pivot->status == 1 ? 'Dipinjam' : 'Dikembalikan' }}</td>
                <td>
                    @if(\Carbon\Carbon::now() > \Carbon\Carbon::parse($book->pivot->due_date))
                    <form action="/tarik_peminjaman/{{ $book->id }}" method="POST">
                        <button class="btn btn-danger">Tarik Peminjaman</button>
                    </form>
                    @else
                    <button disabled="disabled" class="btn btn-light">Tarik Peminjaman</button>
                    @endif
                </td>
            </tr>
            @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection