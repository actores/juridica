<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jurídica') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="https://actores.org.co/favicon.ico" type="image/x-icon">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F3F4F6] text-[#030712] antialiased h-full overflow-x-hidden">
    <!-- Decoración de fondo -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-[#642D8E] rounded-full blur-[120px] opacity-[0.05]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-[#EB128A] rounded-full blur-[120px] opacity-[0.05]"></div>
    </div>

    <div class="h-screen flex items-center justify-center p-4 sm:p-8 relative z-10">
        <main class="w-full max-w-6xl h-full lg:h-[750px] bg-white rounded-[40px] shadow-2xl shadow-purple-900/10 border border-gray-100 flex flex-col lg:flex-row overflow-hidden fade-in-up">
            
            <!-- SECCIÓN IZQUIERDA (Visual) -->
            <div class="relative w-full lg:w-1/2 h-[30%] lg:h-full bg-[#642D8E] flex flex-col justify-between p-10 lg:p-16">
                <div class="absolute inset-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                
                <div class="relative z-10">
                    <p class="text-[#D4DF2F] text-[10px] lg:text-[11px] font-black uppercase tracking-[0.5em] mb-4 lg:mb-6">Gestión Jurídica</p>
                    <h1 class="text-white text-5xl lg:text-6xl font-black leading-[0.8] lg:leading-[0.85] tracking-tighter uppercase">CONTRATOS</h1>
                    <p class="text-white/80 mt-4 lg:mt-6 font-bold text-[10px] lg:text-xs uppercase tracking-[0.2em]">Actores Sociedad Colombiana de Gestión</p>
                </div>

                <div class="relative z-10 hidden lg:block">
                    <div class="h-[2px] w-16 bg-[#1EA69C] mb-8"></div>
                    <h2 class="text-white text-3xl font-bold leading-tight">Estructura legal y soporte contractual.</h2>
                    <p class="text-white/60 mt-4 font-semibold text-sm leading-relaxed max-w-sm">Plataforma para la solicitud y revisión de procesos contractuales institucionales.</p>
                </div>
            </div>

            <!-- SECCIÓN DERECHA (Contenido dinámico / Formulario) -->
            <div class="w-full lg:w-1/2 h-[70%] lg:h-full flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white relative">
                {{ $slot }}
                
                <!-- Footer fijo en el layout -->
                <div class="absolute bottom-6 lg:bottom-12 left-0 w-full px-8 sm:px-16 lg:px-24 pointer-events-none">
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100/50">
                        <div class="flex-1">
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Dirección Jurídica</p>
                            <p class="text-[8px] text-gray-300 font-semibold mt-1">Actores Sociedad Colombiana de Gestión © {{ date('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>