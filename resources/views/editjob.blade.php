<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'offre</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-slate-100 via-white to-blue-50">

@php
    $classeChamp = 'w-full rounded-xl border bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none';
    $classeLabel = 'block text-sm font-semibold text-gray-700 mb-1.5';
@endphp

    {{-- Barre de navigation (en haut) --}}
    <x-navbar />

    {{-- Contenu (en dessous) --}}
    <main class="flex-1 flex items-start justify-center px-4 py-10">
        <div class="w-full max-w-xl">

            {{-- En-tête --}}
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Modifier l'offre</h1>
                <p class="mt-2 text-gray-500">Mettez à jour les informations de l'offre ci-dessous.</p>
            </div>

            {{-- Carte du formulaire --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-100 p-8">

                @if (session('success'))
                    <div role="status" class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('job.update', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Titre --}}
                    <div>
                        <label for="titre" class="{{ $classeLabel }}">Titre de l'offre</label>
                        <input
                            type="text"
                            id="titre"
                            name="titre"
                            value="{{ old('titre', $job->titre) }}"
                            maxlength="120"
                            required
                            placeholder="Ex : Développeur web"
                            class="{{ $classeChamp }} {{ $errors->has('titre') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('titre')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Société --}}
                    <div>
                        <label for="societe" class="{{ $classeLabel }}">Société</label>
                        <input
                            type="text"
                            id="societe"
                            name="societe"
                            value="{{ old('societe', $job->societe) }}"
                            maxlength="120"
                            required
                            autocomplete="organization"
                            placeholder="Ex : Actic Group"
                            class="{{ $classeChamp }} {{ $errors->has('societe') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('societe')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date limite --}}
                    <div>
                        <label for="date_limite" class="{{ $classeLabel }}">Date limite de candidature</label>
                        <input
                            type="date"
                            id="date_limite"
                            name="date_limite"
                            value="{{ old('date_limite', $job->date_limite) }}"
                            required
                            class="{{ $classeChamp }} {{ $errors->has('date_limite') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('date_limite')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Âges --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="age_min" class="{{ $classeLabel }}">
                                Âge minimum <span class="font-normal text-gray-400">(facultatif)</span>
                            </label>
                            <input
                                type="number"
                                id="age_min"
                                name="age_min"
                                value="{{ old('age_min', $job->age_min) }}"
                                min="0"
                                max="120"
                                inputmode="numeric"
                                placeholder="18"
                                class="{{ $classeChamp }} {{ $errors->has('age_min') ? 'border-red-400' : 'border-gray-200' }}"
                            >
                            @error('age_min')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="age_max" class="{{ $classeLabel }}">
                                Âge maximum <span class="font-normal text-gray-400">(facultatif)</span>
                            </label>
                            <input
                                type="number"
                                id="age_max"
                                name="age_max"
                                value="{{ old('age_max', $job->age_max) }}"
                                min="0"
                                max="120"
                                inputmode="numeric"
                                placeholder="35"
                                class="{{ $classeChamp }} {{ $errors->has('age_max') ? 'border-red-400' : 'border-gray-200' }}"
                            >
                            @error('age_max')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Lieu de dépôt --}}
                    <div>
                        <label for="lieu_depot" class="{{ $classeLabel }}">Lieu de dépôt des dossiers</label>
                        <input
                            type="text"
                            id="lieu_depot"
                            name="lieu_depot"
                            value="{{ old('lieu_depot', $job->lieu_depot) }}"
                            maxlength="200"
                            required
                            class="{{ $classeChamp }} {{ $errors->has('lieu_depot') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('lieu_depot')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Contact --}}
                    <div>
                        <label for="contact" class="{{ $classeLabel }}">Informations de contact</label>
                        <input
                            type="text"
                            id="contact"
                            name="contact"
                            value="{{ old('contact', $job->contact) }}"
                            maxlength="200"
                            required
                            placeholder="Téléphone ou e-mail"
                            class="{{ $classeChamp }} {{ $errors->has('contact') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">
                            Un numéro de téléphone ou une adresse e-mail pour joindre le recruteur.
                        </p>
                        @error('contact')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pièces à fournir --}}
                    <div>
                        <label for="pieces_a_fournir" class="{{ $classeLabel }}">Pièces à fournir</label>
                        <input
                            type="text"
                            id="pieces_a_fournir"
                            name="pieces_a_fournir"
                            value="{{ old('pieces_a_fournir', $job->pieces_a_fournir) }}"
                            maxlength="500"
                            placeholder="Ex : CV, Photo d'identité, Lettre de motivation"
                            class="{{ $classeChamp }} {{ $errors->has('pieces_a_fournir') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">
                            Sépare chaque pièce par une virgule.
                        </p>
                        @error('pieces_a_fournir')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label for="image_url" class="{{ $classeLabel }}">
                            Image <span class="font-normal text-gray-400">(facultatif, JPG, PNG ou WebP, 5 Mo max)</span>
                        </label>
                        @if(!empty($job->image_url))
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 mb-1">Image actuelle :</p>
                                <img src="{{ asset('storage/' . $job->image_url) }}" alt="Aperçu" class="h-20 w-auto rounded-lg object-cover border">
                            </div>
                        @endif
                        <input
                            type="file"
                            id="image_url"
                            name="image_url"
                            accept="image/jpeg,image/png,image/webp"
                            class="w-full text-sm text-gray-600 rounded-xl border border-dashed bg-gray-50 cursor-pointer file:mr-4 file:py-3 file:px-5 file:border-0 file:bg-blue-600 file:text-white file:font-semibold hover:file:bg-blue-700 {{ $errors->has('image_url') ? 'border-red-400' : 'border-gray-300' }}"
                        >
                        @error('image_url')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Boutons --}}
                    <div class="flex flex-col-reverse sm:flex-row gap-3 pt-2">
                        <a href="{{ route('kibabu') }}"
                           class="sm:w-1/3 text-center rounded-xl border border-gray-200 px-4 py-3 font-semibold text-gray-600 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button
                            type="submit"
                            class="flex-1 rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white shadow-md shadow-blue-200 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 focus:outline-none transition"
                        >
                            Mettre à jour l'offre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>