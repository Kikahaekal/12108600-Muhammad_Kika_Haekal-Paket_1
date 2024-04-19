@extends('layout.main')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card w-25">
        <div class="card-body">
            <h4>Login</h4>
            <hr>
            <form action="/auth" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/register" class="text-decoration-none">Belum punya akun?</a>
                    <button class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection