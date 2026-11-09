<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des postes</title>
   
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>

<body class="bg-gradient-to-br from-slate-100 via-white to-blue-50 min-h-screen">
    <x-navbar />
    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- En-tête --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Liste des offres</h1>

        </div>
        {{-- Barre de recherche --}}
<div class="mb-8">
    <x-search-bar />
</div>
        @if ($jobs->count())
            {{-- Grille de cartes --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 overflow-hidden flex flex-col max-w-xs w-full mx-auto transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="p-2">
                            <img src="{{ asset('storage/' . $job->photo) }}" alt="{{ $job->poste }}"
                                class="h-28 w-full rounded-xl object-cover">
                        </div>

                        <div class="px-3 pb-3 flex-1 flex flex-col">
                            <h2 class="text-sm font-semibold text-gray-800 mb-1 truncate">
                                Titre du poste: {{ $job->poste }}
                            </h2>

                            <p class="text-[11px] text-gray-500 mb-2 line-clamp-2">
                                <span class="font-medium text-gray-600">Pièce à fournir :</span>
                                {{ $job->piece_a_fournir }}
                            </p>

                            @if ($job->age_min !== null)
                                <p class="text-[11px] text-gray-500 mb-2 line-clamp-2">
                                    <span class="font-medium text-gray-600">Âge minimum :</span>
                                    {{ $job->age_min }} ans
                                </p>
                            @endif
                            @if ($job->age_max !== null)
                                <p class="text-[11px] text-gray-500 mb-2 line-clamp-2">
                                    <span class="font-medium text-gray-600">Âge maximum :</span>
                                    {{ $job->age_max }} ans
                                </p>
                            @endif


                            <div class="mt-auto">
                                <span
                                    class="inline-block rounded-full bg-green-100 px-2.5 py-0.5 text-[10px] font-medium text-red-400">
                                    Date limite : {{ $job->date_limite }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        @else
            {{-- Aucun résultat --}}
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 p-10 text-center text-gray-500">
                Aucune offre enregistrée pour le moment.
            </div>
        @endif

    </div>

</body>

</html>
