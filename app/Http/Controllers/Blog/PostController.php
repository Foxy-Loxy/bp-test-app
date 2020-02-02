<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisplayPostsRequest;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    public function index(DisplayPostsRequest $request)
    {
        $postQuery = Post::where('id', '!=', '0');

        if ($request->has('user')) {
            $postQuery->where('user_id', '=' ,$request->get('user'));
        }

        if ($request->has('createdAt')) {
            $postQuery->orderBy('created_at', $request->get('createdAt'));
        } else {
            $postQuery->orderBy('created_at', 'DESC');
        }

        return view('blog.post.index', [
            'posts' => $postQuery->paginate(25),
        ]);
    }

    public function create()
    {
        return view('blog.post.create');
    }

    public function showUpdate(Post $post)
    {
        if ($post->user_id !== Auth::user()->id) {
            return redirect()->back();
        }

        return view('blog.post.update', [
            'post' => $post,
        ]);
    }

    public function save(DisplayPostsRequest $request)
    {
        $postToCreate = $request->request->all();

        $postToCreate['user_id'] = Auth::user()->id;

        Post::create($postToCreate);

        return redirect()->route('index');
    }

    public function delete(Post $post)
    {
        if ($post->user_id !== Auth::user()->id) {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->route('index');
    }

    public function update(Post $post, DisplayPostsRequest $request)
    {
        if ($post->user_id !== Auth::user()->id) {
            return redirect()->back();
        }

        $post->update($request->all());

        return redirect()->route('index');
    }

    public function show(Post $post)
    {
        return view('blog.post.show', [
            'post' => $post,
        ]);
    }
}
