<div class="card">
    <div class="card-body">
        <h4>Tambah Kategori</h4>
        <hr>
        <form action="/add_kategori" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <button class="btn btn-primary w-100">Kirim</button>
        </form>
    </div>
</div>