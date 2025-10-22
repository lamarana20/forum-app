<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\User;





class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function threads(User $user)
    {
        $threads = $user->threads()->paginate(10); // Assurez-vous d'ajuster la pagination selon vos besoins
        return view('users.threads', ['user' => $user, 'threads' => $threads]);
    }


    public function posts(User $user)
    {
        $posts = $user->posts()->paginate(10); // Assurez-vous d'ajuster la relation et la pagination selon votre logique
        return view('users.posts', compact('user', 'posts'));
    }
    public function show()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

        return view('users.show', compact('user'));
    }
}
