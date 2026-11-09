<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes offres</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-100 via-white to-blue-50 min-h-screen">
    <x-navbar />

    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- En-tête --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Mes offres</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $jobs->total() }} offre(s) publiée(s)</p>
            </div>
            <a href="{{ url('/job/create') }}"
               class="rounded-full border border-blue-300 bg-blue-100 px-5 py-2 text-sm font-semibold text-blue-900 hover:bg-blue-200 transition">
                + Ajouter une offre
            </a>
        </div>

        {{-- Barre de recherche (GET /myjobs?search=...) --}}
        <div class="mb-8">
            <form action="{{ url('/myjobs') }}" method="GET" class="relative w-full max-w-xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     class="pointer-events-none absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-3.5-3.5" stroke-linecap="round" />
                </svg>
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher dans mes offres..."
                    class="w-full rounded-full border border-gray-200 bg-white py-3 pl-12 pr-32 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                >
                <button type="submit"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full border border-blue-300 bg-blue-100 px-5 py-2 text-sm font-semibold text-blue-900 transition hover:bg-blue-200">
                    Rechercher
                </button>
            </form>
        </div>

        @if ($jobs->count())
            {{-- Grille de cartes --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($jobs as $job)
                    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 overflow-hidden flex flex-col max-w-xs w-full mx-auto transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="p-2">
                            <img src="{{ asset('storage/' . $job->photo) }}"
                                 alt="{{ $job->poste }}"
                                 class="h-28 w-full rounded-xl object-cover">
                        </div>

                        <div class="px-3 pb-3 flex-1 flex flex-col">
                            <h2 class="text-sm font-semibold text-gray-800 mb-1 truncate" title="{{ $job->poste }}">
                                {{ $job->poste }}
                            </h2>

                            <p class="text-[11px] text-gray-500 mb-2 line-clamp-2">
                                <span class="font-medium text-gray-600">Pièce à fournir :</span>
                                {{ $job->piece_a_fournir }}
                            </p>

                            @if ($job->age_min !== null)
                                <p class="text-[11px] text-gray-500 mb-2">
                                    <span class="font-medium text-gray-600">Âge minimum :</span>
                                    {{ $job->age_min }} ans
                                </p>
                            @endif

                            @if ($job->age_max !== null)
                                <p class="text-[11px] text-gray-500 mb-2">
                                    <span class="font-medium text-gray-600">Âge maximum :</span>
                                    {{ $job->age_max }} ans
                                </p>
                            @endif

                            <div class="mt-auto">
                                @if ($job->date_limite)
                                    <span class="inline-block rounded-full bg-red-100 px-2.5 py-0.5 text-[10px] font-medium text-red-700">
                                        Expire le {{ $job->date_limite }}
                                    </span>
                                @else
                                    <span class="inline-block rounded-full bg-green-100 px-2.5 py-0.5 text-[10px] font-medium text-green-700">
                                        Jusqu'au {{ $job->date_limite}}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-3 flex gap-2">
    <a href="{{ url('/job/' . $job->id . '/edit') }}"
       class="flex-1 rounded-full border border-blue-300 bg-blue-100 px-3 py-1.5 text-center text-xs font-semibold text-blue-900 transition hover:bg-blue-200">
        Modifier
    </a>

    <form action="{{ url('/job/' . $job->id) }}" method="POST" class="flex-1"
          onsubmit="return confirm('Supprimer cette offre ? Cette action est définitive.');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="w-full rounded-full border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-800 transition hover:bg-red-200">
            Supprimer
        </button>
    </form>
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
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 p-10 text-center text-gray-500">
                @if (request('search'))
                    Aucune de tes offres ne correspond à « {{ request('search') }} ».
                @else
                    Tu n'as pas encore publié d'offre.
                @endif
            </div>
        @endif

    </div>
</body>
</html>