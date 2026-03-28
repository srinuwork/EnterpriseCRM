<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ showPassword: false }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Authentication</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            .auth-gradient {
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }
            .brand-gradient {
                background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            }
            .floating-label-input:focus ~ label,
            .floating-label-input:not(:placeholder-shown) ~ label {
                transform: translateY(-1.5rem) scale(0.85);
                color: #4f46e5;
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex items-center justify-center p-4 md:p-8 overflow-x-hidden">
            <!-- Full Width Container -->
            <div class="max-w-6xl w-full flex bg-white rounded-[2rem] shadow-2xl overflow-hidden min-h-[700px]">
                
                <!-- Left Column (Branding/Illustration) - Hidden on mobile -->
                <div class="hidden lg:flex w-1/2 brand-gradient relative p-16 flex-col justify-between text-white">
                    <div class="relative z-10">
                        <div class="flex items-center space-x-3 mb-10">
                            <div class="h-12 w-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/30">
                                <x-application-logo class="h-7 w-7 fill-white" />
                            </div>
                            <span class="text-2xl font-black tracking-tighter uppercase">Admin<span class="text-white/70">CRM</span></span>
                        </div>
                        
                        <div class="space-y-6">
                            <h2 class="text-5xl font-black leading-tight tracking-tight">Unified Client <br/>Management.</h2>
                            <p class="text-lg text-indigo-100 font-medium max-w-md leading-relaxed">
                                Experience the most advanced enterprise-grade console for managing projects, financial ledger, and client interactions in one workspace.
                            </p>
                        </div>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute top-40 right-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-2xl animate-pulse"></div>

                    <div class="relative z-10 pt-10 border-t border-white/10">
                        <div class="flex items-center space-x-4">
                            <div class="flex -space-x-3">
                                <div class="h-10 w-10 rounded-full border-2 border-indigo-600 bg-slate-200"></div>
                                <div class="h-10 w-10 rounded-full border-2 border-indigo-600 bg-slate-300"></div>
                                <div class="h-10 w-10 rounded-full border-2 border-indigo-600 bg-indigo-400"></div>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-widest text-indigo-100 italic">Trusted by 500+ Enterprise Leads</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Auth Form) -->
                <div class="w-full lg:w-1/2 p-8 md:p-16 flex flex-col justify-center bg-white">
                    <div class="max-w-[420px] mx-auto w-full">
                        {{ $slot }}
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
