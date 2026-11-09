<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un poste</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-slate-100 via-white to-blue-50">

    {{-- Barre de navigation (en haut) --}}
    <x-navbar />

    {{-- Contenu (en dessous) --}}
    <main class="flex-1 flex items-start justify-center px-4 py-10">
        <div class="w-full max-w-xl">

            {{-- En-tête --}}
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Ajouter un poste</h1>
                <p class="mt-2 text-gray-500">Renseigne les informations de l'offre ci-dessous.</p>
            </div>

            {{-- Carte du formulaire --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-100 p-8">

                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('/job/add') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Poste --}}
                    <div>
                        <label for="poste" class="block text-sm font-semibold text-gray-700 mb-1.5">Poste</label>
                        <input
                            type="text"
                            id="poste"
                            name="poste"
                            value="{{ old('poste') }}"
                            placeholder="Ex : Développeur web"
                            class="w-full border bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('poste') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('poste')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date limite --}}
                    <div>
                        <label for="date_limite" class="block text-sm font-semibold text-gray-700 mb-1.5">Date limite</label>
                        <input
                            type="date"
                            id="date_limite"
                            name="date_limite"
                            value="{{ old('date_limite') }}"
                            class="w-full rounded-xl border bg-gray-50 px-4 py-3 text-gray-800 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('date_limite') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('date_limite')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pièce à fournir --}}
                    <div>
                        <label for="piece_a_fournir" class="block text-sm font-semibold text-gray-700 mb-1.5">Pièce à fournir</label>
                        <input
                            type="text"
                            id="piece_a_fournir"
                            name="piece_a_fournir"
                            value="{{ old('piece_a_fournir') }}"
                            placeholder="Ex : CV et lettre de motivation"
                            class="w-full rounded-xl border bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('piece_a_fournir') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('piece_a_fournir')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Photo --}}
                    <div>
                        <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1.5">Photo</label>
                        <input
                            type="file"
                            id="photo"
                            name="photo"
                            accept='image/*'
                            class="w-full text-sm text-gray-600 rounded-xl border border-dashed bg-gray-50 cursor-pointer file:mr-4 file:py-3 file:px-5 file:border-0 file:bg-blue-600 file:text-white file:font-semibold hover:file:bg-blue-700 {{ $errors->has('photo') ? 'border-red-400' : 'border-gray-300' }}"
                        >
                        @error('photo')
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
                            class="flex-1 rounded-xl bg-blue-600 px-4 py-3 font-semibold shadow-md shadow-blue-200 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 focus:outline-none transition"
                        >
                            Ajouter le poste
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>