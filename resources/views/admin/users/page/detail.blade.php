@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <table border="0" class="w-50 fs-4">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $user->email  }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>:</td>
                    <td>{{ $user->role }}</td>
                </tr>
            </table>
        </div>
    </div>
    <a href="/users" class="btn btn-danger mt-2">Kembali</a>
</div>
@endsection