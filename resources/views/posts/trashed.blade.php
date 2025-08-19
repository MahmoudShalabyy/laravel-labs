@extends('layouts.app')

@section('title', 'Trashed Posts')

@section('content')
<div class="container">
    <h2>Trashed Posts</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Restore</button>
                    </form>

                    <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Force Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
