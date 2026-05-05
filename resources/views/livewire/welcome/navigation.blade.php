<nav class="flex flex-1 justify-end items-center gap-4">
    @auth
    <a
        href="{{ url('/dashboard') }}"
        class="px-6 py-2.5 rounded-full bg-slate-900 text-white font-medium hover:bg-blue-800 transition-all duration-300 shadow-lg shadow-blue-900/10">
        Dashboard
    </a>
    @else
    <a
        href="{{ route('login') }}"
        class="px-6 py-2.5 rounded-full bg-slate-900 text-white font-medium hover:bg-blue-800 transition-all duration-300 shadow-lg shadow-blue-900/10">
        Iniciar Sesión
    </a>

    @endauth
</nav>


