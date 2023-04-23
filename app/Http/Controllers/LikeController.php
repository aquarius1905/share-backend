<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\Like\StoreRequest;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Like\StoreReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = Like::create($request->all());

        return response()->json([
            'data' => $item
        ], 201);
    }

    public function countLikes(Request $request)
    {
        $count = Like::where('post_id', $request->post_id)
            ->where('user_id', $request->user_id)
            ->count();

        return response()->json([
            'count' => $count
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Like  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $post_id)
    {
        $item = Like::where('user_id', $user_id)
            ->where('post_id', $post_id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
}