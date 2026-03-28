<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
          sidebarOpen: localStorage.getItem('sidebarOpen') === null ? true : localStorage.getItem('sidebarOpen') === 'true',
          toggleSidebar() {
              this.sidebarOpen = !this.sidebarOpen;
              localStorage.setItem('sidebarOpen', this.sidebarOpen);
          }
      }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} CRM</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
            .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 overflow-x-hidden">
        
        <div class="flex min-h-screen relative">
            
            <!-- DESKTOP SIDEBAR -->
            <aside 
                :class="sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full lg:translate-x-0 w-20'"
                class="sidebar-transition fixed lg:sticky top-0 left-0 h-screen bg-slate-900 text-white z-50 shadow-2xl flex flex-col overflow-y-auto overflow-x-hidden transform lg:transform-none">
                
                <!-- Sidebar Logo & Toggle -->
                <div class="flex items-center px-6 py-10 transition-all duration-300" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                    <div class="flex items-center space-x-3 overflow-hidden" x-show="sidebarOpen" x-transition:enter="delay-100 duration-200">
                        <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shrink-0">
                            <x-application-logo class="h-6 w-6 fill-white" />
                        </div>
                        <span class="text-xl font-black tracking-tight uppercase whitespace-nowrap">Admin<span class="text-indigo-500">CRM</span></span>
                    </div>
                    
                    <button @click="toggleSidebar()" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7m0 0l7-7m-7 7h18" />
                            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H6" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-3 py-4 space-y-2">
                    <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 truncate">Main Navigation</p>
                    
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">🏠</span>
                        <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                    </a>

                    <!-- Clients -->
                    <a href="{{ route('clients.index') }}" 
                       class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('clients.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">👥</span>
                        <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-300">Client Directory</span>
                    </a>

                    <!-- Products -->
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">📦</span>
                        <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-300">Projects</span>
                    </a>

                    <!-- Payments (Admin Only) -->
                    @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                    <a href="{{ route('payments.index') }}" 
                       class="flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('payments.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">💳</span>
                        <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-300">Payments</span>
                    </a>
                    @endif

                    <div class="pt-10">
                        <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 truncate">Account</p>
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
                           <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">⚙️</span>
                           <span x-show="sidebarOpen" class="whitespace-nowrap">Settings</span>
                        </a>
                        
                        @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                        <a href="{{ route('admin.settings') }}" class="mt-2 flex items-center px-4 py-3 text-sm font-bold rounded-xl {{ request()->routeIs('admin.settings') ? 'bg-slate-800 text-white border-l-4 border-indigo-500' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                           <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">🛡️</span>
                           <span x-show="sidebarOpen" class="whitespace-nowrap">Security Console</span>
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form" class="mt-2">
                            @csrf
                            <button type="button" @click="logoutConfirm('sidebar-logout-form')" class="w-full flex items-center px-4 py-3 text-sm font-bold rounded-xl text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-all duration-200">
                                <span class="text-xl shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'">🚪</span>
                                <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-300">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </nav>

                <!-- Sidebar Footer Status -->
                <div class="p-6 bg-slate-950/40 border-t border-slate-800/50">
                    <div class="flex items-center" :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                         <div class="h-8 w-8 rounded-full bg-slate-800 overflow-hidden flex items-center justify-center font-bold text-xs shrink-0 border border-slate-700">
                            {{ substr(Auth::user()->name, 0, 1) }}
                         </div>
                         <div class="overflow-hidden" x-show="sidebarOpen">
                            <p class="text-xs font-black truncate">{{ Auth::user()->name }}</p>
                            <span class="text-[10px] text-emerald-500 font-bold flex items-center">● Online</span>
                         </div>
                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT AREA -->
            <div 
                class="flex-1 flex flex-col min-h-screen min-w-0">
                
                @include('layouts.navigation')

                <!-- Page Header (Dynamic) -->
                @isset($header)
                    <header class="bg-white border-b border-gray-100 shadow-sm">
                        <div class="px-6 py-6 sm:px-10 max-w-7xl">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Main Content Slot -->
                <main class="flex-1 px-4 sm:px-10 py-10 max-w-7xl mx-auto w-full">
                    {{ $slot }}
                </main>

                <!-- Global Footer -->
                <footer class="p-10 text-center border-t border-gray-100 bg-white">
                     <p class="text-slate-400 text-[10px] font-black tracking-widest uppercase italic">
                        Enterprise CRM Management Console v2.0
                    </p>
                </footer>
            </div>
        </div>

        <!-- Notification Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Action Successful!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>
        @endif
        <script>
            function logoutConfirm(formId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Your current session will be ended.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4F46E5', // Indigo
                    cancelButtonColor: '#334155', // Slate
                    confirmButtonText: 'Yes, Sign Out!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                })
            }
        </script>
    </body>
</html>
