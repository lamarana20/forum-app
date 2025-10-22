<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Post Details</h1>
                <p> le post:{{ $post->body }}</p>
                
                <p>Created At: {{ $post->created_at->format('d M Y') }}</p>
                
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                @endcan

                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
