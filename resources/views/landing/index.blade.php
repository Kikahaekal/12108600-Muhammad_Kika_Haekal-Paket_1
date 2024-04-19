@extends('layout.main')
@section('content')
@include('landing.navbar')
<div class="container mt-4">
    <div class="row">
        @foreach ($books as $book)
        <div class="col-md-6 mt-4 w-50">
            <a href="/landing_detail_buku/{{ $book->id }}"><img src="{{ asset('img/'. $book->cover) }}" alt="cover" class="w-25 h-100 object-fit-cover"></a>
            <small>{{ $book->title }}</small>
        </div>
        @endforeach
    </div>
</div>
@endsection