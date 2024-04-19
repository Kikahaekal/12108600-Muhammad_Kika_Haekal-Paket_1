@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @include('admin.users.add-card')
        </div>
        <div class="col-md-8">
            <h4>Data User</h4>
            <hr>
            @if(count($users) != 0)
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->username }}</td>
                        <td class="d-flex gap-2">
                            <a href="/detail_user/{{ $user->id }}" class="btn btn-success">Detail</a>
                            <a href="/edit_user/{{ $user->id }}" class="btn btn-primary">Edit</a>
                            <form action="/delete_user/{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="bg-light p-4 text-center">
                <p>Tidak ada user selain admin</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection