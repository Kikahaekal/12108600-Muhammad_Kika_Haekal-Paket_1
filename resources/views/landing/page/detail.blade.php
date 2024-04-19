@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-2">Detail Buku</h4>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('img/'. $book->cover) }}" alt="cover" class="w-75 h-100 rounded">
                </div>
                <div class="col-md-8">
                    <table border="0" class="w-75 h-100">
                        <tr>
                            <td>Judul</td>
                            <td>:</td>
                            <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td>:</td>
                            <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                            <td>Tahun Rilis</td>
                            <td>:</td>
                            <td>{{ $book->publication_year }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>
                                @foreach ($book->categories as $category)
                                    {{ $category->name }}<br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Stok Buku</td>
                            <td>:</td>
                            <td>{{ $book->stock }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @if(Auth::user()->role == 'user')
            <div class="d-flex mt-2 gap-2">
                <div>
                    @if($book->stock != 0 || $user->books->contains($book->id))
                        @if($book_status == 0 || !$user->books->contains($book->id))
                        <form action="/pinjam_buku/{{ $book->id }}" method="POST">
                            @csrf
                            <button class="btn btn-success">Pinjam Buku</button>
                        </form>
                        @elseif ($book_status == 1)
                        <form action="/buku_kembali/{{ $book->id }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Kembalikan Buku</button>
                        </form>
                        @endif
                    @else
                    <button disabled="disabled" class="btn btn-light">Stock Habis</button>
                    @endif
                </div>
                <div>
                    @if(!$user->collections->contains('book_id', $book->id))
                    <form action="/koleksi_buku/{{ $book->id }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Koleksi Buku</button>
                    </form>
                    @else
                    <form action="/delete_koleksi/{{ $user->collections->where('book_id', $book->id)->first()->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus dari koleksi</button>
                    </form>
                    @endif
                </div>
            </div>
            @endif
            <div class="comment-section mt-5">
                @if(!$book->reviews->contains('user_id', Auth::user()->id))
                <h5>Ulasan Anda</h5>
                <form action="/review/{{ $book->id }}" method="post">
                @csrf
                    <div class="form-group">
                        <textarea name="comment" id="comment" cols="30" rows="3" class="form-control" placeholder="Tuliskan komentar anda disini"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <select name="rating" id="rating" class="form-control" style="width: 70px">
                            <option hidden>Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <button class="btn btn-primary float-end">Kirim</button>
                    <div class="clearfix"></div>
                </form>
                @else
                <h5>Ubah Ulasan Anda</h5>
                <form action="/update_review/{{ $book->reviews->where('book_id', $book->id)->first()->id }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                @foreach ($book->reviews as $review)
                @if ($review->user_id == Auth::user()->id)
                <div class="form-group">
                    <textarea name="comment" id="comment" cols="30" rows="3" class="form-control" placeholder="Tuliskan komentar anda disini">{{ $review->comment }}</textarea>
                </div>
                <div class="form-group mt-2">
                    <select name="rating" id="rating" class="form-control" style="width: 70px">
                        <option hidden>Rating</option>
                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5</option>
                    </select>
                </div>
                <button class="btn btn-primary float-end">Kirim</button>
                <div class="clearfix"></div>
                @endif
                @endforeach
                </form>
                @endif
            </div>
            <div class="mt-3">
                <h4>Ulasan tentang buku ini</h4>
                <hr>
                @if(count($book->reviews) != 0)
                @foreach ($book->reviews as $review)
                @php
                    $user_name = $user->firstWhere('id', $review->user_id)->username;
                @endphp
                <div class="card mt-2">
                    <div class="card-body">
                        <h5>From : {{ $user_name }}</h5>
                        <code>Rating: {{ $review->rating }}</code>
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="bg-light p-4 text-center">
                    <p>Belum ada komentar apapun</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection