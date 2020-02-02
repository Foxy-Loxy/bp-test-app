<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function update(Post $post)
    {
        try {
            Like::create([
                'user_id' => \Auth::user()->id,
                'post_id' => $post->id,
            ]);
        } catch (\Exception $e) {
            Like::where([
                'user_id' => \Auth::user()->id,
                'post_id' => $post->id,
            ])->delete();
        }

        return new JsonResponse([
            'count' => Like::where('post_id', '=' , $post->id)->count(),
            'hasUserLike' => Like::where([
                ['user_id', '=', \Auth::user()->id,],
                ['post_id', '=', $post->id,],
            ])->exists(),
        ]);
    }
}
