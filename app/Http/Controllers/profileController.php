<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function show()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

        return view('profile.show', compact('user'));
    }
}
