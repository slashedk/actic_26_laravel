@props([
    'action' => url()->current(),
    'placeholder' => 'Rechercher une offre...',
])

<form action="{{ $action }}" method="GET" class="w-full max-w-xl">
    <div class="relative">
        {{-- Icône loupe --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             class="pointer-events-none absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400">
            <circle cx="11" cy="11" r="7" />
            <path d="m20 20-3.5-3.5" stroke-linecap="round" />
        </svg>

        <input
            type="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="{{ $placeholder }}"
            class="w-full rounded-full border border-gray-200 bg-white py-3 pl-12 pr-32 text-gray-800 placeholder-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
        >

        <button
            type="submit"
            class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full border border-blue-300 bg-blue-100 px-5 py-2 text-sm font-semibold text-blue-900 transition hover:bg-blue-200"
        >
            Rechercher
        </button>
    </div>
</form>