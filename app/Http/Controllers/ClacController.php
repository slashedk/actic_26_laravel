<?php

namespace App\Http\Controllers;

use App\Models\ClacWork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ClacController extends Controller
{
    public function addJob(Request $request)
    {
        $validated = $request->validate([
            'titre'              => ['required', 'string', 'min:3', 'max:120'],
        'societe'            => ['required', 'string', 'min:2', 'max:120'],
        'date_limite'        => ['required', 'date'],
        'age_min'            => ['nullable', 'integer', 'min:0', 'max:120'],
        'age_max'            => ['nullable', 'integer', 'min:0', 'max:120'],
        'lieu_depot'         => ['required', 'string', ],
        'contact'            => ['required', 'string', ],
        'pieces_a_fournir'   => ['required', 'string'],
        'image_url'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        // Enregistre le fichier et garde uniquement son chemin
        $validated['image_url'] = $request->file('image_url')->store('photos', 'public');

        $request->user()->desOffres()->create($validated);

        return redirect('/alljobs');
    }

    public function alljobs(Request $request): View
    {
        // ce code va afficher des liens de navigations si la page contient une offre
        // $jobs = ClacWork::latest()->paginate(1);
        
        $jobs = ClacWork::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('poste', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();
    
        return view('jobs', compact('jobs'));
    }

    public function destroy(Request $request, ClacWork $job): RedirectResponse
{
    abort_unless($job->user_id === $request->user()->id, 403);

    Storage::disk('public')->delete($job->photo);
    $job->delete();

    return redirect('/myjobs')->with('success', 'Offre supprimée.');
}

public function update(Request $request, ClacWork $job): RedirectResponse
{
    abort_unless($job->user_id === $request->user()->id, 403);

    $validated = $request->validate([
        'poste' => ['required', 'string', 'max:255'],
        'date_limite' => ['required', 'date'],
        'piece_a_fournir' => ['required', 'string', 'max:255'],
        'photo' => ['nullable', 'image'],
    ]);

    if ($request->hasFile('photo')) {
        // Supprime l'ancienne image puis enregistre la nouvelle
        Storage::disk('public')->delete($job->photo);
        $validated['photo'] = $request->file('photo')->store('photos', 'public');
    } else {
        unset($validated['photo']);
    }

    $job->update($validated);

    return redirect('/myjobs')->with('success', 'Offre modifiée avec succès.');
}

public function edit(Request $request, ClacWork $job): View
{
    abort_unless($job->user_id === $request->user()->id, 403);

    return view('editjob', compact('job'));
}
}
