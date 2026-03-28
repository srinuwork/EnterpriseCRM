<x-app-layout>
    <!-- Page Header (consistent style) -->
    <x-slot name="header">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('👁️ Client Profile Details') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('clients.edit', $client->id) }}" 
                    class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-md transition duration-200 uppercase tracking-widest text-xs">
                    ✏️ Edit User
                </a>
                <a href="{{ route('clients.index') }}" 
                    class="inline-flex items-center px-6 py-2.5 bg-slate-600 text-white font-bold rounded-lg hover:bg-slate-700 shadow-md transition duration-200 uppercase tracking-widest text-xs">
                    ← Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-10">
                
                <!-- Badge and Name -->
                <div class="text-center sm:text-left mb-10 border-b border-gray-100 pb-8">
                    <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase rounded-full shadow-sm">
                        👁️ User Details
                    </span>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-4 leading-tight">{{ $client->name }}</h1>
                </div>

                <!-- Info Grid -->
                <div class="space-y-6">
                    <!-- Client ID Group -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 p-6 bg-slate-50 border border-gray-100 rounded-xl hover:bg-slate-100 transition duration-150">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest self-center">Client ID</div>
                        <div class="text-lg font-mono text-slate-800 font-bold sm:text-right mt-1 sm:mt-0">#{{ $client->id }}</div>
                    </div>

                    <!-- Full Name Group -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 p-6 bg-white border border-gray-100 rounded-xl hover:bg-slate-50 transition duration-150 shadow-sm">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest self-center">Full Name</div>
                        <div class="text-lg font-bold text-slate-900 sm:text-right mt-1 sm:mt-0">{{ $client->name }}</div>
                    </div>

                    <!-- Email Address Group -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 p-6 bg-white border border-gray-100 rounded-xl hover:bg-slate-50 transition duration-150 shadow-sm">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest self-center">Email Address</div>
                        <div class="text-lg font-bold text-slate-900 sm:text-right mt-1 sm:mt-0">{{ $client->email ?? '—' }}</div>
                    </div>

                    <!-- Phone Number Group -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 p-6 bg-white border border-gray-100 rounded-xl hover:bg-slate-50 transition duration-150 shadow-sm">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest self-center">Phone Number</div>
                        <div class="text-lg font-bold text-slate-900 sm:text-right mt-1 sm:mt-0 font-mono tracking-tighter">{{ $client->phone ?? '—' }}</div>
                    </div>

                    <!-- Status Group (Optional Enhancement) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 p-6 bg-white border border-gray-100 rounded-xl hover:bg-slate-50 transition duration-150 shadow-sm">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest self-center">Account Status</div>
                        <div class="sm:text-right mt-1 sm:mt-0 uppercase tracking-wider font-extrabold text-sm">
                            @if($client->status === 'active')
                                <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full border border-green-200">🟢 Active</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-4 py-1.5 rounded-full border border-red-200">🔴 Inactive</span>
                            @endif
                        </div>
                    </div>

                    <!-- Address Group -->
                    <div class="grid grid-cols-1 p-6 bg-white border border-gray-100 rounded-xl hover:bg-slate-50 transition duration-150 shadow-sm">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Full Residential Address</div>
                        <div class="text-lg font-medium text-slate-700 leading-relaxed">{{ $client->address ?? 'No address registered.' }}</div>
                    </div>
                </div>

                <!-- Navigation Footer -->
                <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="flex space-x-3 w-full sm:w-auto">
                        @if($previous)
                            <a href="{{ route('clients.show', $previous->id) }}" 
                                class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-slate-600 text-white font-bold rounded-lg hover:bg-slate-700 shadow-md transition duration-200 text-sm">
                                « Previous
                            </a>
                        @else
                            <span class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-slate-200 text-slate-400 rounded-lg cursor-not-allowed opacity-50 text-sm font-bold">
                                « Previous
                            </span>
                        @endif

                        @if($next)
                            <a href="{{ route('clients.show', $next->id) }}" 
                                class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-slate-600 text-white font-bold rounded-lg hover:bg-slate-700 shadow-md transition duration-200 text-sm">
                                Next »
                            </a>
                        @else
                            <span class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-slate-200 text-slate-400 rounded-lg cursor-not-allowed opacity-50 text-sm font-bold">
                                Next »
                            </span>
                        @endif
                    </div>
                    
                    <p class="text-slate-400 text-xs font-bold tracking-widest uppercase italic">
                        Secured Client Data Portfolio
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
