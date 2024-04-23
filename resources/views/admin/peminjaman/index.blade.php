@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <h4>Daftar Peminjaman</h4>
    <div class="card w-25">
        <div class="card-body">
            <h5>Filter</h5>
            <form action="/filter_peminjaman" class="d-flex" method="POST">
                @csrf
                <select name="name" id="name" class="form-control">
                    <option value="">Semua</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary ms-2">Export</button>
            </form>
        </div>
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
                <th>Batas Peminjaman</th>
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
                <td>{{ \Carbon\Carbon::parse($book->pivot->due_date)->format('j F Y') }}</td>
                <td>{{ $book->pivot->status == 1 ? 'Dipinjam' : 'Dikembalikan' }}</td>
                <td>
                    @if($book->pivot->status == 1 && \Carbon\Carbon::parse($book->pivot->due_date)->isPast())
                    <form action="/tarik_peminjaman/{{ $book->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
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