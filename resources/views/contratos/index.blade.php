<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="h-[1px] w-8 bg-[#642D8E]"></span>
                <div>
                    <h2 class="font-black text-2xl text-gray-900 leading-tight tracking-tighter uppercase">
                        Bandeja de Entrada Jurídica
                    </h2>
                    <p class="text-[#642D8E] font-semibold text-[10px] tracking-[0.3em] uppercase mt-0.5">
                        Gestión Centralizada de Contratos
                    </p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-5 py-2.5 bg-white border border-gray-100 hover:border-[#642D8E]/30 hover:text-[#642D8E] text-gray-600 text-xs font-semibold uppercase tracking-widest rounded-2xl transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center space-x-3 mb-6 px-1">
                <a href="{{ route('dashboard') }}" class="text-[10px] font-semibold text-gray-400 uppercase tracking-[0.2em] hover:text-[#642D8E] transition-colors">
                    Inicio
                </a>
                <svg class="h-3 w-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-[10px] font-semibold text-[#642D8E] uppercase tracking-[0.2em]">
                    Solicitudes Recibidas
                </span>
            </nav>

            {{-- Panel principal --}}
            <div class="bg-white overflow-hidden shadow-[0_20px_60px_rgba(100,45,142,0.06)] sm:rounded-[3rem] border border-gray-100">

                {{-- Header --}}
                <div class="p-8 sm:p-10 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-[#642D8E] p-3 rounded-2xl shadow-lg shadow-[#642D8E]/20 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9l-5-5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900 tracking-tight uppercase">Solicitudes Recibidas</h3>
                            <p class="text-gray-400 text-xs font-medium mt-0.5">Mostrando {{ $contratos->count() }} trámites recientes</p>
                        </div>
                    </div>
                </div>

                {{-- Tabla --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-100">
                                <th class="px-8 py-4 text-[9px] font-semibold text-gray-400 uppercase tracking-[0.25em]">Contratista / Empresa</th>
                                <th class="px-8 py-4 text-[9px] font-semibold text-gray-400 uppercase tracking-[0.25em]">Identificación</th>
                                <th class="px-8 py-4 text-[9px] font-semibold text-gray-400 uppercase tracking-[0.25em]">Valor del Contrato</th>
                                <th class="px-8 py-4 text-[9px] font-semibold text-gray-400 uppercase tracking-[0.25em]">Soportes (PDF)</th>
                                <th class="px-8 py-4 text-[9px] font-semibold text-gray-400 uppercase tracking-[0.25em] text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($contratos as $contrato)
                            <tr class="hover:bg-[#642D8E]/5 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900 group-hover:text-[#642D8E] transition-colors uppercase leading-tight">
                                            {{ $contrato->nombre_razon }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-medium mt-1 tracking-wide uppercase">
                                            Recibido: {{ $contrato->created_at->format('d M, Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs font-medium text-gray-600 bg-gray-100 px-3 py-1.5 rounded-xl font-mono">
                                        {{ $contrato->id_nit }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-bold text-gray-900">
                                        $ {{ number_format($contrato->valor_total, 0, ',', '.') }}
                                    </span>
                                    <span class="block text-[10px] text-[#642D8E] font-semibold uppercase tracking-widest mt-0.5">COP</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        @if($contrato->rutas_documentos)
                                            @foreach($contrato->rutas_documentos as $tipo => $ruta)
                                            <a href="{{ asset('storage/' . $ruta) }}" target="_blank"
                                                class="flex items-center justify-center h-9 w-9 bg-white border border-gray-200 rounded-xl hover:border-[#EB128A] hover:bg-pink-50 transition-all shadow-sm"
                                                title="Ver {{ strtoupper($tipo) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#EB128A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            </a>
                                            @endforeach
                                        @else
                                            <span class="text-[10px] font-medium text-gray-300 uppercase tracking-widest italic">Sin archivos</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('contratos.show', $contrato) }}"
                                        class="inline-flex items-center justify-center h-9 w-9 bg-[#030712] text-white rounded-xl hover:bg-[#642D8E] transition-all duration-300 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                        <div class="bg-[#642D8E]/5 p-6 rounded-full mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-[#642D8E]/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                        </div>
                                        <h4 class="text-gray-400 font-bold text-xs uppercase tracking-[0.3em]">Bandeja de entrada vacía</h4>
                                        <p class="text-gray-300 text-[10px] mt-2 font-medium uppercase tracking-wide">No se han encontrado registros pendientes de revisión</p>
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

            {{-- Footer --}}
            <div class="mt-8 px-2 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-[1px] w-6 bg-[#642D8E]"></span>
                    <span class="text-[9px] font-medium text-gray-400 uppercase tracking-widest">Actores S.C.G. · Dirección Jurídica</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 bg-[#642D8E] rounded-full"></span>
                    <span class="text-[9px] font-medium text-gray-400 uppercase tracking-widest">Actualizado en tiempo real</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>