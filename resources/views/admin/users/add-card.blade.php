<div class="card">
    <div class="card-body">
        <h4>Tambah User</h4>
        <hr>
        <form action="/user_add" method="POST">
            @csrf
            <div class="row my-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option hidden>Pilih Role</option>
                    <option value="user">user</option>
                    <option value="staff">staff</option>
                </select>
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