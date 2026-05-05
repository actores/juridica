<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Jurídica | Gestión de Solicitudes y Contratos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, #f8fafc, #ffffff);
        }
    </style>
</head>

<body class="hero-gradient text-slate-900 antialiased min-h-screen flex flex-col relative overflow-x-hidden">

    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute bottom-[-15%] right-[-10%] w-[500px] md:w-[700px] lg:w-[900px] opacity-[0.04] text-blue-900">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path
                    d="M10,80 
                   C20,95 50,98 70,85 
                   C90,70 95,40 80,20 
                   C65,0 35,5 20,25 
                   C5,45 10,70 30,75 
                   C45,80 60,70 65,55 
                   C70,40 55,30 45,35 
                   C38,38 38,48 45,50"
                    stroke="currentColor"
                    stroke-width="0.6"
                    stroke-linecap="round" />
                <path
                    d="M15,75 C25,90 55,90 70,75 C85,60 85,35 70,20"
                    stroke="currentColor"
                    stroke-width="0.2"
                    stroke-dasharray="2 2"
                    opacity="0.5" />
            </svg>
        </div>
    </div>

    <nav class="relative z-10 flex flex-col sm:flex-row justify-between items-center px-6 md:px-8 py-6 max-w-7xl mx-auto w-full gap-4 sm:gap-0">
        <div class="text-xl md:text-2xl font-bold tracking-tighter text-blue-900 text-center sm:text-left">
            ACTORES S.C.G.<span class="text-slate-400 font-light"> JURÍDICA</span>
        </div>
        <div class="flex items-center">
            @if (Route::has('login'))
            <livewire:welcome.navigation />
            @endif
        </div>
    </nav>

    <main class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-8 flex-grow flex flex-col-reverse lg:flex-row items-center justify-between py-8 lg:py-0 gap-12 lg:h-[80vh]">
        <div class="w-full lg:w-1/2 space-y-6 md:space-y-8 text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold leading-[1.1] tracking-tight text-slate-900">
                Formaliza tus proyectos <br class="hidden md:block">
                <span class="text-blue-600">con respaldo jurídico.</span>
            </h1>
            <p class="text-base md:text-lg lg:text-xl text-slate-500 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                El canal oficial para que todas las áreas de la sociedad gestionen la creación de contratos. Envía tus requerimientos y centraliza tus solicitudes en un solo lugar.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-blue-600 text-white font-semibold hover:scale-105 transition-transform shadow-lg shadow-blue-600/20 text-center inline-block">
                    Solicitar Contrato
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex justify-center lg:justify-end Relative z-10">
            <div class="w-full max-w-[320px] md:max-w-[450px] lg:max-w-lg">
                <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto drop-shadow-2xl">
                    <rect x="50" y="50" width="350" height="280" rx="24" fill="#EFF6FF" />
                    <rect x="80" y="80" width="290" height="10" rx="5" fill="#DBEAFE" />
                    <rect x="80" y="110" width="180" height="10" rx="5" fill="#DBEAFE" />
                    <g class="animate-bounce" style="animation-duration: 4s;">
                        <rect x="320" y="150" width="120" height="160" rx="16" fill="white" stroke="#E2E8F0" stroke-width="2" />
                        <path d="M350 190H410M350 220H410M350 250H380" stroke="#3B82F6" stroke-width="4" stroke-linecap="round" />
                    </g>
                    <circle cx="100" cy="300" r="40" fill="#2563EB" />
                    <path d="M90 300L97 307L110 294" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M400 50Q450 100 400 150" stroke="#CBD5E1" stroke-width="2" stroke-dasharray="8 8" />
                </svg>
            </div>
        </div>
    </main>

    <footer class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-8 py-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-400 text-sm">
        <p class="text-center md:text-left">&copy; 2026 Actores S.C.G. | Área Jurídica</p>
        <div class="group relative inline-block">
            <a href="mailto:sistemas@actores.org.co" class="hover:text-blue-600 transition-colors">
                Soporte Interno
            </a>
            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:flex items-center justify-center">
                <div class="bg-slate-900 text-white text-[11px] py-2 px-4 rounded-lg whitespace-nowrap shadow-xl">
                    Contacta a Tecnología: <span class="text-blue-400 ml-1">sistemas@actores.org.co</span>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-900"></div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>