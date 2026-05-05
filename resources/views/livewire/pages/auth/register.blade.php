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

<div class="w-full flex justify-center items-center px-4 py-12">
    <div class="w-full sm:max-w-md bg-white shadow-2xl shadow-slate-200/60 rounded-[2.5rem] border border-slate-100 overflow-hidden">

        <div class="px-8 py-10 lg:px-10">
            {{-- Header Editorial --}}
            <div class="mb-10 text-center font-sans">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Registro</h2>
                <p class="text-slate-400 text-sm mt-2 font-medium">Crea tu cuenta institucional</p>
            </div>

            <form wire:submit="register" class="space-y-5">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Nombre Completo</label>
                    <input wire:model="name" id="name"
                        class="block w-full px-5 py-4 rounded-2xl border-slate-100 text-slate-700 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:ring-opacity-50 transition-all duration-300 bg-slate-50/50 placeholder:text-slate-300"
                        type="text" name="name" required autofocus autocomplete="name" placeholder="Tu nombre" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 ml-1" />
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Correo Institucional</label>
                    <input wire:model="email" id="email"
                        class="block w-full px-5 py-4 rounded-2xl border-slate-100 text-slate-700 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:ring-opacity-50 transition-all duration-300 bg-slate-50/50 placeholder:text-slate-300"
                        type="email" name="email" required autocomplete="username" placeholder="usuario@sociedad.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Contraseña</label>
                    <input wire:model="password" id="password"
                        class="block w-full px-5 py-4 rounded-2xl border-slate-100 text-slate-700 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:ring-opacity-50 transition-all duration-300 bg-slate-50/50 placeholder:text-slate-300"
                        type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Confirmar Contraseña</label>
                    <input wire:model="password_confirmation" id="password_confirmation"
                        class="block w-full px-5 py-4 rounded-2xl border-slate-100 text-slate-700 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:ring-opacity-50 transition-all duration-300 bg-slate-50/50 placeholder:text-slate-300"
                        type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-1" />
                </div>

                <div class="pt-4 space-y-4">
                    {{-- Button --}}
                    <button type="submit" wire:loading.attr="disabled"
                        class="group relative w-full h-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white text-sm font-black uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all duration-300 shadow-xl shadow-blue-900/10 transform active:scale-[0.98] cursor-pointer disabled:opacity-70 overflow-hidden">

                        <span wire:loading.remove wire:target="register">Registrar Cuenta</span>

                        <div wire:loading wire:target="register">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>

                    {{-- Login Link --}}
                    <div class="text-center">
                        <a class="text-[11px] font-bold text-slate-400 hover:text-blue-600 uppercase tracking-widest transition-colors duration-300" href="{{ route('login') }}" wire:navigate>
                            ¿Ya tienes una cuenta? Inicia Sesión
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Accent Line --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600"></div>
    </div>
</div>