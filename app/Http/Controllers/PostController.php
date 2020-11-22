<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::with(['likes' => function($like) {
        //     $like->where('user_id', auth()->id());
        // }])->paginate(5);

        $posts = Post::with(['user', 'likes'])->paginate(10);
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $request->user()->posts()->create($request->only('body'));

        return redirect()->route('posts');


    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
