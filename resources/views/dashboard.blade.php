<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Consola de Administración IT & Jurídica') }}
            </h2>
            <div class="flex items-center space-x-2 bg-indigo-50 px-4 py-2 rounded-2xl border border-indigo-100">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                </span>
                <span class="text-xs font-black text-indigo-700 uppercase tracking-widest">Sistema Activo</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- VISTA PARA COLABORADORES: Generación de Registros --}}
            @if(auth()->user()->role !== 'admin')
            <div class="pt-12">
                {{-- Header de Sección: Estilo Arquitectónico --}}
                <div class="relative flex flex-col md:flex-row md:items-center justify-between group mb-10 px-4">
                    <div>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                            RADICACIÓN DE SOLICITUDES
                        </h3>
                        <div class="flex items-center mt-3">
                            {{-- Acento Azul Horizontal --}}
                            <div class="h-[2px] w-12 bg-blue-600 mr-4"></div>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.25em]">
                                Gestión Jurídica y Apoyo en la Creación de Contratos
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 px-4">
                    {{-- Opción 1: Centro Camaleón (Alargada) --}}
                    <a href="{{ route('contratos.camaleon') }}"
                        class="group bg-white border border-slate-200 rounded-[2.5rem] p-1 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-500 overflow-hidden">

                        <div class="flex flex-col md:flex-row items-center p-6 md:p-8 bg-slate-50/50 rounded-[2.2rem]">

                            {{-- Icono en Azul --}}
                            <div class="bg-blue-600 text-white p-5 rounded-2xl shadow-lg shadow-blue-100 group-hover:bg-blue-900 transition-colors duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>

                            {{-- Texto Central --}}
                            <div class="mt-6 md:mt-0 md:ml-8 text-center md:text-left flex-1 border-r border-slate-100 pr-8">
                                <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight">
                                    Nueva Solicitud de Elaboración
                                </h4>
                                <p class="text-blue-600 font-extrabold text-[10px] tracking-[0.2em] uppercase mt-1">
                                    Unidad Operativa: Centro Camaleón
                                </p>
                                <p class="text-slate-500 text-xs mt-3 leading-relaxed max-w-xl font-medium">
                                    Cargue la información técnica y los soportes necesarios para que el equipo jurídico proceda con la redacción y formalización de su contrato.
                                </p>
                            </div>

                            {{-- Indicador de Acción --}}
                            <div class="mt-6 md:mt-0 md:ml-8 flex items-center">
                                <div class="text-right hidden lg:block mr-5">
                                    <span class="block text-slate-900 font-black text-base uppercase tracking-tighter">Nuevo Trámite</span>
                                    <span class="block text-slate-400 font-bold text-[9px] uppercase tracking-widest mt-1">Acceso Inmediato</span>
                                </div>
                                <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-slate-900 text-white group-hover:bg-blue-600 group-hover:scale-105 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Opción 2: Placeholder Alargado (Próximamente) --}}
                    <div class="bg-slate-50/30 border-2 border-dashed border-slate-200 rounded-[2.5rem] p-8 flex items-center justify-center opacity-40">
                        <div class="flex items-center space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="text-slate-400 font-black text-[10px] uppercase tracking-[0.3em]">
                                Módulos de Gestión Adicionales en desarrollo
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- VISTA PARA ADMINISTRADORES: Gestión Jurídica --}}
            @if(auth()->user()->role === 'admin')
            <div class="pt-12 pb-6">
                <div class="mb-10 px-4">
                    {{-- 2. Header Principal: Estilo Arquitectónico --}}
                    <div class="relative flex flex-col md:flex-row md:items-center justify-between group">
                        <div>
                            <h3 class="text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                                Gestión Jurídica
                            </h3>
                            <div class="flex items-center mt-3">
                                {{-- El acento azul ahora es más profundo --}}
                                <div class="h-[2px] w-12 bg-blue-600 mr-4"></div>
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.25em]">
                                    Control Maestro de Contratos & Solicitudes
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 px-4">
                    <a href="{{ route('contratos.index') }}"
                        class="group bg-white border border-slate-200 rounded-3xl p-1 shadow-sm hover:shadow-xl hover:border-slate-300 transition-all duration-400 overflow-hidden">

                        <div class="flex flex-col md:flex-row items-center p-8 md:p-10 bg-slate-50/50 rounded-[1.4rem]">

                            {{-- Icono: Estructura Robusta en Azul Corporativo --}}
                            <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-lg group-hover:bg-blue-900 transition-colors duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </div>

                            {{-- Contenido: Limpieza Editorial --}}
                            <div class="mt-8 md:mt-0 md:ml-10 text-center md:text-left flex-1 border-r border-slate-100 pr-10">
                                <h4 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-2">
                                    Bandeja de Entrada Maestra
                                </h4>
                                <p class="text-slate-500 text-sm font-medium leading-relaxed max-w-2xl">
                                    Supervisión técnica y legal de solicitudes recibidas. Este módulo centraliza la documentación soporte para la generación automatizada de contratos del Centro Camaleón.
                                </p>
                                <div class="flex space-x-4 mt-6">
                                    <span class="flex items-center text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-3 py-1 rounded-md">
                                        Documentación
                                    </span>
                                    <span class="flex items-center text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-3 py-1 rounded-md">
                                        Auditoría
                                    </span>
                                </div>
                            </div>

                            {{-- Botón de Acción Directa --}}
                            <div class="mt-8 md:mt-0 md:ml-10 flex items-center">
                                <div class="text-right hidden lg:block mr-6">
                                    <span class="block text-slate-900 font-black text-lg leading-none uppercase tracking-tighter">Gestionar</span>
                                    <span class="block text-slate-400 font-bold text-[10px] uppercase tracking-widest mt-1">Trámites Activos</span>
                                </div>
                                <div class="h-14 w-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white group-hover:scale-105 transition-transform duration-300">
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

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                title: 'OPERACIÓN EXITOSA',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#f8fafc',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'CONTINUAR',
                customClass: {
                    title: 'font-black tracking-tighter'
                }
            });
            @endif
        });
    </script>
</x-app-layout>