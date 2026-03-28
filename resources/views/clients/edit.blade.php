<x-app-layout>
    <!-- Page Header (consistent style) -->
    <x-slot name="header">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('✏️ Edit Client Profile') }}
            </h2>
            <a href="{{ route('clients.index') }}" 
                class="inline-flex items-center px-6 py-2.5 bg-slate-600 text-white font-bold rounded-lg hover:bg-slate-700 shadow-md transition duration-200 uppercase tracking-widest text-xs">
                ← Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-100">
                
                <!-- Form Header -->
                <div class="p-8 border-b border-gray-50 flex items-center space-x-4 bg-slate-50">
                    <div class="h-14 w-14 bg-indigo-600 text-white rounded-xl flex items-center justify-center font-black text-2xl shadow-lg">
                        {{ strtoupper(substr($client->name, 0, 1)) }}
                    </div>
                    <div>
                        <span class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em]">Now Editing Record</span>
                        <h1 class="text-2xl font-black text-slate-900 leading-none mt-1">{{ $client->name }}</h1>
                    </div>
                </div>

                <div class="p-8 sm:p-12">
                    <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Full Name Info Group -->
                        <div class="group">
                            <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Full Name</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">👤</span>
                                <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" required
                                    class="bg-gray-50 border-gray-200 text-slate-900 pl-11 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-xl py-4 font-bold transition duration-200">
                            </div>
                            @error('name') <p class="mt-2 text-xs text-red-600 font-bold px-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email Info Group -->
                        <div class="group">
                            <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Email Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">📧</span>
                                <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                                    class="bg-gray-50 border-gray-200 text-slate-900 pl-11 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-xl py-4 font-bold transition duration-200">
                            </div>
                            @error('email') <p class="mt-2 text-xs text-red-600 font-bold px-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Phone Info Group -->
                        <div class="group">
                            <label for="phone" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Phone Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">📞</span>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}"
                                    class="bg-gray-50 border-gray-200 text-slate-900 pl-11 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-xl py-4 font-bold transition duration-200">
                            </div>
                            @error('phone') <p class="mt-2 text-xs text-red-600 font-bold px-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Status Dropdown Group -->
                            <div>
                                <label for="status" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-gray-500">Account Status</label>
                                <select name="status" id="status" required
                                    class="bg-gray-50 border-gray-200 text-slate-900 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-xl py-4 font-bold transition duration-200">
                                    <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>🟢 Active</option>
                                    <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>🔴 Inactive</option>
                                </select>
                            </div>

                            <!-- Client ID (Read Only Visual) -->
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-gray-500">Record Pointer</label>
                                <div class="bg-slate-100 border border-slate-200 py-4 px-6 rounded-xl font-mono text-slate-500 font-bold text-center">
                                    USR-00{{ $client->id }}
                                </div>
                            </div>
                        </div>

                        <!-- Address Info Group -->
                        <div class="group">
                            <label for="address" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 px-1">Full Residential Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="bg-gray-50 border-gray-200 text-slate-900 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-xl py-4 font-bold transition duration-200 shadow-inner p-4">{{ old('address', $client->address) }}</textarea>
                            @error('address') <p class="mt-2 text-xs text-red-600 font-bold px-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="pt-10 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 border-t border-gray-100">
                            <button type="submit" 
                                style="background: linear-gradient(135deg, #059669, #10B981);"
                                class="flex-1 inline-flex justify-center items-center px-10 py-4 text-white font-black uppercase tracking-[0.2em] rounded-xl hover:opacity-90 shadow-xl transition-all duration-300 hover:-translate-y-1 transform">
                                ✅ Save Updated Profile
                            </button>
                            <a href="{{ route('clients.index') }}" 
                                class="flex-1 inline-flex justify-center items-center px-10 py-4 bg-slate-100 text-slate-600 font-black uppercase tracking-[0.2em] rounded-xl hover:bg-slate-200 transition-all duration-300">
                                Cancel Edit
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>