<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($postId)
    {
        $postFromDB = Post::with('comments')->find($postId);

        if (is_null($postFromDB)) {
            return to_route('posts.index');
        }

        return view('posts.show', ['post' => $postFromDB]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

  public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'user_id' => 'required|exists:users,id'
    ]);

    Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'user_id' => $request->user_id
    ]);

    return redirect()->route('posts.index');
}


    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update($postId)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
        ]);

        $postFromDB = Post::find($postId);

        $postFromDB->update([
            'title' => request()->title,
            'description' => request()->description,
            'creator' => request()->post_creator,
        ]);

        return to_route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        $postFromDB = Post::find($postId);
        $postFromDB->delete();

        return to_route('posts.index');
    }

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255'
        ]);

        $post->comments()->create([
            'content' => $request->input('content')
        ]);

        return back();
    }
}
