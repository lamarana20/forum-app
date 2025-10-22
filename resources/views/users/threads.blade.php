@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Threads de {{ $user->name }}</h1>

        @foreach($threads as $thread)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $thread->title }}</h5>
                    <p class="card-text">{{ $thread->body }}</p>
                    <p class="card-text"><small class="text-muted">Créé le {{ $thread->created_at->format('d M Y') }}</small></p>
                </div>
            </div>
        @endforeach

        {{ $threads->links() }} <!-- Pour la pagination -->

    </div>