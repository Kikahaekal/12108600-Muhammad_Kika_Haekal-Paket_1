@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4>Edit Buku</h4>
            <hr>
            <form action="/update_buku/{{ $book->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author">Penulis</label>
                            <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}">
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publisher">Penerbit</label>
                            <input type="text" name="publisher" id="publisher" class="form-control" value="{{ $book->publisher }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publication_year">Tahun Rilis</label>
                            <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ $book->publication_year }}">
                        </div>
                    </div>
                </div>
                <div class="form-group my-4">
                    <label for="stock">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $book->stock }}">
                </div>
                <div class="form-group my-4">
                    <label for="category">Kategori</label>
                    <select name="categories[]" id="category" class="form-control categoryEdit" multiple='multiple'>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                             @foreach ($book->categories as $selected_category)
                             {{ $category->id == $selected_category->id ? 'selected' : '' }}
                             @endforeach
                        >
                             {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-4">
                    <label for="cover">Sampul <code><small>(opsional)</small></code></label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>
                <button class="btn btn-primary w-100">Kirim</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.categoryEdit').select2();
    });
</script>
@endsection