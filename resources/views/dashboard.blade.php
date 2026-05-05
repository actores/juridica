<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="h-[1px] w-8 bg-[#642D8E]"></span>
                <div>
                    <h2 class="font-black text-2xl text-gray-900 leading-tight tracking-tighter uppercase">
                        Consola Jurídica
                    </h2>
                    <p class="text-[#642D8E] font-semibold text-[10px] tracking-[0.3em] uppercase mt-0.5">
                        Actores S.C.G.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-white border border-gray-100 px-4 py-2 rounded-2xl shadow-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#642D8E] opacity-50"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#642D8E]"></span>
                </span>
                <span class="text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Sistema Activo</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- VISTA COLABORADORES --}}
            @if(auth()->user()->role !== 'admin')
            <div class="pt-6">

                {{-- Header sección --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 px-4">
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tighter uppercase leading-none">
                            Radicación de Solicitudes
                        </h3>
                        <div class="flex items-center mt-3">
                            <span class="h-[1px] w-10 bg-[#642D8E] mr-4"></span>
                            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-[0.25em]">
                                Gestión Jurídica y Apoyo en la Creación de Contratos
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 px-4">

                    {{-- Tarjeta Centro Camaleón --}}
                    <a href="{{ route('contratos.camaleon') }}"
                        class="group bg-white border border-gray-100 rounded-[2.5rem] p-1 shadow-sm hover:shadow-lg hover:border-[#642D8E]/30 transition-all duration-500 overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center p-6 md:p-8 bg-gray-50/40 rounded-[2.2rem]">
                            <div class="bg-[#642D8E] text-white p-5 rounded-2xl shadow-lg shadow-purple-100 group-hover:bg-[#4a1f6e] transition-colors duration-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="mt-6 md:mt-0 md:ml-8 text-center md:text-left flex-1 md:border-r border-gray-100 md:pr-8">
                                <h4 class="text-lg font-black text-gray-900 uppercase tracking-tight">
                                    Nueva Solicitud de Elaboración
                                </h4>
                                <p class="text-[#642D8E] font-semibold text-[10px] tracking-[0.2em] uppercase mt-1">
                                    Unidad Operativa: Centro Camaleón
                                </p>
                                <p class="text-gray-400 text-xs mt-3 leading-relaxed max-w-xl font-normal">
                                    Cargue la información técnica y los soportes necesarios para que el equipo jurídico proceda con la redacción y formalización de su contrato.
                                </p>
                            </div>
                            <div class="mt-6 md:mt-0 md:ml-8 flex items-center flex-shrink-0">
                                <div class="text-right hidden lg:block mr-5">
                                    <span class="block text-gray-900 font-bold text-sm uppercase tracking-tighter">Nuevo Trámite</span>
                                    <span class="block text-gray-400 font-medium text-[9px] uppercase tracking-widest mt-1">Acceso Inmediato</span>
                                </div>
                                <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-[#030712] text-white group-hover:bg-[#642D8E] group-hover:scale-105 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Próximamente --}}
                    <div class="border border-dashed border-gray-200 rounded-[2.5rem] p-8 flex items-center justify-center opacity-40">
                        <div class="flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="text-gray-400 font-semibold text-[10px] uppercase tracking-[0.3em]">
                                Módulos adicionales en desarrollo
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Mis solicitudes radicadas --}}
                <div class="mt-10 px-4">
                    <div class="flex items-center mb-6">
                        <span class="h-[1px] w-8 bg-[#642D8E] mr-4"></span>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-[0.25em]">
                            Mis solicitudes radicadas
                        </p>
                    </div>

                    @php
                        $misSolicitudes = \App\Models\Contrato::where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp

                    @if($misSolicitudes->isEmpty())
                        <div class="border border-dashed border-gray-200 rounded-2xl p-8 text-center">
                            <p class="text-gray-400 text-[11px] font-medium uppercase tracking-widest">
                                Aún no has radicado ninguna solicitud
                            </p>
                        </div>
                    @else
                        <div class="flex flex-col gap-3">
                            @foreach($misSolicitudes as $solicitud)
                            <div class="bg-white border border-gray-100 rounded-2xl px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-[#642D8E]/30 hover:shadow-sm transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="bg-gray-50 border border-gray-100 text-gray-500 px-3 py-1.5 rounded-xl font-mono text-[11px] font-medium flex-shrink-0">
                                        {{ $solicitud->consecutivo }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 leading-none uppercase">{{ $solicitud->nombre_razon }}</p>
                                        <p class="text-[10px] text-gray-400 font-normal mt-1 uppercase tracking-wide">
                                            {{ $solicitud->servicio_prestado }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-[10px] font-medium text-gray-300 uppercase tracking-widest hidden md:block">
                                        {{ $solicitud->created_at->format('d/m/Y') }}
                                    </span>
                                    <a href="{{ route('contratos.show', $solicitud) }}"
                                        class="text-[10px] font-semibold uppercase tracking-widest text-[#642D8E] hover:text-white bg-purple-50 hover:bg-[#642D8E] px-4 py-2 rounded-xl transition-all duration-200">
                                        Ver detalle →
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- VISTA ADMINISTRADORES --}}
            @if(auth()->user()->role === 'admin')
            <div class="pt-6 pb-6">

                <div class="mb-10 px-4">
                    <h3 class="text-3xl font-black text-gray-900 tracking-tighter uppercase leading-none">
                        Gestión Jurídica
                    </h3>
                    <div class="flex items-center mt-3">
                        <span class="h-[1px] w-10 bg-[#642D8E] mr-4"></span>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-[0.25em]">
                            Control Maestro de Contratos & Solicitudes
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 px-4">
                    <a href="{{ route('contratos.index') }}"
                        class="group bg-white border border-gray-100 rounded-[2.5rem] p-1 shadow-sm hover:shadow-lg hover:border-[#642D8E]/30 transition-all duration-500 overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center p-8 md:p-10 bg-gray-50/40 rounded-[2.2rem]">
                            <div class="bg-[#642D8E] text-white p-6 rounded-2xl shadow-lg shadow-purple-100 group-hover:bg-[#4a1f6e] transition-colors duration-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </div>
                            <div class="mt-8 md:mt-0 md:ml-10 text-center md:text-left flex-1 md:border-r border-gray-100 md:pr-10">
                                <h4 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2">
                                    Bandeja de Entrada Maestra
                                </h4>
                                <p class="text-gray-400 text-sm font-normal leading-relaxed max-w-2xl">
                                    Supervisión técnica y legal de solicitudes recibidas. Centraliza la documentación soporte para la generación automatizada de contratos.
                                </p>
                                <div class="flex gap-3 mt-5">
                                    <span class="text-[9px] font-semibold text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1.5 rounded-lg">
                                        Documentación
                                    </span>
                                    <span class="text-[9px] font-semibold text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1.5 rounded-lg">
                                        Auditoría
                                    </span>
                                </div>
                            </div>
                            <div class="mt-8 md:mt-0 md:ml-10 flex items-center flex-shrink-0">
                                <div class="text-right hidden lg:block mr-6">
                                    <span class="block text-gray-900 font-bold text-base uppercase tracking-tighter">Gestionar</span>
                                    <span class="block text-gray-400 font-medium text-[9px] uppercase tracking-widest mt-1">Trámites Activos</span>
                                </div>
                                <div class="h-14 w-14 flex items-center justify-center rounded-2xl bg-[#030712] text-white group-hover:bg-[#642D8E] group-hover:scale-105 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endif

            {{-- Footer --}}
            <div class="mt-10 px-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-[1px] w-6 bg-[#642D8E]"></span>
                    <span class="text-[9px] font-medium text-gray-400 uppercase tracking-widest">Actores S.C.G. · Dirección Jurídica</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 bg-[#642D8E] rounded-full"></span>
                    <span class="text-[9px] font-medium text-gray-400 uppercase tracking-widest">{{ date('Y') }}</span>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                title: 'Operación exitosa',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#ffffff',
                confirmButtonColor: '#642D8E',
                confirmButtonText: 'Continuar',
            });
            @endif
        });
    </script>
</x-app-layout>