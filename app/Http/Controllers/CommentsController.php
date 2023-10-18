<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->products_id = $request->product_id;
        $comment->message = $request->message;
        $comment->rating = $request->Star_rating;
        $comment->username = $request->username;
        $comment->email = $request->email;
        $comment->save();

        flash('Reseña guardada correctamente.')->success()->important();

        return back();
    }
}
