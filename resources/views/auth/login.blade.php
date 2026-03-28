<x-guest-layout>
    <div class="mb-10 text-center lg:text-left">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">
            {{ $isAdmin ? 'Admin Portal Access' : 'Welcome Back' }}
        </h1>
        <p class="text-slate-500 mt-4 text-sm font-medium leading-relaxed">
            {{ $isAdmin ? 'Authenticate your administrative credentials to control the system.' : 'Enter your credentials to access your account.' }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Laravel standard error box -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center space-x-3">
                <span class="text-red-600">❌</span>
                <p class="text-sm font-bold text-red-800">Please correct the following errors:</p>
            </div>
            <ul class="mt-2 text-xs font-semibold text-red-700 list-inside list-disc opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $isAdmin ? route('admin.login') : route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="text-sm font-black text-slate-800 uppercase tracking-widest">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    {{ $isAdmin ? '🗝️' : '📧' }}
                </div>
                <input id="email" 
                       class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="{{ $isAdmin ? 'admin@company.com' : 'you@company.com' }}"
                       required 
                       autofocus 
                       autocomplete="username" />
            </div>
        </div>

        <!-- Password -->
        <div class="space-y-2" x-data="{ showPassword: false }">
            <div class="flex justify-between items-center">
                <label for="password" class="text-sm font-black text-slate-800 uppercase tracking-widest">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition underline underline-offset-4" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    🔒
                </div>
                <input id="password" 
                       class="block w-full pl-11 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder-slate-400 shadow-sm"
                       :type="showPassword ? 'text' : 'password'"
                       name="password"
                       placeholder="••••••••"
                       required 
                       autocomplete="current-password" />
                
                <button type="button" 
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition outline-none">
                    <span x-show="!showPassword">👁️</span>
                    <span x-show="showPassword" x-cloak>🙈</span>
                </button>
            </div>
        </div>

        <!-- Remember Me -->
        <label for="remember_me" class="flex items-center group cursor-pointer">
            <div class="relative flex items-center justify-center h-5 w-5 bg-white border-2 border-slate-200 rounded-md group-hover:border-indigo-500 transition-all">
                <input id="remember_me" type="checkbox" name="remember" class="peer opacity-0 absolute inset-0 cursor-pointer">
                <div class="h-3.5 w-3.5 bg-indigo-600 rounded-[3px] scale-0 peer-checked:scale-100 transition-transform duration-200"></div>
            </div>
            <span class="ms-3 text-sm font-bold text-slate-600 select-none">Remember me for 30 days</span>
        </label>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 {{ $isAdmin ? 'bg-slate-950 hover:bg-slate-800' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white rounded-2xl text-sm font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/30 transition-all transform hover:-translate-y-1 active:scale-95 focus:ring-4 focus:ring-indigo-500/20 outline-none">
                {{ $isAdmin ? '🔓 Admin Secure Login' : 'Secure Sign In' }}
            </button>
        </div>

        <div class="mt-8 pt-8 border-t border-slate-100 text-center">
            <p class="text-sm font-bold text-slate-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 transition">Create your account here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
