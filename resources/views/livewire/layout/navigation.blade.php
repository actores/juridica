<?php
use App\Livewire\Actions\Logout;
$logout = function (Logout $logout) {
    $logout();
    $this->redirect('/', navigate: true);
};
?>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between h-20">

            {{-- Logo + Nav --}}
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 group">
                    <x-application-logo class="block h-9 w-auto fill-current text-[#642D8E]" />
                    
                </a>

                <div class="hidden sm:flex items-center h-full gap-8">
                    <span class="h-6 w-[1px] bg-gray-100"></span>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                        class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-widest transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Inicio
                    </x-nav-link>
                </div>
            </div>

            {{-- Usuario desktop --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-5 py-2.5 border border-gray-100 rounded-2xl bg-gray-50 hover:bg-white hover:border-[#642D8E]/30 hover:text-[#642D8E] focus:outline-none transition-all duration-200 shadow-sm">
                            <div class="h-9 w-9 rounded-xl bg-[#642D8E] text-white flex items-center justify-center shadow-sm shadow-[#642D8E]/20 flex-shrink-0">
                                <span class="text-xs font-black uppercase">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                            <div class="text-left hidden md:block">
                                <span class="block text-sm font-bold text-gray-800 leading-none"
                                    x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                    x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name">
                                </span>
                                <span class="block text-[9px] font-semibold text-gray-400 uppercase tracking-widest mt-0.5">Mi cuenta</span>
                            </div>
                            <svg class="fill-current h-3.5 w-3.5 text-gray-300 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-5 py-4 border-b border-gray-100">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="h-[1px] w-4 bg-[#642D8E]"></span>
                                <p class="text-[9px] font-semibold text-[#642D8E] uppercase tracking-widest">Sesión activa</p>
                            </div>
                            <p class="text-xs font-normal text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile')" wire:navigate
                            class="flex items-center gap-2.5 py-3 text-xs font-semibold uppercase tracking-widest">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Mi Perfil
                        </x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link
                                class="flex items-center gap-2.5 py-3 text-xs font-semibold uppercase tracking-widest text-red-500 hover:bg-red-50 hover:text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Cerrar Sesión
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger mobile --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2.5 rounded-xl text-gray-400 hover:text-[#642D8E] hover:bg-[#642D8E]/5 focus:outline-none transition duration-150">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 bg-gray-50/50">
        <div class="pt-3 pb-4 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                class="text-xs font-semibold uppercase tracking-widest">
                Inicio
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-4 border-t border-gray-100 px-4">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-11 w-11 rounded-xl bg-[#642D8E] text-white flex items-center justify-center font-black text-sm shadow-sm shadow-[#642D8E]/20 flex-shrink-0">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div>
                    <div class="text-sm font-bold text-gray-800"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                        x-text="name">
                    </div>
                    <div class="text-[10px] font-normal text-gray-400 mt-0.5">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate
                    class="text-xs font-semibold uppercase tracking-widest">
                    Mi Perfil
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="text-xs font-semibold uppercase tracking-widest text-red-500">
                        Cerrar Sesión
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>