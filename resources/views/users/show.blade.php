@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profil de {{ $user->name }}</h1>
                <p>Email: {{ $user->email }}</p>
                <!-- Ajoutez d'autres détails du profil si nécessaire -->
            </div>
        </div>
    </div>
@endsection
