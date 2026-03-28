<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('💳 Payment Ledger & Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="mb-10 border-b border-gray-100 pb-8 flex flex-col md:flex-row md:items-center justify-between text-center md:text-left gap-6">
                    <div>
                        <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-black uppercase rounded-full shadow-sm tracking-widest leading-none">
                            🧾 Financial Audit
                        </span>
                        <h1 class="text-3xl font-black text-slate-900 mt-4 tracking-tight">Transaction History Console</h1>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Monitor revenue flow and payment verification statuses.</p>
                    </div>
                    <div>
                        <a href="{{ route('payments.create') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 border border-transparent rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-emerald-700 transition duration-150 shadow-2xl shadow-emerald-500/30 hover:-translate-y-1 active:scale-95 whitespace-nowrap">
                            💰 New Revenue Transaction
                        </a>
                    </div>
                </div>

                @if($payments->count() > 0)
                    <!-- MOBILE VIEW: Cards -->
                    <div class="block lg:hidden space-y-4">
                        @foreach($payments as $payment)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm border-t-4 {{ $payment->status === 'completed' ? 'border-t-emerald-500' : 'border-t-red-500' }}">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Transaction</span>
                                        <span class="font-mono text-xs font-black text-slate-600">TRXN-{{ $payment->id }}</span>
                                    </div>
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full border shadow-sm {{ $payment->status === 'completed' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200' }}">
                                        {{ $payment->status }}
                                    </span>
                                </div>
                                <div class="flex flex-col mb-4">
                                     <h3 class="font-black text-slate-900 text-lg leading-tight">{{ $payment->client->name ?? 'Unknown' }}</h3>
                                     <span class="text-[10px] font-bold text-slate-400 truncate">{{ $payment->product->project_name ?? 'General' }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 py-4 border-y border-gray-50 mb-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black uppercase text-slate-300">Amount</span>
                                        <span class="font-black text-slate-900 italic">₹{{ number_format($payment->amount, 2) }}</span>
                                    </div>
                                    <div class="flex flex-col text-right">
                                        <span class="text-[10px] font-black uppercase text-slate-300">Date</span>
                                        <span class="font-bold text-slate-700 text-xs">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('payments.show', $payment->id) }}" class="flex-1 text-center py-2.5 bg-slate-800 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-colors">👁️ Receipt</a>
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="p-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-blue-600 hover:text-white transition-colors border border-slate-200">✏️</a>
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
                                    <th scope="col" class="px-6 py-4 text-left uppercase">Client & System</th>
                                    <th scope="col" class="px-6 py-4 text-center uppercase">Amount (₹)</th>
                                    <th scope="col" class="px-6 py-4 text-center uppercase">Status</th>
                                    <th scope="col" class="px-6 py-4 text-center uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($payments as $payment)
                                    <tr class="hover:bg-emerald-50/30 transition-colors duration-200 group border-b border-gray-50 last:border-0">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md font-mono text-[10px] font-black border border-gray-200">TRXN-{{ $payment->id }}</span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <div class="font-black text-slate-900 text-sm tracking-tight">{{ $payment->client->name ?? 'Unknown' }}</div>
                                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $payment->product->project_name ?? 'General' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center text-slate-900 font-black italic">₹{{ number_format($payment->amount, 2) }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full border shadow-sm {{ $payment->status === 'completed' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200' }}">{{ $payment->status }}</span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('payments.show', $payment->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-emerald-600 hover:text-white transition duration-200 shadow-sm">👁️</a>
                                                <a href="{{ route('payments.edit', $payment->id) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200 shadow-sm">✏️</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="text-6xl mb-4 text-slate-200">💸</div>
                        <h3 class="text-xl font-bold text-slate-900">Zero transactions detected</h3>
                        <p class="text-slate-500 mt-2 max-w-xs mx-auto text-sm italic">You haven't recorded any revenue yet. Let's change that.</p>
                        <a href="{{ route('payments.create') }}" class="mt-8 inline-flex items-center px-8 py-3 bg-emerald-600 text-white font-black uppercase tracking-widest text-xs rounded-xl hover:bg-emerald-700 shadow-xl transition transform hover:-translate-y-1">
                            💰 Deposit Payment
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
