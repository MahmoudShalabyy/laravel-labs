@extends('layouts.app')

@section('content')
<h3>Post Info</h3>
<div class="card mb-3">
  <div class="card-body">
    <p><strong>Title:</strong> {{ $post->title }}</p>
    <p><strong>Description:</strong> {{ $post->description }}</p>
  </div>
</div>

<h5>Post Creator Info</h5>
<div class="card mb-3">
  <div class="card-body">
    <p><strong>Name:</strong> {{ $post->user?->name }}</p>
    <p><strong>Email:</strong> {{ $post->user?->email }}</p>
    <p><strong>Created At:</strong> {{ $post->created_at->toDayDateTimeString() }}</p>
  </div>
</div>

<h5>Comments</h5>
<div class="card mb-3">
  <div class="card-body">
    @if($post->comments->count() > 0)
      <ul class="list-group">
        @foreach($post->comments as $comment)
          <li class="list-group-item">
            {{ $comment->content }}
            <small class="text-muted d-block">{{ $comment->created_at->diffForHumans() }}</small>
          </li>
        @endforeach
      </ul>
    @else
      <p>No comments yet.</p>
    @endif
  </div>
</div>

<div class="card">
  <div class="card-body">
    <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <textarea name="content" rows="3" class="form-control" placeholder="Write a comment..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
    </form>
  </div>
</div>

<a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
