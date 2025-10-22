
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des utilisateurs</h1>
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item">
                    {{ $user->name }} <br> {{ $user->email }}
                    <a href="{{ route('users.show', $user) }}" class="btn btn-primary">Voir le profil</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection