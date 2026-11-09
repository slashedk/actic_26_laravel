<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'offre</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-slate-100 via-white to-blue-50">
    <x-navbar />

    <main class="flex-1 flex items-start justify-center px-4 py-10">
        <div class="w-full max-w-xl">
            <h1 class="mb-8 text-center text-3xl font-bold text-gray-800">Modifier l'offre</h1>

            <div class="bg-white rounded-3xl shadow-lg ring-1 ring-gray-100 p-8">
                <form action="{{ url('/job/' . $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="poste" class="block text-sm font-semibold text-gray-700 mb-1.5">Poste</label>
                        <input type="text" id="poste" name="poste" value="{{ old('poste', $job->poste) }}"
                               class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        @error('poste') <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="date_limite" class="block text-sm font-semibold text-gray-700 mb-1.5">Date limite</label>
                        <input type="date" id="date_limite" name="date_limite"
                               value="{{ old('date_limite', $job->date_limite) }}"
                               class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        @error('date_limite') <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="piece_a_fournir" class="block text-sm font-semibold text-gray-700 mb-1.5">Pièce à fournir</label>
                        <input type="text" id="piece_a_fournir" name="piece_a_fournir"
                               value="{{ old('piece_a_fournir', $job->piece_a_fournir) }}"
                               class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-gray-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        @error('piece_a_fournir') <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1.5">Photo</label>
                        <img src="{{ asset('storage/' . $job->photo) }}" alt="{{ $job->poste }}"
                             class="mb-3 h-28 w-40 rounded-xl object-cover">
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="w-full text-sm text-gray-600 rounded-2xl border border-dashed border-gray-300 bg-gray-50 cursor-pointer file:mr-4 file:py-3 file:px-5 file:border-0 file:bg-blue-100 file:text-blue-900 file:font-semibold hover:file:bg-blue-200">
                        <p class="mt-1.5 px-2 text-xs text-gray-500">Laisse vide pour conserver l'image actuelle.</p>
                        @error('photo') <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row gap-3 pt-2">
                        <a href="{{ url('/myjobs') }}"
                           class="sm:w-1/3 text-center rounded-full border border-gray-200 px-4 py-3 font-semibold text-gray-600 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="flex-1 rounded-full border border-blue-300 bg-blue-100 px-4 py-3 font-semibold text-blue-900 hover:bg-blue-200 transition">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>