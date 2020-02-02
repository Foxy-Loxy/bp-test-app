<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCommentRequest;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function update(SaveCommentRequest $request)
    {
        $commentData = $request->all();
        $commentData['user_id'] = Auth::user()->id;

        Comment::create($commentData);

        return redirect()->back();
    }
}
