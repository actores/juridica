<?php
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;
layout('layouts.guest');
form(LoginForm::class);
$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();
    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};
?>
<div class="w-full">
    <div class="absolute top-8 lg:top-12 right-8 lg:right-12">
        <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl shadow-sm overflow-hidden bg-white border border-gray-50 flex items-center justify-center p-2">
            <img src="{{ asset('assets/logo.png') }}" class="w-full h-full object-contain">
        </div>
    </div>
    <div class="mb-8 lg:mb-14 flex items-center gap-3">
        <span class="h-[1px] w-8 bg-[#642D8E]"></span>
        <span class="text-[10px] font-semibold uppercase tracking-[0.4em] text-[#642D8E]">Área Legal</span>
    </div>
    <div class="mb-8 lg:mb-12">
        <h3 class="text-3xl lg:text-4xl font-black text-[#030712] uppercase tracking-tighter mb-3">Ingreso Portal</h3>
        <p class="text-[#6B7280] font-normal text-sm leading-relaxed">
            Inicia sesión para gestionar tus <span class="text-[#EB128A]">requerimientos legales.</span>
        </p>
    </div>
    <x-auth-session-status class="mb-6" :status="session('status')" />
    <form wire:submit="login" class="space-y-6 lg:space-y-8 relative z-20">
        <div class="relative">
            <label for="email" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                Correo Corporativo
            </label>
            <input wire:model="form.email" id="email" type="email" name="email" required autofocus
                placeholder="tucorreo@actores.org.co"
                class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>
        <div class="relative">
            <label for="password" class="block text-[10px] font-semibold uppercase tracking-[0.3em] text-[#6B7280] mb-2">
                Contraseña
            </label>
            <input wire:model="form.password" id="password" type="password" name="password" required
                placeholder="••••••••••••"
                class="w-full py-3 border-b border-gray-200 focus:border-[#642D8E] outline-none text-[#030712] font-normal transition-all bg-transparent placeholder:text-gray-300">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
        <div class="flex items-center">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                    class="w-4 h-4 rounded border-gray-300 text-[#642D8E] shadow-sm focus:ring-[#642D8E] transition-all cursor-pointer">
                <span class="ms-3 text-[11px] font-medium text-gray-400 group-hover:text-gray-600 uppercase tracking-widest transition-colors">Mantener sesión</span>
            </label>
        </div>
        <div class="pt-4">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-[#030712] hover:bg-[#642D8E] active:scale-[0.98] text-white py-5 rounded-2xl transition-all duration-300 shadow-xl shadow-gray-200 flex items-center justify-center gap-3 group border-none outline-none disabled:opacity-70">
                <span wire:loading.remove wire:target="login" class="text-[11px] font-black uppercase tracking-[0.5em] ml-2">
                    Iniciar Sesión
                </span>
                <div wire:loading wire:target="login">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <svg wire:loading.remove wire:target="login" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>
</div>