<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store($book_id)
    {
        Collection::create([
            'book_id' => $book_id,
            'user_id' => Auth::user()->id
        ]); 

        return back()->with('book_collected','');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        //
    }
}
