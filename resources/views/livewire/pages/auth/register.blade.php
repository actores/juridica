<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();
    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));
    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div class="w-full">
    <!-- Icono / Logo superior derecho -->
    <div class="absolute top-8 lg:top-12 right-8 lg:right-12">
        <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl shadow-sm overflow-hidden bg-white border border-gray-50 flex items-center justify-center p-2">
            <img src="{{ asset('assets/logo.png') }}" class="w-full h-full object-contain">
        </div>
    </div>
    <!-- Tag Superior -->
    <div class="mb-6 lg:mb-10 flex items-center gap-3">
        <span class="h-[1px] w-8 bg-[#642D8E]"></span>
        <span class="text-[10px] font-semibold uppercase tracking-[0.4em] text-[#642D8E]">Nuevo Usuario</span>
    </div>
    <div class="mb-8 lg:mb-10">
        <h3 class="text-3xl lg:text-4xl font-black text-[#030712] uppercase tracking-tighter mb-3">Crear Cuenta</h3>
        <p class="text-[#6B7280] font-normal text-sm leading-relaxed">
            Regístrate para acceder al sistema de <span class="text-[#EB128A]">Gestión Jurídica.</span>
        </p>
    </div>
    <form wire:submit="register" class="space-y-5 lg:space-y-6 relative z-20">
        <!-- Nombre Completo -->
        <div class="relative">
            <label for="name" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                Nombre Completo
            </label>
            <input wire:model="name" id="name" type="text" name="name" required autofocus
                placeholder="Escribe tu nombre"
                class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Correo Institucional -->
        <div class="relative">
            <label for="email" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                Correo Institucional
            </label>
            <input wire:model="email" id="email" type="email" name="email" required
                placeholder="tucorreo@actores.org.co"
                class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Contraseña -->
            <div class="relative">
                <label for="password" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                    Contraseña
                </label>
                <input wire:model="password" id="password" type="password" name="password" required
                    placeholder="••••••••"
                    class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Confirmar Contraseña -->
            <div class="relative">
                <label for="password_confirmation" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                    Confirmar
                </label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required
                    placeholder="••••••••"
                    class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <!-- Botón de Acción -->
        <div class="pt-4 space-y-6">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-[#030712] hover:bg-[#642D8E] active:scale-[0.98] text-white py-5 rounded-2xl transition-all duration-300 shadow-xl shadow-gray-200 flex items-center justify-center gap-3 group border-none outline-none disabled:opacity-70">
                <span wire:loading.remove wire:target="register" class="text-[11px] font-black uppercase tracking-[0.5em] ml-2">
                    Registrar Cuenta
                </span>
                <div wire:loading wire:target="register">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <svg wire:loading.remove wire:target="register" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
            <!-- Enlace a Login -->
            <div class="text-center">
                <a class="text-[10px] font-semibold text-gray-400 hover:text-[#EB128A] uppercase tracking-[0.3em] transition-colors duration-300"
                   href="{{ route('login') }}" wire:navigate>
                    ¿Ya tienes cuenta? Inicia Sesión
                </a>
            </div>
        </div>
    </form>
</div>