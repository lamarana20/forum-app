@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $thread->title }}</h1>
                <p>{{ $thread->body }}</p>
                <small>by {{ $thread->user->name }} on {{ $thread->created_at->format('d M Y') }}</small>
                <hr>
                <h2>les discution</h2>
                @if ($thread->posts->count() > 0)
                    <ul class="list-group">
                        @foreach($thread->posts as $post)
                            <li class="list-group-item">
                               <strong> name:</strong>
                               @if ($thread->user)
                                {{ $thread->user->name }}
                            @else
                                Utilisateur inconnu
                            @endif
                            <br>
                             <strong>  Answer:</strong> <a href="{{ route('posts.edit', $post) }}">{{ $post->body }}</a><br>
                                
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No posts found.</p>
                @endif
                <hr>
                <h3>ajouter votre reponse</h3>
                <form action="{{ route('posts.store', $thread) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="body">Contenu du post</label>
                        <textarea name="body" id="body" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Poster</button>
                </form>
            </div>
        </div>
    </div>
@endsection
