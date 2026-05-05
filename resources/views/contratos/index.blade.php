<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tighter uppercase">
                    {{ __('Bandeja de Entrada Jurídica') }}
                </h2>
                <p class="text-emerald-600 font-bold text-xs tracking-[0.3em] uppercase mt-1">Gestión Centralizada de Contratos</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="group flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-black uppercase tracking-widest rounded-2xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Panel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-3 mb-6 px-1">
                {{-- Nivel 1 --}}
                <a href="{{ route('dashboard') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-blue-600 transition-colors">
                    Inicio
                </a>

                {{-- Separador --}}
                <span class="text-slate-300">
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </span>

                {{-- Nivel 2: Página Actual --}}
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">
                    Solicitudes Recibidas
                </span>
            </nav>
            <div class="bg-white overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] sm:rounded-[3rem] border border-gray-100">

                {{-- Header de la Tabla --}}
                <div class="p-8 sm:p-10 border-b border-gray-50 bg-gradient-to-r from-white to-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        {{-- Icono en Azul Corporativo --}}
                        <div class="bg-blue-600 p-3 rounded-2xl shadow-lg shadow-blue-100 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9l-5-5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900 tracking-tight uppercase">Solicitudes Recibidas</h3>
                            <p class="text-gray-400 text-xs font-bold">Mostrando {{ $contratos->count() }} trámites recientes</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Contratista / Empresa</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Identificación</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Valor del Contrato</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Soportes (PDF)</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($contratos as $contrato)
                            {{-- Hover en azul muy sutil --}}
                            <tr class="hover:bg-blue-50/30 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-gray-900 group-hover:text-blue-700 transition-colors uppercase leading-tight">
                                            {{ $contrato->nombre_razon }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-bold mt-1 tracking-wider uppercase">
                                            Recibido: {{ $contrato->created_at->format('d M, Y') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-lg">
                                        {{ $contrato->id_nit }}
                                    </span>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-gray-900">
                                            $ {{ number_format($contrato->valor_total, 0, ',', '.') }}
                                        </span>
                                        {{-- Etiqueta de moneda en azul --}}
                                        <span class="text-[10px] text-blue-600 font-extrabold uppercase tracking-widest">COP</span>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        @if($contrato->rutas_documentos)
                                        @foreach($contrato->rutas_documentos as $tipo => $ruta)
                                        <a href="{{ asset('storage/' . $ruta) }}" target="_blank"
                                            class="group/file relative flex items-center justify-center h-10 w-10 bg-white border border-gray-200 rounded-xl hover:border-red-500 hover:bg-red-50 transition-all shadow-sm"
                                            title="Ver {{ strtoupper($tipo) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </a>
                                        @endforeach
                                        @else
                                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest italic">Sin Archivos</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-right">
                                    {{-- Botón de acción con hover azul profundo --}}
                                    <a href="{{ route('contratos.show', $contrato) }}"
                                        class="inline-flex items-center justify-center p-3 bg-gray-900 text-white rounded-2xl hover:bg-blue-600 hover:shadow-lg transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-50 p-6 rounded-full mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                        </div>
                                        <h4 class="text-gray-400 font-black text-xs uppercase tracking-[0.3em]">Bandeja de entrada vacía</h4>
                                        <p class="text-gray-300 text-[10px] mt-2 font-bold uppercase">No se han encontrado registros pendientes de revisión</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($contratos->hasPages())
                <div class="p-8 bg-gray-50/50 border-t border-gray-100">
                    {{ $contratos->links() }}
                </div>
                @endif
            </div>

            {{-- Footer de Estado en Azul --}}
            <div class="mt-8 px-4 flex items-center justify-between text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <div class="flex items-center space-x-4">
                    <span>Admin: Nicolás Hernández</span>
                    <span class="text-gray-200">|</span>
                    <span>Actores S.C.G. Jurídico</span>
                </div>
                <div class="flex items-center">
                    <span class="h-2 w-2 bg-blue-500 rounded-full mr-2"></span>
                    Actualizado en tiempo real
                </div>
            </div>

        </div>
    </div>
</x-app-layout>