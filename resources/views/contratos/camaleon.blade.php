<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="h-[1px] w-8 bg-[#642D8E]"></span>
                <div>
                    <h2 class="font-black text-2xl text-gray-900 leading-tight tracking-tighter uppercase">
                        Nueva Solicitud: Centro Camaleón
                    </h2>
                    <p class="text-[#642D8E] font-semibold text-[10px] tracking-[0.3em] uppercase mt-0.5">
                        Actores S.C.G.
                    </p>
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}"
                    class="group inline-flex items-center px-5 py-2.5 bg-white border border-gray-100 rounded-2xl font-semibold text-xs text-gray-600 uppercase tracking-widest hover:border-[#642D8E]/30 hover:text-[#642D8E] transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Panel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center space-x-3 mb-6 px-1">
                <a href="{{ route('dashboard') }}" class="text-[10px] font-semibold text-gray-400 uppercase tracking-[0.2em] hover:text-[#642D8E] transition-colors">
                    Inicio
                </a>
                <svg class="h-3 w-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-[10px] font-semibold text-[#642D8E] uppercase tracking-[0.2em]">
                    Solicitud Contrato Centro Camaleón
                </span>
            </nav>

            {{-- Header --}}
            <header class="mb-20 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-5xl font-black text-gray-900 tracking-tighter">Formulario de <span class="text-[#642D8E]">Contratación</span></h1>
                    <p class="text-gray-400 mt-3 text-lg font-normal">Operación Centro Camaleón — Actores S.C.G.</p>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest leading-tight">Sistema de Generación<br>Automática 2026</p>
                </div>
            </header>

            {{-- Errores --}}
            @if ($errors->any())
            <div class="mb-12 p-6 bg-red-50 border-l-4 border-red-400 rounded-2xl shadow-sm">
                <div class="flex items-center mb-2 text-red-700 font-bold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Atención: Verifica los siguientes campos
                </div>
                <ul class="list-disc ml-10 text-sm text-red-500 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="form-contratacion" action="{{ route('contratos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-24">
                @csrf

                {{-- SECCIÓN 01: Datos del Contratista --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <div class="lg:col-span-4">
                        <div class="sticky top-10">
                            <span class="text-6xl font-black text-gray-100 block mb-2 leading-none">01</span>
                            <h4 class="text-2xl font-black text-gray-800 tracking-tight">Datos del Contratista</h4>
                            <p class="text-gray-400 mt-4 leading-relaxed max-w-xs font-normal">Información legal y contacto del prestador. Los nombres deben coincidir exactamente con el RUT.</p>
                        </div>
                    </div>
                    <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-10">
                        <div class="col-span-2 group">
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest group-focus-within:text-[#642D8E] transition-colors">Tipo de Contratista <span class="text-[#EB128A]">*</span></label>
                            <select name="tipo_contratista" id="tipo_contratista" onchange="actualizarDocumentos(this.value)" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] focus:ring-0 transition-all font-semibold text-gray-700 shadow-sm">
                                <option value="Persona Natural" {{ old('tipo_contratista') == 'Persona Natural' ? 'selected' : '' }}>Persona Natural</option>
                                <option value="Persona Jurídica" {{ old('tipo_contratista') == 'Persona Jurídica' ? 'selected' : '' }}>Persona Jurídica</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Nombre / Razón Social <span class="text-[#EB128A]">*</span></label>
                            <input type="text" name="nombre_razon_social" value="{{ old('nombre_razon_social') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] focus:ring-0 transition-all uppercase font-bold text-gray-800 shadow-sm placeholder-gray-200" placeholder="NOMBRE COMPLETO">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Tipo Identificación <span class="text-[#EB128A]">*</span></label>
                            <select name="tipo_id" required class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold">
                                <option value="C.C." {{ old('tipo_id') == 'C.C.' ? 'selected' : '' }}>C.C.</option>
                                <option value="N.I.T." {{ old('tipo_id') == 'N.I.T.' ? 'selected' : '' }}>N.I.T.</option>
                                <option value="Pasaporte" {{ old('tipo_id') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                <option value="C.E." {{ old('tipo_id') == 'C.E.' ? 'selected' : '' }}>C.E.</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Número <span class="text-[#EB128A]">*</span></label>
                            <input type="text" name="numero_de_identificacion" value="{{ old('numero_de_identificacion') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold text-gray-800">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Fecha Expedición <span class="text-[#EB128A]">*</span></label>
                            <input type="date" name="fecha_de_expedicion" value="{{ old('fecha_de_expedicion') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold text-gray-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Teléfono <span class="text-[#EB128A]">*</span></label>
                            <input type="tel" name="telefono" value="{{ old('telefono') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold text-gray-800">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Dirección de Notificaciones <span class="text-[#EB128A]">*</span></label>
                            <input type="text" name="direccion_de_notificaciones" value="{{ old('direccion_de_notificaciones') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-semibold text-[#642D8E] uppercase mb-3 tracking-widest">Correo Electrónico <span class="text-[#EB128A]">*</span></label>
                            <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" required
                                class="w-full bg-white border-2 border-[#642D8E]/20 rounded-2xl py-5 px-6 focus:border-[#642D8E] focus:ring-4 focus:ring-[#642D8E]/10 shadow-sm font-semibold">
                        </div>
                    </div>
                </section>

                {{-- SECCIÓN 02: El Contrato --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 pt-12 border-t border-gray-100">
                    <div class="lg:col-span-4">
                        <div class="sticky top-10">
                            <span class="text-6xl font-black text-gray-100 block mb-2 leading-none">02</span>
                            <h4 class="text-2xl font-black text-gray-800 tracking-tight">El Contrato</h4>
                            <p class="text-gray-400 mt-4 leading-relaxed max-w-xs font-normal">Define el objeto y los plazos. Estos datos se inyectarán en la plantilla de Word.</p>
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-10">
                        <div class="w-full sm:w-1/3">
                            <label class="block text-[10px] font-semibold text-[#642D8E] uppercase mb-3 tracking-widest">Consecutivo Contrato <span class="text-[#EB128A]">*</span></label>
                            <input type="text" name="consecutivo" value="{{ $proximoConsecutivo ?? old('consecutivo') }}" required
                                class="w-full bg-[#642D8E]/5 border-2 border-[#642D8E]/20 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-black text-[#4a1f6e] tracking-widest uppercase" placeholder="CC-000">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Servicio Prestado <span class="text-[#EB128A]">*</span></label>
                            <input type="text" name="servicio_prestado" value="{{ old('servicio_prestado') }}" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-semibold uppercase">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Objeto del Contrato <span class="text-[#EB128A]">*</span></label>
                            <textarea name="objeto_del_contrato" rows="3" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-5 px-6 focus:border-[#642D8E] shadow-sm font-normal leading-relaxed" placeholder="Describe el propósito central del acuerdo...">{{ old('objeto_del_contrato') }}</textarea>
                        </div>
                        <div class="space-y-6">
                            <label class="block text-[10px] font-semibold text-[#642D8E] uppercase tracking-[0.2em]">
                                Alcance (Obligaciones Específicas)
                            </label>
                            <div id="lista-alcance" class="space-y-4">
                                <div class="flex items-center gap-3 animate-fade-in">
                                    <div class="flex-grow">
                                        <input type="text" name="alcance[]" required
                                            class="alcance-input w-full bg-gray-50 border-2 border-transparent rounded-2xl py-5 px-6 focus:bg-white focus:border-[#642D8E] transition-all shadow-sm font-normal outline-none placeholder:text-gray-300"
                                            placeholder="Añadir una obligación puntual...">
                                    </div>
                                    <button type="button" onclick="this.parentElement.remove()" class="p-4 text-gray-300 hover:text-[#EB128A] transition-colors">✕</button>
                                </div>
                            </div>
                            <button type="button" onclick="agregarItem()"
                                class="mt-4 flex items-center gap-3 text-[11px] font-semibold text-[#642D8E] uppercase tracking-widest hover:text-[#4a1f6e] transition-all group">
                                <span class="flex items-center justify-center w-10 h-10 border-2 border-[#642D8E] rounded-full group-hover:bg-[#642D8E] group-hover:text-white transition-all transform group-active:scale-90">
                                    +
                                </span>
                                Añadir otra obligación
                            </button>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 p-8 bg-gray-50/50 rounded-[2.5rem] border border-gray-100">
                            <div class="space-y-1">
                                <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-[0.2em]">
                                    Fecha Inicio <span class="text-[#642D8E]">*</span>
                                </label>
                                <input type="date" id="fecha_inicio" name="fecha_de_inicio"
                                    value="{{ old('fecha_de_inicio') }}" required onchange="calcularDuracion()"
                                    class="w-full bg-transparent border-none p-0 text-xl font-black text-gray-900 focus:ring-0 cursor-pointer appearance-none">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-[0.2em]">
                                    Fecha Terminación <span class="text-[#642D8E]">*</span>
                                </label>
                                <input type="date" id="fecha_fin" name="fecha_de_terminacion"
                                    value="{{ old('fecha_de_terminacion') }}" required onchange="calcularDuracion()"
                                    class="w-full bg-transparent border-none p-0 text-xl font-black text-gray-900 focus:ring-0 cursor-pointer appearance-none">
                            </div>
                            <div class="space-y-1 bg-white/60 p-4 -m-4 rounded-2xl">
                                <label class="block text-[10px] font-semibold text-[#642D8E]/70 uppercase tracking-[0.2em]">
                                    Duración Estimada
                                </label>
                                <input type="text" id="duracion_total" name="duracion_total_del_contrato"
                                    value="{{ old('duracion_total_del_contrato') }}" readonly
                                    class="w-full bg-transparent border-none p-0 text-xl font-black text-[#642D8E] focus:ring-0 placeholder:text-[#642D8E]/20"
                                    placeholder="---">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 p-8 bg-[#642D8E]/5 rounded-[2rem]">
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-semibold text-[#642D8E]/70 uppercase mb-2 tracking-widest">
                                    Público Dirigido
                                </label>
                                <select name="publico_al_cual_se_dirige" required
                                    class="w-full bg-transparent border-none p-0 text-xl font-black text-[#4a1f6e] focus:ring-0 appearance-none cursor-pointer">
                                    <option value="Socios" {{ old('publico_al_cual_se_dirige') == 'Socios' ? 'selected' : '' }}>Socios</option>
                                    <option value="No socios" {{ old('publico_al_cual_se_dirige') == 'No socios' ? 'selected' : '' }}>No socios</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-[#642D8E]/70 uppercase mb-2 tracking-widest">
                                    Nº de Personas
                                </label>
                                <input type="number" name="numero_personas" min="0" placeholder="0" required
                                    value="{{ old('numero_personas') }}"
                                    class="w-full bg-transparent border-none p-0 text-xl font-black text-[#4a1f6e] focus:ring-0 placeholder:text-[#642D8E]/20">
                            </div>
                        </div>
                        <div class="border-2 border-gray-100 rounded-[2rem] p-8 space-y-6">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div>
                                    <h5 class="font-bold text-gray-800 uppercase text-xs tracking-widest">¿Es Intuitu Personae?</h5>
                                    <p class="text-[10px] text-gray-400 font-normal mt-1">Marcar "Sí" si la ejecución depende exclusivamente de una persona específica.</p>
                                </div>
                                <div class="flex bg-gray-100 p-1 rounded-xl">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="intuitu_personae" value="Sí" {{ old('intuitu_personae') == 'Sí' ? 'checked' : '' }} onclick="toggleEjecutor(true)" class="peer hidden">
                                        <span class="px-6 py-2 block rounded-lg peer-checked:bg-white peer-checked:text-[#642D8E] peer-checked:shadow-sm text-xs font-semibold text-gray-400 transition-all uppercase">Sí</span>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="intuitu_personae" value="No" {{ old('intuitu_personae', 'No') == 'No' ? 'checked' : '' }} onclick="toggleEjecutor(false)" class="peer hidden">
                                        <span class="px-6 py-2 block rounded-lg peer-checked:bg-white peer-checked:text-[#642D8E] peer-checked:shadow-sm text-xs font-semibold text-gray-400 transition-all uppercase">No</span>
                                    </label>
                                </div>
                            </div>
                            <div id="seccion_ejecutor" class="{{ old('intuitu_personae') == 'Sí' ? '' : 'hidden' }} space-y-6 pt-6 border-t border-gray-100 animate-fade-in">
                                <h6 class="text-[10px] font-semibold text-[#4a1f6e] uppercase tracking-widest">Identificación del Ejecutor Técnico</h6>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="col-span-2">
                                        <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-2">Nombre Ejecutor</label>
                                        <input type="text" name="nombre_ejecutor" value="{{ old('nombre_ejecutor') }}"
                                            class="w-full bg-white border-2 border-gray-100 rounded-xl py-4 px-5 focus:border-[#642D8E]">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-2">Tipo ID</label>
                                        <select name="tipo_id_ejecutor" class="w-full bg-white border-2 border-gray-100 rounded-xl py-4 px-5 focus:border-[#642D8E]">
                                            <option value="CC">C.C.</option>
                                            <option value="NIT">NIT</option>
                                            <option value="Pasaporte">Pasaporte</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-2">Número</label>
                                        <input type="text" name="id_ejecutor" value="{{ old('id_ejecutor') }}"
                                            class="w-full bg-white border-2 border-gray-100 rounded-xl py-4 px-5 focus:border-[#642D8E]">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-3 tracking-widest">Supervisor del Contrato <span class="text-[#EB128A]">*</span></label>
                                <input type="text" name="supervisor_del_contrato" value="{{ old('supervisor_del_contrato') }}" required
                                    class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 px-6 focus:border-[#642D8E] shadow-sm font-semibold">
                            </div>
                        </div>
                    </div>
                </section>

                {{-- SECCIÓN 03: Finanzas --}}
                <section class="bg-gray-900 rounded-[3rem] p-10 lg:p-20 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 bg-[#642D8E] rounded-full blur-[120px] opacity-20"></div>
                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                        <div class="lg:col-span-5">
                            <span class="text-[#642D8E]/70 font-semibold text-xs uppercase tracking-[0.4em] mb-4 block">Finanzas</span>
                            <h4 class="text-4xl font-black mb-6 tracking-tight leading-tight text-white">Esquema de <br>Remuneración</h4>
                            <p class="text-gray-400 leading-relaxed text-sm max-w-xs font-normal">Define el valor monetario y la estructura de desembolsos. Revisa cuidadosamente los datos bancarios.</p>
                        </div>
                        <div class="lg:col-span-7 space-y-12">
                            <div class="group">
                                <label class="block text-[10px] font-semibold text-[#642D8E]/70 uppercase mb-4 tracking-[0.2em]">Valor Total del Contrato ($) <span class="text-[#EB128A]">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-0 top-1/2 -translate-y-1/2 text-5xl font-light text-[#642D8E]/40">$</span>
                                    <input type="number" name="valor_del_contrato" value="{{ old('valor_del_contrato') }}" step="0.01" required
                                        class="w-full bg-transparent border-b-2 border-gray-800 border-t-0 border-x-0 py-6 pl-12 text-6xl font-black text-white focus:border-[#642D8E] focus:ring-0 transition-all placeholder-gray-800"
                                        placeholder="0.00">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-3 tracking-widest">Esquema de Pago <span class="text-[#EB128A]">*</span></label>
                                        <select id="select_forma_pago" name="forma_de_pago" required onchange="verificarOtroPago(this.value)"
                                            class="w-full bg-gray-800/50 border-none rounded-2xl py-5 px-6 text-white focus:ring-2 focus:ring-[#642D8E] font-semibold">
                                            <option value="Pago único" {{ old('forma_de_pago') == 'Pago único' ? 'selected' : '' }}>Un solo pago final</option>
                                            <option value="Mensualidades" {{ old('forma_de_pago') == 'Mensualidades' ? 'selected' : '' }}>Mensualidades vencidas</option>
                                            <option value="Anticipo y Saldo" {{ old('forma_de_pago') == 'Anticipo y Saldo' ? 'selected' : '' }}>50% Anticipo - 50% Final</option>
                                            <option value="Otro" {{ old('forma_de_pago') == 'Otro' ? 'selected' : '' }}>Otro (Especificar)</option>
                                        </select>
                                    </div>
                                    <div id="campo_otro_pago" class="{{ old('forma_de_pago') == 'Otro' ? '' : 'hidden' }} animate-fade-in">
                                        <label class="block text-[10px] font-semibold text-orange-400 uppercase mb-3 tracking-widest">Especifique forma de pago</label>
                                        <textarea name="forma_de_pago_otro" rows="2" class="w-full bg-orange-900/20 border-orange-900/50 rounded-2xl text-orange-100 p-4 font-normal">{{ old('forma_de_pago_otro') }}</textarea>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-3 tracking-widest">Entidad Bancaria <span class="text-[#EB128A]">*</span></label>
                                        <input type="text" name="banco" value="{{ old('banco') }}" required
                                            class="w-full bg-gray-800/50 border-none rounded-2xl py-5 px-6 text-white focus:ring-2 focus:ring-[#642D8E] font-semibold" placeholder="Nombre del banco">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-3 tracking-widest">Tipo de Cuenta <span class="text-[#EB128A]">*</span></label>
                                    <select name="tipo_de_cuenta" required class="w-full bg-gray-800/50 border-none rounded-2xl py-5 px-6 text-white focus:ring-2 focus:ring-[#642D8E] font-semibold">
                                        <option value="Ahorros" {{ old('tipo_de_cuenta') == 'Ahorros' ? 'selected' : '' }}>Ahorros</option>
                                        <option value="Corriente" {{ old('tipo_de_cuenta') == 'Corriente' ? 'selected' : '' }}>Corriente</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-3 tracking-widest">No. de Cuenta <span class="text-[#EB128A]">*</span></label>
                                    <input type="text" name="no_de_cuenta_para_pago" value="{{ old('no_de_cuenta_para_pago') }}" required
                                        class="w-full bg-gray-800/50 border-none rounded-2xl py-5 px-6 text-white focus:ring-2 focus:ring-[#642D8E] font-semibold text-center tracking-widest">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- SECCIÓN 04: Cierre y Soportes --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 pt-12">
                    <div class="lg:col-span-4">
                        <div class="sticky top-10">
                            <span class="text-6xl font-black text-gray-100 block mb-2 leading-none">04</span>
                            <h4 class="text-2xl font-black text-gray-800 tracking-tight">Cierre y Soportes</h4>
                            <p class="text-gray-400 mt-4 leading-relaxed max-w-xs font-normal">Anexa los archivos PDF obligatorios y añade cualquier observación final para Jurídica.</p>
                        </div>
                    </div>
                    <div class="lg:col-span-8 space-y-12">
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-6 tracking-widest text-center">Documentación Requerida (Soportes PDF)</label>
                            <div id="documentos_dinamicos" class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-10 bg-white border-4 border-dashed border-gray-100 rounded-[3rem]">
                            </div>
                            <p class="mt-4 text-[10px] text-gray-400 text-center uppercase font-semibold italic tracking-widest">Máximo 5MB por archivo</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-gray-400 uppercase mb-4 tracking-widest">Notas Adicionales</label>
                            <textarea name="observaciones" rows="4"
                                class="w-full bg-white border-2 border-gray-100 rounded-[2rem] py-6 px-8 focus:border-[#642D8E] shadow-sm transition-all placeholder-gray-300 font-normal"
                                placeholder="Cláusulas especiales, excepciones o detalles para el área jurídica...">{{ old('observaciones') }}</textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-8 pt-12 border-t border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-[#642D8E] rounded-full flex items-center justify-center shadow-xl shadow-[#642D8E]/20">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="text-sm font-bold text-gray-900 leading-tight">Proceso Verificado</h6>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter font-normal">Sistematización Actores S.C.G.</p>
                                </div>
                            </div>
                            <button type="submit" class="group relative w-full sm:w-auto overflow-hidden px-16 py-6 bg-gray-900 rounded-full transition-all hover:scale-105 active:scale-95 shadow-2xl">
                                <span class="relative z-10 text-white font-black text-xl uppercase tracking-widest">Realizar Solicitud</span>
                                <div class="absolute inset-0 bg-[#642D8E] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .animate-fade-in { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        input:focus, select:focus, textarea:focus {
            border-color: #642D8E !important;
            box-shadow: 0 0 0 3px rgba(100, 45, 142, 0.1) !important;
        }
    </style>

    <script>
        const docsNatural = [
            { label: 'Identificación (Cédula)', name: 'doc_identificacion' },
            { label: 'RUT Actualizado', name: 'doc_rut' },
            { label: 'Propuesta Técnica/Económica', name: 'doc_propuesta' },
            { label: 'Certificación Bancaria', name: 'doc_cert_bancaria' }
        ];
        const docsJuridica = [
            { label: 'Cámara de Comercio', name: 'doc_camara_comercio' },
            { label: 'RUT Empresa', name: 'doc_rut' },
            { label: 'Identificación Representante Legal', name: 'doc_id_representante' },
            { label: 'Propuesta Técnica/Económica', name: 'doc_propuesta' },
            { label: 'Certificación Bancaria', name: 'doc_cert_bancaria' }
        ];

        function actualizarDocumentos(tipo) {
            const contenedor = document.getElementById('documentos_dinamicos');
            const lista = (tipo === 'Persona Natural') ? docsNatural : docsJuridica;
            contenedor.innerHTML = '';
            lista.forEach(doc => {
                const div = document.createElement('div');
                div.className = 'animate-fade-in group';
                div.innerHTML = `
                    <label class="block text-[10px] font-semibold text-gray-500 uppercase mb-1 tracking-tighter">${doc.label} <span class="text-[#EB128A]">*</span></label>
                    <div class="relative border-2 border-dashed border-gray-200 rounded-xl p-2 bg-white group-hover:border-[#642D8E]/40 transition-all">
                        <input type="file" name="documentos[${doc.name}]" accept=".pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileName(this)">
                        <div class="flex items-center space-x-2">
                            <div class="bg-[#642D8E]/5 p-2 rounded-lg text-[#642D8E]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <span class="text-[11px] text-gray-400 font-normal truncate fileNameLabel">Seleccionar PDF...</span>
                        </div>
                    </div>
                `;
                contenedor.appendChild(div);
            });
        }

        function updateFileName(input) {
            const label = input.parentElement.querySelector('.fileNameLabel');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                label.classList.replace('text-gray-400', 'text-[#642D8E]');
            }
        }

        function agregarItem() {
            const contenedor = document.getElementById('lista-alcance');
            const inputs = contenedor.querySelectorAll('.alcance-input');
            let canAdd = true;
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    canAdd = false;
                    input.classList.remove('border-transparent');
                    input.classList.add('border-red-300', 'bg-red-50/50');
                    input.focus();
                    input.oninput = () => {
                        input.classList.remove('border-red-300', 'bg-red-50/50');
                        input.classList.add('border-transparent');
                    };
                }
            });
            if (!canAdd) return;
            const nuevoDiv = document.createElement('div');
            nuevoDiv.className = 'flex items-center gap-3 animate-fade-in';
            nuevoDiv.innerHTML = `
                <div class="flex-grow">
                    <input type="text" name="alcance[]" required
                        class="alcance-input w-full bg-gray-50 border-2 border-transparent rounded-2xl py-5 px-6 focus:bg-white focus:border-[#642D8E] transition-all shadow-sm font-normal outline-none placeholder:text-gray-300"
                        placeholder="Describir otra obligación...">
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="p-4 text-gray-300 hover:text-[#EB128A] transition-colors">✕</button>
            `;
            contenedor.appendChild(nuevoDiv);
            nuevoDiv.querySelector('input').focus();
        }

        function calcularDuracion() {
            const inicioStr = document.getElementById('fecha_inicio').value;
            const finStr = document.getElementById('fecha_fin').value;
            const campo = document.getElementById('duracion_total');
            if (inicioStr && finStr) {
                const f1 = new Date(inicioStr + 'T00:00:00');
                const f2 = new Date(finStr + 'T00:00:00');
                if (f2 < f1) { campo.value = "La fecha fin debe ser mayor"; return; }
                let años = f2.getFullYear() - f1.getFullYear();
                let meses = f2.getMonth() - f1.getMonth();
                let dias = f2.getDate() - f1.getDate();
                if (dias < 0) { meses--; dias += new Date(f2.getFullYear(), f2.getMonth(), 0).getDate(); }
                if (meses < 0) { años--; meses += 12; }
                let mesesTotales = meses + (años * 12);
                let resultado = [];
                if (mesesTotales > 0) resultado.push(`${mesesTotales} ${mesesTotales === 1 ? 'mes' : 'meses'}`);
                if (dias > 0) resultado.push(`${dias} ${dias === 1 ? 'día' : 'días'}`);
                campo.value = resultado.length === 0 ? "0 días (Mismo día)" : resultado.join(' y ');
            }
        }

        function toggleEjecutor(mostrar) {
            const seccion = document.getElementById('seccion_ejecutor');
            const inputs = seccion.querySelectorAll('input, select');
            seccion.classList.toggle('hidden', !mostrar);
            inputs.forEach(i => i.required = mostrar);
        }

        function verificarOtroPago(valor) {
            const campo = document.getElementById('campo_otro_pago');
            const textarea = campo.querySelector('textarea');
            campo.classList.toggle('hidden', valor !== 'Otro');
            textarea.required = (valor === 'Otro');
        }

        document.getElementById('form-contratacion').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Procesando Solicitud',
                text: 'Estamos generando el documento y notificando al área jurídica...',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                confirmButtonColor: '#642D8E',
                didOpen: () => { Swal.showLoading(); }
            });
            setTimeout(() => { this.submit(); }, 1000);
        });

        window.onload = function() {
            actualizarDocumentos(document.getElementById('tipo_contratista').value);
            if (document.getElementById('fecha_inicio').value) calcularDuracion();
        }
    </script>
</x-app-layout>