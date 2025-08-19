<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


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

 
public function store(StorePostRequest $request)
{
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

    public function update(UpdatePostRequest $request, $postId)
{
    $postFromDB = Post::find($postId);

    $postFromDB->update([
        'title' => $request->title,
        'description' => $request->description,
        'user_id' => $request->user_id, 
    ]);

    return to_route('posts.show', $postId);
}

    public function destroy($postId)
    {
        $postFromDB = Post::find($postId);
        $postFromDB->delete();

        return to_route('posts.index');
    }

    //comment
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

    // (trashed)
public function trashed()
{
    $posts = Post::onlyTrashed()->get();
    return view('posts.trashed', compact('posts'));
}

// (restore)
public function restore($id)
{
    $post = Post::onlyTrashed()->findOrFail($id);
    $post->restore();
    return redirect()->route('posts.trashed');
}

// (force delete)
public function forceDelete($id)
{
    $post = Post::onlyTrashed()->findOrFail($id);
    $post->forceDelete();
    return redirect()->route('posts.trashed');
}

}
