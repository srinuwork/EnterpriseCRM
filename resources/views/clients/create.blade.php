<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    
                    <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Client Header -->
                        <div class="border-b pb-4 mb-4">
                            <h3 class="text-lg font-medium text-gray-900">👥 New Client Information</h3>
                            <p class="mt-1 text-sm text-gray-600">Please provide the details below to register a new client.</p>
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter client's full name" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter client's email address" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter client's phone number"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                         <!-- Address -->
                         <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address (Optional)</label>
                            <textarea name="address" id="address" rows="3" placeholder="Enter client's physical address"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 font-bold">Client Status</label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>🟢 Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>🔴 Inactive</option>
                            </select>
                        </div>

                        <div style="display:flex; align-items:center; justify-content:space-between; margin-top:2.5rem; padding-top:1.5rem; border-top:1px solid #E5E7EB;">
                            <a href="{{ route('clients.index') }}" 
                               style="display:inline-flex; align-items:center; font-size:0.875rem; color:#6B7280; text-decoration:none; font-weight:500;"
                               onmouseover="this.style.color='#374151'" onmouseout="this.style.color='#6B7280'">
                                <svg style="width:1rem;height:1rem;margin-right:0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Client Directory
                            </a>
                            <button type="submit"
                                style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.75rem 2rem; background:linear-gradient(135deg, #2563EB, #4F46E5); color:#ffffff; font-size:0.875rem; font-weight:700; border:none; border-radius:0.75rem; cursor:pointer; box-shadow:0 4px 15px rgba(79,70,229,0.4); letter-spacing:0.05em; text-transform:uppercase; transition:all 0.2s ease;"
                                onmouseover="this.style.boxShadow='0 8px 25px rgba(79,70,229,0.5)'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.boxShadow='0 4px 15px rgba(79,70,229,0.4)'; this.style.transform='translateY(0)'">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create Client Now
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
