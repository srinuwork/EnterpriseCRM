<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Project Overview | CRM System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
             body { background-color: #f8fafc; }
             .tech-card { transition: all 0.3s ease; border: 1px solid #e2e8f0; }
             .tech-card:hover { transform: translateY(-3px); border-color: #6366f1; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); }
        </style>
    </head>
    <body class="antialiased font-sans text-slate-900">
        
        <!-- Navigation Header -->
        <nav class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 bg-slate-900 rounded-lg flex items-center justify-center">
                        <x-application-logo class="h-6 w-6 fill-white" />
                    </div>
                    <span class="text-xl font-bold tracking-tight">CRM<span class="text-indigo-600">Enterprise</span></span>
                </div>
                
                @if (Route::has('login'))
                    <div class="flex items-center space-x-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700">Dashboard →</a>
                        @else
                        <div class="flex items-center space-x-6">
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900 transition flex items-center">
                                Log In
                            </a>
                            @if($adminLoginEnabled)
                            <a href="{{ route('admin.login') }}" class="text-xs font-black text-slate-400 hover:text-indigo-600 transition flex items-center uppercase tracking-widest">
                                🔐 Admin Portal
                            </a>
                            @endif
                        </div>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 shadow-md transition whitespace-nowrap">Get Started</a>
                                @if($adminRegisterEnabled)
                                <a href="{{ route('admin.register') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition flex items-center whitespace-nowrap">
                                    🛡️ Admin Entry
                                </a>
                                @endif
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="max-w-5xl mx-auto px-6 py-20">
            <div class="text-center space-y-6 mb-20">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                    Professional CRM Architecture
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    A technical overview of the system build, stack dependencies, and operational workflow. Built for scale, security, and administrative efficiency.
                </p>
                <div class="flex justify-center gap-4 pt-4">
                    <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-[11px] font-bold text-slate-500 uppercase tracking-widest">v2.1.0 Stable</span>
                    <span class="px-3 py-1 bg-indigo-50 border border-indigo-100 rounded-full text-[11px] font-bold text-indigo-600 uppercase tracking-widest">Laravel 12.x</span>
                </div>
            </div>

            <!-- Project Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <!-- Section 1: Core Framework -->
                <div class="bg-white p-10 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                    <div class="inline-flex p-3 bg-red-50 rounded-xl">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Core Framework & Stack</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Built on the latest **Laravel 12** framework, utilizing a modern **PHP 8.2+** backend. The system leverages the **TALL Stack** philosophy for high interactivity without full SPA complexity.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm font-medium text-slate-700">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-3"></span>
                            Blade Templating Engine
                        </div>
                        <div class="flex items-center text-sm font-medium text-slate-700">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-3"></span>
                            Tailwind CSS Content-First Styling
                        </div>
                        <div class="flex items-center text-sm font-medium text-slate-700">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-3"></span>
                            Alpine.js Reactive UI States
                        </div>
                    </div>
                </div>

                <!-- Section 2: Key Packages -->
                <div class="bg-white p-10 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                    <div class="inline-flex p-3 bg-blue-50 rounded-xl">
                         <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Integrated Packages</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Industry-standard dependencies are used to handle authentication, frontend compilation, and database management.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-xs bg-slate-50 border border-slate-100 p-3 rounded-lg font-mono font-bold">laravel/breeze</div>
                        <div class="text-xs bg-slate-50 border border-slate-100 p-3 rounded-lg font-mono font-bold">vite/plugin</div>
                        <div class="text-xs bg-slate-50 border border-slate-100 p-3 rounded-lg font-mono font-bold">sweetalert2</div>
                        <div class="text-xs bg-slate-50 border border-slate-100 p-3 rounded-lg font-mono font-bold">alpinejs</div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Operational Flow -->
            <div class="mt-12 bg-slate-900 rounded-3xl p-10 md:p-16 text-white relative overflow-hidden">
                <div class="relative z-10 space-y-8">
                    <h2 class="text-3xl font-bold">Operational Workflow</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="space-y-3">
                            <div class="text-indigo-400 font-extrabold text-xl">01.</div>
                            <h3 class="font-bold">Auth Layer</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">Multi-role authentication with Session persistence.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="text-indigo-400 font-extrabold text-xl">02.</div>
                            <h3 class="font-bold">Asset Link</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">Relational Eloquent mapping between Clients and Projects.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="text-indigo-400 font-extrabold text-xl">03.</div>
                            <h3 class="font-bold">Financials</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">Transactional ledger entries with automated status audit.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="text-indigo-400 font-extrabold text-xl">04.</div>
                            <h3 class="font-bold">Role Gate</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">Middleware restricted endpoint access for Admin staff.</p>
                        </div>
                    </div>
                </div>
                <!-- Abstract BG decoration -->
                <div class="absolute top-0 right-0 h-full w-1/3 bg-indigo-600 opacity-10 transform skew-x-12 translate-x-20"></div>
            </div>

            <!-- Tech Footer Detail -->
            <div class="mt-20 text-center space-y-4">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Build Environment Information</p>
                <div class="flex flex-wrap justify-center gap-6 grayscale opacity-60">
                    <span class="text-sm font-bold">🐘 PHP 8.2</span>
                    <span class="text-sm font-bold">📦 COMPOSER</span>
                    <span class="text-sm font-bold">⚡ VITE</span>
                    <span class="text-sm font-bold">🛡️ SQLITE</span>
                </div>
            </div>
        </main>

        <footer class="py-12 border-t border-slate-200 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
                Authorized Documentation Console • CRM System Deployment v2.1
            </p>
        </footer>

    </body>
</html>
