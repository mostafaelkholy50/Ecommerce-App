<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorecommentRequest;
use App\Http\Requests\UpdatecommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:500',
        'rating' => 'required|integer|min:1|max:5',
        'product_id' => 'required|exists:products,id',
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'content' => $request->content,
        'rating' => $request->rating
    ]);

    return redirect()->back()->with('success', 'Your comment has been added successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommentRequest $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment)
    {
        //
    }
}
