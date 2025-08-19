@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Posts List</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-success">+ Create Post</a>
    </div>

    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Author</th>
                <th>Created At</th>
                <th width="220">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td class="text-center fw-bold">{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->short_description }}</td>
                    <td>{{ $post->user->name ?? 'Unknown' }}</td>
                    <td>{{ $post->created_at_formatted }}</td>
                    <td class="text-center">
                        <a href="{{ route('posts.show',$post->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this post?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No Posts Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
</div>
@endsection
