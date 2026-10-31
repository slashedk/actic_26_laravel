<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-slate-100 via-white to-blue-50">

    <x-navbar />

    <main class="flex-1 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">

            {{-- En-tête --}}
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Inscription</h1>
                <p class="mt-2 text-gray-500">Crée ton compte pour commencer.</p>
            </div>

            {{-- Carte du formulaire --}}
            <div class="bg-white rounded-3xl shadow-lg ring-1 ring-gray-100 p-8">

                <form action="{{ url('/createUser') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Nom d'utilisateur --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nom d'utilisateur</label>
                        <input
                            type="text"
                            id="email"
                            name="name"
                            placeholder="john"
                            required
                            autofocus
                            class="w-full rounded-full border bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('email')
                            <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse e-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@mail.com"
                            required
                            autocomplete="email"
                            class="w-full rounded-full border bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('email')
                            <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    

                    {{-- Mot de passe --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-full border bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }}"
                        >
                        @error('password')
                            <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirmation mot de passe --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                        >
                    </div>

                    {{-- Bouton --}}
                    <button
                        type="submit"
                        class="w-full rounded-full bg-blue-600 px-4 py-3 font-semibold shadow-md shadow-blue-200 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 focus:outline-none transition"
                    >
                        Créer mon compte
                    </button>

                    <p class="text-center text-sm text-gray-500">
                        Déjà un compte ?
                        <a href="{{ url('/login') }}" class="font-semibold text-blue-600 hover:underline">Se connecter</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

</body>
</html>