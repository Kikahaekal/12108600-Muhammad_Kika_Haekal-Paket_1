<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function landing()
    {
        $books = Book::all();
    
        return view('landing.index', compact('books'));
    }

    public function buku()
    {
        $books = Book::with('categories')->get();
        $categories = Category::all();

        return view('buku.index', compact('books', 'categories'));
    }

    public function kategori()
    {
        $categories = Category::all();

        return view('kategori.index', compact('categories'));
    }

    public function edit_kategori($id)
    {
        $category = Category::find($id);

        return view('kategori.page.edit', compact('category'));
    }

    public function detail_buku($id)
    {
        $book = Book::with('categories')->where('id', $id)->first();

        return view('buku.page.detail', compact('book'));
    }

    public function edit_buku($id)
    {
        $book = Book::with('categories')->where('id', $id)->first();
        $categories = Category::all();

        return view('buku.page.edit', compact('book', 'categories'));
    }

    public function landing_detail_buku($id)
    {
        $book = Book::with(['categories', 'reviews'])->where('id', $id)->first();
        $user = User::with(['books', 'collections'])->where('id', Auth::user()->id)->first();

        if($user->books->contains($id))
        {
            $book_status = $user->books->where('pivot.book_id', $id)->first()->pivot->status;
        } else {
            $book_status = null;
        }

        return view('landing.page.detail', compact('book', 'user', 'book_status'));
    }
}
