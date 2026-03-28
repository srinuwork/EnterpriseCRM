<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('✏️ Update Financial Entry') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8 sm:p-12 relative">
                
                <!-- ID Badge -->
                <div class="absolute top-8 right-8 hidden sm:block">
                     <span class="bg-slate-100 text-slate-500 px-4 py-2 rounded-xl font-mono text-xs font-black border border-slate-200 shadow-sm uppercase tracking-tighter">
                        TRXN-ID: #{{ $payment->id }}
                    </span>
                </div>

                <div class="mb-10 border-b border-gray-100 pb-8 text-center sm:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest leading-none">
                        Payment Adjustment Protocol
                    </span>
                    <h1 class="text-4xl font-black text-slate-900 mt-6 tracking-tight italic">₹{{ number_format($payment->amount, 2) }}</h1>
                    <p class="text-slate-500 mt-3 text-sm font-medium leading-relaxed">Modify ledger records for the transaction between client and asset.</p>
                </div>

                <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Client (View Only) -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Payor entity</label>
                            <div class="p-4 bg-slate-50 border border-slate-100 text-slate-600 rounded-2xl text-sm font-bold truncate">
                                👤 {{ $payment->client->name }}
                            </div>
                        </div>

                        <!-- Product (View Only) -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Allocated Asset</label>
                            <div class="p-4 bg-slate-50 border border-slate-100 text-slate-600 rounded-2xl text-sm font-bold truncate">
                                🏗️ {{ $payment->product->project_name }}
                            </div>
                        </div>

                        <!-- Keep hidden for submission -->
                        <input type="hidden" name="client_id" value="{{ $payment->client_id }}">
                        <input type="hidden" name="product_id" value="{{ $payment->product_id }}">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Adjusted Amount (INR)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-emerald-600 font-black">₹</span>
                                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" required
                                    class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-black p-4 pl-10 bg-white">
                            </div>
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="payment_date" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Effective Date</label>
                            <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', $payment->payment_date) }}" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- Method -->
                        <div>
                            <label for="payment_method" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Transfer Channel</label>
                            <select name="payment_method" id="payment_method" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-slate-50/50">
                                <option value="UPI" {{ old('payment_method', $payment->payment_method) == 'UPI' ? 'selected' : '' }}>📱 UPI / QR Scan</option>
                                <option value="Bank Transfer" {{ old('payment_method', $payment->payment_method) == 'Bank Transfer' ? 'selected' : '' }}>🏛️ Bank Transfer (NEFT)</option>
                                <option value="Cash" {{ old('payment_method', $payment->payment_method) == 'Cash' ? 'selected' : '' }}>💵 Cash Settlement</option>
                                <option value="Cheque" {{ old('payment_method', $payment->payment_method) == 'Cheque' ? 'selected' : '' }}>🖋️ Cheque Payment</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Clearance Status</label>
                            <select name="status" id="status" required
                                class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-bold p-4 bg-white">
                                <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>🟢 Fully Completed</option>
                                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>⏳ Verifying / Pending</option>
                                <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>🔴 Transaction Failed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Admin Notes / Audit Trail</label>
                        <textarea name="description" id="description" rows="3" placeholder="Reference ID or update reason..."
                            class="block w-full border-slate-200 rounded-2xl shadow-sm focus:ring-emerald-600 focus:border-emerald-600 text-sm font-medium p-4 bg-slate-50/50">{{ old('description', $payment->description) }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-gray-100 mt-12">
                        <a href="{{ route('payments.index') }}" 
                           class="flex items-center text-xs font-black text-slate-400 hover:text-emerald-600 transition uppercase tracking-widest leading-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Abort Ledger Update
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-10 py-5 bg-emerald-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-emerald-700 shadow-2xl transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                            💰 Commit Financial Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
