<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('✏️ Modify System Asset') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8 sm:p-12 relative">
                
                <!-- ID Badge -->
                <div class="absolute top-8 right-8 hidden sm:block">
                     <span class="bg-slate-100 text-slate-500 px-4 py-2 rounded-xl font-mono text-xs font-black border border-slate-200 shadow-sm uppercase tracking-tighter">
                        UUID: PROD-{{ $product->id }}
                    </span>
                </div>

                <div class="mb-10 border-b border-gray-100 pb-8 text-center sm:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 bg-blue-50 text-blue-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest leading-none">
                        Project Configuration Edit
                    </span>
                    <h1 class="text-4xl font-black text-slate-900 mt-6 tracking-tight italic">{{ $product->project_name }}</h1>
                    <p class="text-slate-500 mt-3 text-sm font-medium leading-relaxed">Update technical specifications and valuation for this asset.</p>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Client Selector (Disabled for Integrity) -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Linked Client entity</label>
                        <div class="p-4 bg-slate-100 border border-slate-200 text-slate-500 rounded-2xl text-sm font-bold flex items-center">
                            <span class="mr-2">👤</span> {{ $product->client->name }} <span class="ml-auto text-[10px] font-black opacity-50 uppercase italic tracking-tighter">(Permanent Record)</span>
                        </div>
                        <input type="hidden" name="client_id" value="{{ $product->client_id }}">
                    </div>

                    <!-- Project Name -->
                    <div>
                        <label for="project_name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Asset Title (Editable)</label>
                        <input type="text" name="project_name" id="project_name" value="{{ old('project_name', $product->project_name) }}" required
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-black p-4 bg-slate-50/50">
                        @error('project_name') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Classification</label>
                            <select name="project_type" id="project_type" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-bold p-4 bg-white">
                                <option value="software" {{ old('project_type', $product->project_type) == 'software' ? 'selected' : '' }}>💻 Software Solution</option>
                                <option value="service" {{ old('project_type', $product->project_type) == 'service' ? 'selected' : '' }}>🛠️ Managed Service</option>
                                <option value="hardware" {{ old('project_type', $product->project_type) == 'hardware' ? 'selected' : '' }}>📼 Hardware Asset</option>
                                <option value="consulting" {{ old('project_type', $product->project_type) == 'consulting' ? 'selected' : '' }}>🤝 Strategic Consulting</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="project_status" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Current Status</label>
                            <select name="project_status" id="project_status" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-bold p-4 bg-white">
                                <option value="active" {{ old('project_status', $product->project_status) == 'active' ? 'selected' : '' }}>🟢 System Active</option>
                                <option value="inactive" {{ old('project_status', $product->project_status) == 'inactive' ? 'selected' : '' }}>🔴 System Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Current Valuation (INR)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400 font-black">₹</span>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required
                                    class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-black p-4 pl-8 bg-white">
                            </div>
                        </div>

                         <!-- Initial Price (Informational) -->
                         <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Launch Price (History)</label>
                            <div class="p-4 bg-gray-50 border border-gray-100 text-gray-400 rounded-2xl text-sm font-bold italic">
                                ₹{{ number_format($product->initial_price, 2) }}
                            </div>
                            <input type="hidden" name="initial_price" value="{{ $product->initial_price }}">
                        </div>
                    </div>

                    <!-- Dates -->
                     <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <label for="start_date" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $product->start_date) }}" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-bold p-4 bg-white">
                        </div>
                        <div>
                            <label for="end_date" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $product->end_date) }}" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-bold p-4 bg-white">
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Technical Documentation Updates</label>
                        <textarea name="description" id="description" rows="4" placeholder="Briefly define project scope and deliverables..."
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-blue-600 focus:border-blue-600 text-sm font-medium p-4 bg-slate-50/50">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-gray-100 mt-12">
                        <a href="{{ route('products.index') }}" 
                           class="flex items-center text-xs font-black text-slate-400 hover:text-blue-600 transition uppercase tracking-widest">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Cancel Modification
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-blue-700 shadow-2xl transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                            💾 Save Project Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
