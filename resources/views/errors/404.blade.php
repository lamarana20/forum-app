@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold mb-4">404</h1>
        <p class="text-xl mb-6">Oups ! La page que vous cherchez n'existe pas.</p>
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection
