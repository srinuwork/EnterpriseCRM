<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('🚀 Project Launchpad') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8 sm:p-12">
                
                <div class="mb-10 border-b border-gray-100 pb-8 text-center sm:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest">
                        New Project Registration
                    </span>
                    <h1 class="text-4xl font-black text-slate-900 mt-6 tracking-tight italic">Initialize System Asset</h1>
                    <p class="text-slate-500 mt-3 text-sm font-medium leading-relaxed">Assign a new project or product to an existing client in the CRM system.</p>
                </div>

                <form action="{{ route('products.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Client Selector -->
                    <div>
                        <label for="client_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Target Client Record</label>
                        <select name="client_id" id="client_id" required
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-indigo-600 focus:border-indigo-600 text-sm font-bold p-4 bg-slate-50/50">
                            <option value="">-- Choose Authorized Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    👤 {{ $client->name }} (ID: #{{ $client->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('client_id') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                    </div>

                    <!-- Project Name -->
                    <div>
                        <label for="project_name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Project Title / Asset Name</label>
                        <input type="text" name="project_name" id="project_name" value="{{ old('project_name') }}" placeholder="e.g. Enterprise CRM Pro v3" required
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-indigo-600 focus:border-indigo-600 text-sm font-bold p-4 bg-slate-50/50">
                        @error('project_name') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Asset Classification</label>
                            <select name="project_type" id="project_type" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-indigo-600 focus:border-indigo-600 text-sm font-bold p-4 bg-white">
                                <option value="software" {{ old('project_type') == 'software' ? 'selected' : '' }}>💻 Software Solution</option>
                                <option value="service" {{ old('project_type') == 'service' ? 'selected' : '' }}>🛠️ Managed Service</option>
                                <option value="hardware" {{ old('project_type') == 'hardware' ? 'selected' : '' }}>📼 Hardware Asset</option>
                                <option value="consulting" {{ old('project_type') == 'consulting' ? 'selected' : '' }}>🤝 Strategic Consulting</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Valuation (INR)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400 font-black">₹</span>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" placeholder="0.00" required
                                    class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-indigo-600 focus:border-indigo-600 text-sm font-black p-4 pl-8 bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Technical Specifications / Notes</label>
                        <textarea name="description" id="description" rows="4" placeholder="Briefly define project scope and deliverables..."
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-indigo-600 focus:border-indigo-600 text-sm font-medium p-4 bg-slate-50/50">{{ old('description') }}</textarea>
                    </div>

                    <!-- Project Status Hidden for New Projects (Default: active) -->
                    <input type="hidden" name="project_status" value="active">

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-gray-100 mt-12">
                        <a href="{{ route('products.index') }}" 
                           class="flex items-center text-xs font-black text-slate-400 hover:text-indigo-600 transition uppercase tracking-widest ring-0 outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Abort Initialization
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-indigo-700 shadow-2xl transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                            🚀 Confirm & Launch Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
