<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('📦 Project & Product Directory') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="mb-10 border-b border-gray-100 pb-8 flex flex-col md:flex-row md:items-center justify-between text-center md:text-left gap-6">
                    <div>
                        <span class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest leading-none">
                            🏗️ Project Explorer
                        </span>
                        <h1 class="text-3xl font-black text-slate-900 mt-4 tracking-tight">System Projects & Assets</h1>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Manage ongoing developments and product allocations.</p>
                    </div>
                    <div>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-indigo-700 transition duration-150 shadow-2xl shadow-indigo-500/30 hover:-translate-y-1 active:scale-95 whitespace-nowrap">
                            🚀 Launch New Project
                        </a>
                    </div>
                </div>

                @if($products->count() > 0)
                    <!-- MOBILE VIEW: Cards -->
                    <div class="block lg:hidden space-y-4">
                        @foreach($products as $product)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-50">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black uppercase text-indigo-600 tracking-widest">{{ $product->project_type ?? 'N/A' }}</span>
                                        <h3 class="font-black text-slate-900 text-lg leading-tight mt-1">{{ $product->project_name }}</h3>
                                    </div>
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full border shadow-sm {{ $product->project_status === 'completed' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-amber-100 text-amber-700 border-amber-200' }}">
                                        {{ $product->project_status ?? 'Pending' }}
                                    </span>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-lg">
                                        <span class="text-[10px] font-black text-slate-400 uppercase">Valuation</span>
                                        <span class="font-black text-slate-900 tracking-tighter italic">₹{{ number_format($product->price ?? 0, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center px-1">
                                         <span class="text-[10px] font-black text-slate-400 uppercase">Client Affinity</span>
                                         <div class="flex items-center">
                                            <div class="h-6 w-6 bg-slate-200 rounded-md flex items-center justify-center text-[10px] font-bold text-slate-600 mr-2 uppercase">{{ strtoupper(substr($product->client->name ?? '?', 0, 1)) }}</div>
                                            <span class="text-xs font-bold text-slate-600 truncate max-w-[120px]">{{ $product->client->name ?? 'Unknown' }}</span>
                                         </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="flex-1 text-center py-2.5 bg-slate-800 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-colors">👁️ Details</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="p-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-blue-600 hover:text-white transition-colors border border-slate-200">✏️</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- DESKTOP VIEW: Table -->
                    <div class="hidden lg:block overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-slate-800 text-white font-bold text-[10px] tracking-[0.2em]">
                                    <th scope="col" class="px-6 py-4 text-left uppercase">ID</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Project Name</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Client Name</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase text-center">Price (₹)</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase text-center">Status</th>
                                    <th scope="col" class="px-6 py-4 text-left uppercase text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($products as $product)
                                    <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group border-b border-gray-50 last:border-0">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md font-mono text-sm font-bold border border-gray-200">#{{ $product->id }}</span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap"><div class="font-black text-slate-800 tracking-tight">{{ $product->project_name }}</div></td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center font-bold text-xs border border-slate-200">{{ strtoupper(substr($product->client->name ?? '?', 0, 1)) }}</div>
                                                <div class="ml-3 font-bold text-slate-600 text-sm">{{ $product->client->name ?? 'Deleted' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center text-slate-700 font-black italic">₹{{ number_format($product->price ?? 0, 2) }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full border shadow-sm {{ $product->project_status === 'completed' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-amber-100 text-amber-700 border-amber-200' }}">{{ $product->project_status }}</span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('products.show', $product->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200">👁️</a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">✏️</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="text-6xl mb-4 text-slate-200">📦</div>
                        <h3 class="text-xl font-bold text-slate-900 leading-tight">No projects found in orbit</h3>
                        <p class="text-slate-500 mt-2 max-w-xs mx-auto text-sm">Ready to scale? Add your first product or project to begin tracking metrics.</p>
                        <a href="{{ route('products.create') }}" class="mt-8 inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-black uppercase tracking-widest text-xs rounded-xl hover:bg-indigo-700 shadow-xl transition transform hover:-translate-y-1">
                            🚀 Launch New Project
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
