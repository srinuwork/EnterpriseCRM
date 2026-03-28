<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('💸 Financial Entry Terminal') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8 sm:p-12">
                
                <div class="mb-10 border-b border-gray-100 pb-8 text-center sm:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest">
                        New Revenue Transaction
                    </span>
                    <h1 class="text-4xl font-black text-slate-900 mt-6 tracking-tight italic">Record Deposit Flow</h1>
                    <p class="text-slate-500 mt-3 text-sm font-medium leading-relaxed">Officially log a payment receipt against a client project in the system ledger.</p>
                </div>

                <form action="{{ route('payments.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Client Selector -->
                        <div>
                            <label for="client_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Payor Entity (Client)</label>
                            <select name="client_id" id="client_id" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-slate-50/50">
                                <option value="">-- Choose Payer --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        👤 {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                        </div>

                        <!-- Product Selector -->
                        <div>
                            <label for="product_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Settlement Asset (Project)</label>
                            <select name="product_id" id="product_id" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-white">
                                <option value="">-- Choose Project --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        🏗️ {{ $product->project_name }} (₹{{ number_format($product->price, 0) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Transaction Amount (INR)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-emerald-600 font-black">₹</span>
                                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" placeholder="0.00" required
                                    class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-black p-4 pl-8 bg-white overflow-hidden">
                            </div>
                            @error('amount') <p class="mt-2 text-xs text-red-600 font-bold tracking-tight">⚠️ {{ $message }}</p> @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="payment_date" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Settlement Date</label>
                            <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Method -->
                        <div>
                            <label for="payment_method" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Transfer Channel</label>
                            <select name="payment_method" id="payment_method" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-slate-50/50">
                                <option value="UPI" {{ old('payment_method') == 'UPI' ? 'selected' : '' }}>📱 UPI / QR Scan</option>
                                <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>🏛️ Bank Transfer (NEFT)</option>
                                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>💵 Cash Settlement</option>
                                <option value="Cheque" {{ old('payment_method') == 'Cheque' ? 'selected' : '' }}>🖋️ Cheque Payment</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Clearance Status</label>
                            <select name="status" id="status" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-white">
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>🟢 Fully Completed</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Verifying / Pending</option>
                                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>🔴 Transaction Failed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Transaction Metadata / Reference ID</label>
                        <textarea name="description" id="description" rows="3" placeholder="e.g. UPI ID, Bank Ref No, or specific milestone payment details..."
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-medium p-4 bg-slate-50/50">{{ old('description') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-gray-100 mt-12">
                        <a href="{{ route('payments.index') }}" 
                           class="flex items-center text-xs font-black text-slate-400 hover:text-emerald-600 transition uppercase tracking-widest ring-0 outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Discard Ledger Entry
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-10 py-5 bg-emerald-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-emerald-700 shadow-2xl transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                            💰 Complete Financial Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
