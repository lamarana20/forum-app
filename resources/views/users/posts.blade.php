@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts de {{ $user->name }}</h1>
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $post->body }}</p>
                    <p class="card-text"><small class="text-muted">Créé le {{ $post->created_at->format('d M Y') }}</small></p>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
