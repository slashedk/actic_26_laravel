<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;


class UserController extends Controller
{
    /**
     * Inscription d'un nouvel utilisateur.
     */
    public function store(Request $req): RedirectResponse
    {
        $validated = $req->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],

        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        // $req->session()->regenerate();

        return redirect('/alljobs');
    }

    /**
     * Connexion d'un utilisateur existant.
     */
    public function handlelogin(Request $req): RedirectResponse
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $req->boolean('remember'))) {
            $req->session()->regenerate();

            return redirect()->intended('/alljobs');
        }

        return back()
            ->withErrors(['email' => 'Les identifiants sont incorrects.'])
            ->onlyInput('email');
    }

    /**
     * Déconnexion.
     */
    public function logout(Request $req): RedirectResponse
    {
        Auth::logout();

        // $req->session()->invalidate();
        // $req->session()->regenerateToken();

        return redirect('/');
    }


    public function jobsPerUser(Request $req): View
    {
        $jobs = $req->user()
            ->desOffres()
            ->when($req->filled('search'), fn ($q) => $q->where('poste', 'like', '%' . $req->search . '%'))
            ->paginate(8);

        return view('myjobs', compact('jobs'));
    }
}
