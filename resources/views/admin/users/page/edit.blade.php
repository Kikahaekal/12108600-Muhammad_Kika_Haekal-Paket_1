@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4>Edit User</h4>
            <hr>
            <form action="/update_user/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}">
                        </div>
                    </div>
                </div>
                <div class="form-group my-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group my-4">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option hidden>Pilih Role</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>
                <div class="form-group my-4">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $user->address }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/users" class="text-decoration-none">Kembali</a>
                    <button class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection