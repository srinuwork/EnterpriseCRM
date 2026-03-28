<x-guest-layout>
    <div class="mb-10 text-center lg:text-left">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">
            {{ $isAdmin ? 'Admin Console Registration' : 'Create Your Account' }}
        </h1>
        <p class="text-slate-500 mt-4 text-sm font-medium leading-relaxed">
            {{ $isAdmin ? 'Initialize a new administrative account with full system privileges.' : 'Join us today and start managing your clients more efficiently.' }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Laravel standard error box -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center space-x-3">
                <span class="text-red-600">❌</span>
                <p class="text-sm font-bold text-red-800">Registration Failed:</p>
            </div>
            <ul class="mt-2 text-xs font-semibold text-red-700 list-inside list-disc opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $isAdmin ? route('admin.register') : route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <label for="name" class="text-sm font-black text-slate-800 uppercase tracking-widest">Full Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    {{ $isAdmin ? '🛡️' : '👤' }}
                </div>
                <input id="name" 
                       class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="{{ $isAdmin ? 'Admin Full Name' : 'e.g. John Doe' }}"
                       required 
                       autofocus 
                       autocomplete="name" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="text-sm font-black text-slate-800 uppercase tracking-widest">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    📧
                </div>
                <input id="email" 
                       class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="you@work.com"
                       required 
                       autocomplete="username" />
            </div>
        </div>

        <!-- Password Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="text-sm font-black text-slate-800 uppercase tracking-widest">Password</label>
                <input id="password" 
                       class="block w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       type="password"
                       name="password"
                       placeholder="Min. 8 characters"
                       required 
                       autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="text-sm font-black text-slate-800 uppercase tracking-widest">Confirm</label>
                <input id="password_confirmation" 
                       class="block w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       type="password"
                       name="password_confirmation" 
                       placeholder="Match password"
                       required 
                       autocomplete="new-password" />
            </div>
        </div>

        <!-- Terms & Privacy -->
        <div class="pt-2">
            <label class="flex items-start group cursor-pointer">
                <div class="mt-0.5 relative flex items-center justify-center h-5 w-5 bg-white border-2 border-slate-200 rounded-md group-hover:border-emerald-500 transition-all shrink-0">
                    <input type="checkbox" required name="terms" class="peer opacity-0 absolute inset-0 cursor-pointer">
                    <div class="h-3.5 w-3.5 bg-emerald-600 rounded-[3px] scale-0 peer-checked:scale-100 transition-transform duration-200"></div>
                </div>
                <span class="ms-3 text-xs font-bold text-slate-500 leading-relaxed">
                    By registering, you agree to our <a href="#" class="text-emerald-600 hover:text-emerald-700 transition underline underline-offset-4">Terms & Conditions</a> and <a href="#" class="text-emerald-600 hover:text-emerald-700 transition underline underline-offset-4">Privacy Policy</a>.
                </span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-4 {{ $isAdmin ? 'bg-slate-900' : 'bg-emerald-600' }} text-white rounded-2xl text-sm font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/30 transition-all transform hover:-translate-y-1 active:scale-95 focus:ring-4 focus:ring-indigo-500/20 outline-none">
                {{ $isAdmin ? 'Authorize Root Admin' : 'Initialize Account' }}
            </button>
        </div>

        <div class="mt-8 pt-8 border-t border-slate-100 text-center">
            <p class="text-sm font-bold text-slate-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 transition">Sign in here instead</a>
            </p>
        </div>
    </form>
</x-guest-layout>
