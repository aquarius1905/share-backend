<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\Like\StoreRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Like\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = Comment::create($request->all());
        $item->user = User::where('id', $request->user_id)->firstOrFail(['id', 'name']);

        return response()->json([
            'data' => $item
        ], 201);
    }
}