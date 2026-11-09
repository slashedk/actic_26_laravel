<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-linear-to-br from-slate-100 via-white to-blue-50">

    <x-navbar />

    <main class="flex-1 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">

            {{-- En-tête --}}
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Connexion</h1>
                <p class="mt-2 text-gray-500">Pas de compte
                    <a href="/signup"
                        class="font-semibold text-blue-600 hover:underline">
                        inscrivez-vous.
                    </a>
                </p>
            </div>

            {{-- Carte du formulaire --}}
            <div class="bg-white rounded-3xl shadow-lg ring-1 ring-gray-100 p-8">

                @if (session('status'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ url('/handlelogin') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse
                            e-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="exemple@mail.com" required autofocus autocomplete="email"
                            class="w-full rounded-full border bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }}">
                        @error('email')
                            <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de
                            passe</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            autocomplete="current-password"
                            class="w-full rounded-full border bg-gray-50 px-5 py-3 text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none {{ $errors->has('password') ? 'border-red-400' : 'border-gray-200' }}">
                        @error('password')
                            <p class="mt-1.5 px-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Se souvenir de moi --}}
                    {{-- <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-200">
                            Se souvenir de moi
                        </label>
                    </div> --}}

                    {{-- Bouton --}}
                    <button type="submit"
                        class="w-full rounded-full bg-blue-600 px-4 py-3 font-semibold shadow-md shadow-blue-200 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 focus:outline-none transition">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>

</html>
