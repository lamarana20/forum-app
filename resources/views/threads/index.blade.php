@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @guest
                    <p>Si vous êtes connecté, vous verrez le bouton de création de thread</p>
                @endguest
                <h1>Threads</h1>
               
                
                @auth
                    <a href="{{ route('threads.create') }}" class="btn btn-primary">Créer un nouveau thread</a>
                @endauth
                <ul class="list-group mt-4 gap-3">
                    @foreach($threads as $thread)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>
                                        @if ($thread->user)
                                            {{ $thread->user->name }}
                                        @else
                                            Auteur inconnu
                                        @endif
                                    </strong>, {{ $thread->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <a href="{{ route('threads.show', $thread) }}" class="mt-2">
                                <strong>Le titre :</strong><br>{{ $thread->title }}
                            </a>
                            <p class="mt-2">
                                <a href="{{ route('threads.show', $thread) }}">
                                    <strong>La question :</strong><br>{{ $thread->body }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
