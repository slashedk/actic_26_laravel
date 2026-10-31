<?php

namespace App\Http\Controllers;

use App\Models\ClacWork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClacController extends Controller
{
    public function addJob(Request $request)
    {
        $validated = $request->validate([
            'poste' => ['required', 'string'],
            'date_limite' => ['required', 'date'],
            'piece_a_fournir' => ['required', 'string'],
            'photo' => ['required', 'image'],
        ]);

        // Enregistre le fichier et garde uniquement son chemin
        $validated['photo'] = $request->file('photo')->store('photos', 'public');

         ClacWork::create($validated);

        return redirect('/alljobs');
    }

    public function alljobs(): View
    {
        $jobs = ClacWork::latest()->paginate(8);

        return view('jobs', compact('jobs'));
    }
}
