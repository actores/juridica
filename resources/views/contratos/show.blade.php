<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('contratos.index') }}" class="p-2 bg-white rounded-xl shadow-sm hover:bg-indigo-50 hover:text-indigo-600 transition-all border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h2 class="font-black text-2xl text-gray-800 leading-tight uppercase tracking-tighter">
                    {{ __('Validación Maestra de Datos') }}
                </h2>
            </div>
            <div class="flex items-center space-x-2 bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-100">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Sincronización Activa</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/30">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 px-4">

                <div class="lg:col-span-3 space-y-8">

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="h-8 w-1.5 bg-indigo-600 rounded-full"></div>
                            <h3 class="text-lg font-black text-gray-900 tracking-tighter uppercase italic">1. Información del Contratista</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] block">Nombre o Razón Social</label>
                                <p class="text-base font-bold text-gray-800 uppercase leading-tight">{{ $contrato->nombre_razon }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] block">ID / NIT</label>
                                <p class="text-base font-bold text-gray-800 tracking-wider">{{ $contrato->id_nit }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] block">Dirección de Contacto</label>
                                <p class="text-sm font-semibold text-gray-700 uppercase">{{ $contrato->direccion }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] block">Teléfono / Celular</label>
                                <p class="text-sm font-semibold text-gray-700">{{ $contrato->telefono }}</p>
                            </div>
                            <div class="md:col-span-2 space-y-1">
                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] block">Correo Electrónico Oficial</label>
                                <p class="text-sm font-semibold text-indigo-600 italic">{{ $contrato->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="h-8 w-1.5 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-lg font-black text-gray-900 tracking-tighter uppercase italic">2. Especificaciones del Contrato</h3>
                        </div>
                        <div class="space-y-8">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-emerald-600 uppercase tracking-[0.2em] block px-3 py-1 bg-emerald-50 w-max rounded-lg">Objeto Contractual</label>
                                <p class="text-sm font-medium text-gray-700 leading-relaxed text-justify">{{ $contrato->objeto }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-emerald-600 uppercase tracking-[0.2em] block px-3 py-1 bg-emerald-50 w-max rounded-lg">
                                    Alcance de los Servicios
                                </label>

                                <div class="space-y-3 mt-4">
                                    @if(is_array($contrato->alcance) && count($contrato->alcance) > 0)
                                    @foreach($contrato->alcance as $item)
                                    <div class="flex items-start gap-3">
                                        <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-500 mt-2"></span>
                                        <p class="text-sm font-medium text-gray-700 leading-relaxed text-justify">
                                            {{ $item }}
                                        </p>
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="text-sm italic text-gray-400">No se definieron obligaciones específicas.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Cronograma de Ejecución</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between border-b border-gray-50 pb-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Fecha Inicio</span>
                                    <span class="text-xs font-black text-gray-800">{{ $contrato->fecha_inicio }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-50 pb-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Fecha Fin</span>
                                    <span class="text-xs font-black text-gray-800">{{ $contrato->fecha_fin }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Duración</span>
                                    <span class="text-xs font-black text-indigo-600 uppercase">{{ $contrato->duracion }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Supervisión y Audiencia</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between border-b border-gray-50 pb-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Supervisor</span>
                                    <span class="text-xs font-black text-gray-800 uppercase">{{ $contrato->supervisor }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Público</span>
                                    <span class="text-xs font-black text-gray-800 uppercase">{{ $contrato->publico }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                        <div class="flex items-center space-x-4 mb-10">
                            <div class="h-8 w-1.5 bg-amber-400 rounded-full"></div>
                            <h3 class="text-lg font-black text-gray-900 tracking-tighter uppercase italic">3. Información Financiera</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="p-6 bg-gray-900 rounded-[2rem] md:col-span-1 shadow-xl">
                                <label class="text-[9px] font-black text-emerald-400 uppercase tracking-widest block mb-4 italic">Valor del Contrato</label>
                                <p class="text-2xl font-black text-white">$ {{ number_format($contrato->valor_total, 0, ',', '.') }}</p>
                            </div>
                            <div class="md:col-span-2 grid grid-cols-2 gap-6 bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Entidad Bancaria</label>
                                    <p class="text-sm font-bold text-gray-700 uppercase">{{ $contrato->banco }}</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tipo de Cuenta</label>
                                    <p class="text-sm font-bold text-gray-700 uppercase">{{ $contrato->tipo_cuenta }}</p>
                                </div>
                                <div class="col-span-2 space-y-1 border-t border-gray-200 pt-3 mt-1">
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Número de Cuenta</label>
                                    <p class="text-sm font-mono font-black text-gray-800 tracking-tighter italic">{{ $contrato->numero_cuenta }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 overflow-hidden relative">
                        <div class="absolute bottom-0 right-0 p-4 opacity-[0.03]">
                            <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4">Anotaciones Adicionales</h4>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed italic">
                            {{ $contrato->observaciones ?? 'No se registraron observaciones adicionales para este expediente.' }}
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-8 space-y-6">

                        <div class="bg-white rounded-[3rem] p-10 shadow-lg border border-gray-100 relative text-center overflow-hidden">
                            <div class="absolute -top-12 -left-12 w-24 h-24 bg-emerald-50 rounded-full"></div>

                            <div class="relative z-10">
                                <div class="bg-emerald-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-emerald-200 transform -rotate-3">
                                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9l-5-5z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter italic">Finalizar</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-8 leading-relaxed">Generar documento oficial<br>Word institucional</p>

                                <form action="{{ route('contratos.generar-word', $contrato->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-xl shadow-emerald-100 transition-all hover:scale-[1.03] active:scale-95">
                                        Generar Contrato
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm">
                            <h4 class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-6 block text-center border-b border-gray-50 pb-4 italic">Soportes Validados (PDF)</h4>
                            <div class="space-y-3">
                                @foreach($contrato->rutas_documentos as $tipo => $ruta)
                                <a href="{{ asset('storage/' . $ruta) }}" target="_blank" class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-red-50 transition-colors group">
                                    <svg class="h-4 w-4 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[9px] font-black text-gray-600 group-hover:text-red-600 uppercase truncate">{{ str_replace('_', ' ', $tipo) }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>