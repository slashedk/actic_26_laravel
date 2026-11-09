<?php

namespace App\Http\Controllers;

use App\Models\ClacWork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClacController extends Controller
{
    private const PIECES_AUTORISEES = [
    'CV',
    "Photo d'identité",
    'Lettre de motivation',
    "Copie de la pièce d'identité",
    'Diplômes',
    'Extrait de casier judiciaire',
];

public function addJob(Request $request)
{
    $validated = $request->validate([
        'titre'              => ['required', 'string'],
        'societe'            => ['required', 'string'],
        'date_limite'        => ['required', 'date'],
        'age_min'            => ['nullable', 'integer'],
        'age_max'            => ['nullable', 'integer'],
        'lieu_depot'         => ['required', 'string'],
        'contact'            => ['required', 'string'],
        'pieces_a_fournir'   => ['nullable', 'array'],
        'photo'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
    ]);

    $disque = config('filesystems.offres_disk', 'public');
    $chemin = null;

    // Le fichier est enregistré, seule son adresse va dans la colonne image_url
    if ($request->hasFile('photo')) {
        $chemin = $request->file('photo')->store('offres', $disque);
        $validated['image_url'] = Storage::disk($disque)->url($chemin);
    }

    unset($validated['photo']);
    $validated['pieces_a_fournir'] = $validated['pieces_a_fournir'] ?? [];

    try {
        // user_id est rempli automatiquement par la relation
        $request->user()->desOffres()->create($validated);
    } catch (\Throwable $e) {
        // Évite de laisser une image orpheline si l'enregistrement échoue
        if ($chemin) {
            Storage::disk($disque)->delete($chemin);
        }
        throw $e;
    }

    return redirect('/alljobs')->with('success', 'Le poste a été ajouté.');
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
