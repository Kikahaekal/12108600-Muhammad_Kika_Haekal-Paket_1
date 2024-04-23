<?php

namespace App\Http\Controllers;

use App\Exports\DataPeminjamanExport;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

    public function koleksi()
    {
        $user = User::with('collections')->where('id', Auth::user()->id)->first();
        $collections = [];

        foreach($user->collections as $collection) {
            $collections[] = Book::where('id', $collection->book_id)->first();
        }

        return view('koleksi.index', compact('collections', 'user'));
    }

    public function data_peminjaman_user()
    {
        $user = User::with('books')->where('id', Auth::user()->id)->first();

        return view('peminjaman.index', compact('user'));
    }

    public function data_peminjaman_admin()
    {
        $users = User::with('books')->where('role', 'user')->get();

        return view('admin.peminjaman.index', compact('users'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->orWhere('role', 'staff')->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit_user($id)
    {
        $user = User::find($id);

        return view('admin.users.page.edit', compact('user'));
    }

    public function detail_user($id)
    {
        $user = User::find($id);

        return view('admin.users.page.detail', compact('user'));
    }

    public function filter_peminjaman(Request $request)
    {
        // dd($request->name);
        return $this->export_peminjaman($request->name);
    }

    public function export_peminjaman($name) 
    {
        return Excel::download(new DataPeminjamanExport($name), 'peminjaman.xlsx');
    }

    public function error()
    {
        return view('error');
    }
}
