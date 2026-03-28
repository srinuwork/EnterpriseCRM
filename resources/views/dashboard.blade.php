<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center max-w-7xl mx-auto space-y-4 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('🏠 CRM Command Center') }}
            </h2>
            <div class="flex space-x-3">
                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase rounded-full shadow-sm">
                    System Online
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Header Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-6 sm:p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between text-center md:text-left">
                    <div>
                        <span class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em]">Authorized Access Dashboard</span>
                        <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-2 leading-tight">
                            Welcome, {{ auth()->user()->name }}
                        </h1>
                        <div class="mt-4 flex justify-center md:justify-start">
                            @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                                <span class="px-4 py-1.5 bg-green-100 text-green-700 text-xs sm:text-sm font-black rounded-full border border-green-200">🛡️ SYSTEM ADMINISTRATOR</span>
                            @else
                                <span class="px-4 py-1.5 bg-blue-100 text-blue-700 text-xs sm:text-sm font-black rounded-full border border-blue-200">👤 STAFF MEMBER</span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-8 md:mt-0 flex flex-col items-center md:items-end border-t md:border-t-0 pt-6 md:pt-0">
                        <p class="text-slate-400 text-[10px] sm:text-xs font-bold tracking-widest uppercase italic">Market Revenue Overview</p>
                        <p class="text-2xl sm:text-3xl font-black text-slate-800 mt-1">₹{{ number_format($stats['total_revenue'] ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats & Navigation Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- Clients Stats Card -->
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-blue-50 text-blue-600 rounded-xl sm:rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6 sm:w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-2xl sm:text-4xl font-black text-slate-200 group-hover:text-blue-100 transition-colors uppercase">CLNT</span>
                        </div>
                        <h3 class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Total Registered Clients</h3>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 mt-1 sm:mt-2">{{ $stats['clients_count'] ?? 0 }}</p>
                        
                        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-50 flex space-x-2 sm:space-x-3">
                            <a href="{{ route('clients.index') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-slate-800 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-slate-900 transition shadow-md">
                                👁️ View
                            </a>
                            <a href="{{ route('clients.create') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-blue-600 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-blue-700 transition shadow-md">
                                ➕ Create
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Products Stats Card -->
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-indigo-50 text-indigo-600 rounded-xl sm:rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6 sm:w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span class="text-2xl sm:text-4xl font-black text-slate-200 group-hover:text-indigo-100 transition-colors uppercase">PROD</span>
                        </div>
                        <h3 class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Active System Projects</h3>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 mt-1 sm:mt-2">{{ $stats['products_count'] ?? 0 }}</p>
                        
                        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-50 flex space-x-2 sm:space-x-3">
                            <a href="{{ route('products.index') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-slate-800 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-slate-900 transition shadow-md">
                                👁️ View
                            </a>
                            <a href="{{ route('products.create') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-indigo-600 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-indigo-700 transition shadow-md">
                                ➕ NewProduct
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Payments Stats Card -->
                @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 sm:col-span-2 lg:col-span-1">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="p-3 sm:p-4 bg-emerald-50 text-emerald-600 rounded-xl sm:rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6 sm:w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-2xl sm:text-4xl font-black text-slate-200 group-hover:text-emerald-100 transition-colors uppercase">CASH</span>
                        </div>
                        <h3 class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Completed Transactions</h3>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 mt-1 sm:mt-2">{{ $stats['payments_count'] ?? 0 }}</p>
                        
                        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-50 flex space-x-2 sm:space-x-3">
                            <a href="{{ route('payments.index') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-slate-800 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-slate-900 transition shadow-md">
                                👁️ History
                            </a>
                            <a href="{{ route('payments.create') }}" class="flex-1 text-center py-2.5 sm:py-3 bg-emerald-600 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-emerald-700 transition shadow-md">
                                💸 NewPayment
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Bottom Navigation / Quick Actions Footer -->
            <div class="mt-12 pt-8 border-t border-gray-200 flex justify-center text-center px-4">
                 <p class="text-slate-400 text-[10px] sm:text-xs font-bold tracking-widest uppercase italic leading-relaxed">
                    Enterprise Management Console — Secured Environment
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
