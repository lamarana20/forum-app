@extends('layouts.app')

@section('content')
<div class="container  mt-4 mb-4 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Profil de {{ $user->name }}</h4>
                </div>
                <div class="card-body">
                    <p>Email: {{ $user->email }}</p>
                    <p>Date de création: {{ $user->created_at }}</p>
                    <p>Date de dernière modification: {{ $user->updated_at }}</p>
                    <p>Nombre de threads: {{ $user->threads->count() }}</p>
                    <p>Nombre de posts: {{ $user->posts->count() }}</p>
                    
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5>Threads de {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    @if ($user->threads)
                        @if ($user->threads->count() > 0)
                            <ul>
                                @foreach ($user->threads as $thread)
                                    <li>
                                        <a href="{{ route('threads.show', $thread) }}">{{ $thread->title }}</a>

                                        <!-- Boutons d'action pour chaque thread -->
                                        @can('update', $thread)
                                            <a href="{{ route('threads.edit', $thread) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                        @endcan

                                        @can('delete', $thread)
                                            <form action="{{ route('threads.destroy', $thread) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        @endcan
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucun thread trouvé pour cet utilisateur.</p>
                        @endif
                    @else
                        <p>Aucun thread trouvé pour cet utilisateur.</p>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Posts de {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    @if ($user->posts)
                        @if ($user->posts->count() > 0)
                            <ul>
                                @foreach ($user->posts as $post)
                                    <li>
                                        <a href="{{ route('posts.show', $post) }}">{{ $post->body }}</a>
                                        @can('update', $post)
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                        @endcan
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        @endcan
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucun post trouvé pour cet utilisateur.</p>
                        @endif
                    @else
                        <p>Aucun post trouvé pour cet utilisateur.</p>
                    @endif
                </div>
            </div>

            <!-- Section pour les activités récentes de l'utilisateur -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Activités récentes de {{ $user->name }}</h5>
                </div>
                <div class="card-body">

                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
