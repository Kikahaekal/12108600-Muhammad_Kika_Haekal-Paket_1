<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="/landing">Home</a>
          </li>
          @if(Auth::user()->role == 'user')
          <li class="nav-item">
            <a class="navbar-brand" href="/koleksi">Koleksi</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="/peminjaman_user">Peminjaman</a>
          </li>
          @elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
          <li class="nav-item">
            <a class="navbar-brand" href="/buku">Buku</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="/kategori">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="/peminjaman_admin">Data Peminjaman</a>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a class="navbar-brand" href="/users">Users</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="navbar-brand text-danger" href="/logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>