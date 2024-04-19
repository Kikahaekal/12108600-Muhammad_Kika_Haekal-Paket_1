@extends('layout.main')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card w-25">
        <div class="card-body">
            <h4>Register</h4>
            <hr>
            <form action="/user_register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/" class="text-decoration-none">Sudah punya akun?</a>
                    <button class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection