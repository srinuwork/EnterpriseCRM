<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('👥 Client Management System') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="mb-10 border-b border-gray-100 pb-8 flex flex-col md:flex-row md:items-center justify-between text-center md:text-left gap-6">
                    <div>
                        <span class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest leading-none">
                            📁 Directory Explorer
                        </span>
                        <h1 class="text-3xl font-black text-slate-900 mt-4 tracking-tight">Client User Directory</h1>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Browse and manage all registered clients securely.</p>
                    </div>
                    <div>
                        <a href="{{ route('clients.create') }}" class="w-full md:w-auto inline-flex justify-center items-center px-8 py-4 bg-blue-600 border border-transparent rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-blue-700 transition duration-150 shadow-2xl shadow-blue-500/30 hover:-translate-y-1 active:scale-95 whitespace-nowrap">
                            ➕ Register New Client
                        </a>
                    </div>
                </div>

                @if($clients->count                    <!-- MOBILE VIEW: Cards -->
                    <div class="block lg:hidden space-y-4">
                        @foreach($clients as $client)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-10 w-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold text-lg">
                                            {{ strtoupper(substr($client->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h3 class="font-black text-slate-900 leading-none">{{ $client->name }}</h3>
                                            <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">ID #{{ $client->id }}</span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('clients.edit', $client->id) }}" class="p-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors border border-slate-100">✏️</a>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-3 py-4 border-y border-gray-50">
                                    <div class="flex items-center text-sm text-slate-500 font-medium overflow-hidden">
                                        <span class="w-16 text-[10px] font-black uppercase text-slate-300">Email</span>
                                        <span class="truncate">{{ $client->email ?? '—' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-slate-500 font-medium">
                                        <span class="w-16 text-[10px] font-black uppercase text-slate-300">Phone</span>
                                        <span>{{ $client->phone ?? '—' }}</span>
                                    </div>
                                </div>
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('clients.show', $client->id) }}" class="flex-1 text-center py-2.5 bg-slate-100 text-slate-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-colors">👁️ View Profile</a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="shrink-0" onsubmit="return confirm('⚠️ Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-colors border border-red-100">🗑️</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- DESKTOP VIEW: Table -->
                    <div class="hidden lg:block overflow-x-auto rounded-xl border border-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-slate-800 text-white font-bold text-[10px] tracking-[0.2em]">
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Client ID</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Full Name</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Email Address</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($clients as $client)
                                    <tr class="hover:bg-slate-50 transition-colors duration-200 group">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md font-mono text-sm font-bold border border-gray-200">#{{ $client->id }}</span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg">{{ strtoupper(substr($client->name, 0, 1)) }}</div>
                                                <div class="ml-4 font-bold text-slate-900">{{ $client->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-gray-600 font-medium">{{ $client->email ?? '—' }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-3 opacity-80 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('clients.show', $client->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200">👁️ View</a>
                                                <a href="{{ route('clients.edit', $client->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">✏️ Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>le>
                    </div>
                @else
                    <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="text-6xl mb-4">📭</div>
                        <h3 class="text-xl font-bold text-gray-900">No users found</h3>
                        <p class="text-gray-500 mt-2">Start your journey by adding your very first client.</p>
                        <a href="{{ route('clients.create') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-lg">
                            ➕ Add New User Now
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
