<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required'
        ]);

        $data = $request->only('comment', 'rating');
        $data['user_id'] = Auth::user()->id;
        $data['book_id'] = $book_id;

        Review::create($data);

        return back()->with('review_added', '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
