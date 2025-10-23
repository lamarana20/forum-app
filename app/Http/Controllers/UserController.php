<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Liste de tous les utilisateurs (optionnelle)
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    // Profil public d’un utilisateur
    public function show(User $user)
    {
        // Threads et posts récents
        $threads = $user->threads()->latest()->take(5)->get();
        $posts = $user->posts()->latest()->take(5)->get();

        return view('users.show', compact('user', 'threads', 'posts'));
    }

    // Tous les threads d’un utilisateur
    public function threads(User $user)
    {
        $threads = $user->threads()->latest()->paginate(10);
        return view('users.threads', compact('user', 'threads'));
    }

    // Tous les posts d’un utilisateur
    public function posts(User $user)
    {
        $posts = $user->posts()->latest()->paginate(10);
        return view('users.posts', compact('user', 'posts'));
    }
}
