<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_year' => 'required',
            'stock' => 'required',
            'cover' => 'required|mimes:jpg,png,jpeg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $cover = $request->file('cover');
        $cover_name = time().rand().$cover->extension();

        if(!file_exists(public_path('/img/'.$cover->getClientOriginalName()))){
            $destinationPath = public_path('/img/');
            $cover->move($destinationPath, $cover_name);
            $uploaded = $cover_name;
        } else {
            $uploaded = $cover->getClientOriginalName();
        }

        $data = $request->only('title', 'author', 'stock', 'publisher', 'publication_year');
        $data['cover'] = $uploaded;

        $book = Book::create($data);

        $book->categories()->attach($request->categories);

        return back()->with('success_add', '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_year' => 'required',
            'cover' => 'mimes:jpg,png,jpeg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'stock' => 'required',
        ]);

        $book = Book::find($id);

        if($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $cover_name = time().rand().$cover->extension();
            $exist = public_path('/img/'.$book->cover);
            if(file_exists($exist)){
                unlink($exist);
                $destinationPath = public_path('/img/');
                $cover->move($destinationPath, $cover_name);
                $uploaded = $cover_name;
            } else {
                $uploaded = $cover->getClientOriginalName();
            }

            $data = $request->only('title', 'author', 'stock', 'publisher', 'publication_year');
            $data['cover'] = $uploaded;
    
            $book->update($data);
    
            $book->categories()->sync($request->categories);
        } else {
            $data = $request->only('title', 'author', 'stock', 'publisher', 'publication_year');
            $book->update($data);
    
            $book->categories()->sync($request->categories);
        }

        return redirect('/buku')->with('success_edit', '');
    }

    public function borrow_book($id)
    {
        $user = User::find(Auth::user()->id);
        $exists = $user->books->contains($id);
        $book = Book::find($id);

        if($exists) {
            $user->books()->updateExistingPivot($id, [
                'borrow_date' => Carbon::now(),
                'return_date' => null,
                'status' => 1,
            ]);

            $book->update([
                'stock' => $book->stock - 1
            ]);

            return back()->with('success_borrow', '');
        }

        $user->books()->attach($id, [
            'borrow_date' => Carbon::now(),
            'status' => 1,
        ]);

        $book->update([
            'stock' => $book->stock - 1
        ]);

        return back()->with('success_borrow','');
    }

    public function return_book($id)
    {
        $user = User::find(Auth::user()->id);
        $book = Book::find($id);

        $user->books()->updateExistingPivot($id, [
            'return_date' => Carbon::now(),
            'status' => 0,
        ]);

        $book->update([
            'stock' => $book->stock + 1
        ]);

        return back()->with('success_return', '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, $id)
    {
        $book->destroy($id);

        return back()->with('success_delete', '');
    }
}
