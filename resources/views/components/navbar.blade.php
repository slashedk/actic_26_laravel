@php
    $links = [
        ['label' => 'Accueil',        'route' => 'home',       'pattern' => '/'],
        ['label' => 'Liste des jobs', 'route' => 'jobs.index', 'pattern' => 'alljobs'],
    ];
@endphp

<header class="w-full border-b border-[#e3e3e0] ">
    <nav class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
        <a href="/" class="text-lg font-semibold">
           Actic Jobs
        </a>

        <ul class="flex items-center gap-2">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['pattern'] == '/' ? $link['pattern'] : '/'.$link['pattern'] }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition
                              {{ request()->is($link['pattern'])
                                    ? 'bg-[#1b1b18] text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A]'
                                    : 'hover:bg-cyan-300 dark:hover:bg-cyan-300' }}">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach

            {{-- Liens réservés aux utilisateurs connectés --}}
            @auth
                <li>
                    <a href="{{ url('/myjobs') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition
                              {{ request()->is('myjobs')
                                    ? 'bg-[#1b1b18] text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A]'
                                    : 'hover:bg-cyan-300 dark:hover:bg-cyan-300' }}">
                        Mes offres
                    </a>
                </li>
                <li>
                    <a href="{{ url('/job/create') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition
                              {{ request()->is('job/create')
                                    ? 'bg-[#1b1b18] text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A]'
                                    : 'hover:bg-gray-100 dark:hover:bg-cyan-50' }}">
                        Ajouter un job
                    </a>
                </li>
            @endauth

            {{-- Connexion / Déconnexion --}}
            <li>
                @auth
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-md text-sm font-medium transition hover:bg-gray-100 dark:hover:bg-cyan-50">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ url('/login') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition
                              {{ request()->is('login')
                                    ? 'bg-[#1b1b18] text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A]'
                                    : 'hover:bg-gray-100 dark:hover:bg-cyan-50' }}">
                        Connexion
                    </a>
                @endauth
            </li>
        </ul>
    </nav>
</header>