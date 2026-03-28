<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight italic">
            {{ __('🛡️ Security Protocol Console') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 p-8 md:p-12">
                
                <div class="mb-12 border-b border-gray-100 pb-10">
                    <span class="inline-flex items-center px-4 py-1.5 bg-slate-900 text-white text-[10px] font-black uppercase rounded-full shadow-sm tracking-[0.2em] mb-4">
                        System Lockdown Control
                    </span>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Access Gatekeepers</h1>
                    <p class="text-slate-500 mt-3 text-sm leading-relaxed max-w-xl">
                        Toggle public availability of administrative entry points. Disabling these will block even valid URLs from reaching the admin auth forms.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-10">
                    @csrf
                    @method('PATCH')

                    <!-- Admin Login Toggle -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between p-8 bg-slate-50 rounded-2xl border border-slate-100 group transition-all hover:bg-white hover:shadow-xl hover:-translate-y-1">
                        <div class="space-y-1 max-w-md">
                            <h3 class="text-lg font-black text-slate-900 flex items-center">
                                🔓 Admin Portal Login
                            </h3>
                            <p class="text-xs font-bold text-slate-500 leading-relaxed uppercase tracking-wider">
                                Controls: http://www_crm.test/admin/login
                            </p>
                            <p class="text-sm text-slate-500 pt-2 italic">
                                When disabled, the admin login route will return a "Service Restricted" error.
                            </p>
                        </div>
                        
                        <div class="mt-6 md:mt-0">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="admin_login_enabled" value="1" {{ $settings['admin_login'] == '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-16 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-7 after:transition-all peer-checked:bg-slate-900"></div>
                                <span class="ms-3 text-sm font-black text-slate-900 uppercase peer-checked:text-emerald-600 transition-colors">
                                    {{ $settings['admin_login'] == '1' ? 'Active' : 'Locked' }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Admin Register Toggle -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between p-8 bg-slate-50 rounded-2xl border border-slate-100 group transition-all hover:bg-white hover:shadow-xl hover:-translate-y-1">
                        <div class="space-y-1 max-w-md">
                            <h3 class="text-lg font-black text-slate-900 flex items-center">
                                🛡️ Admin Account Creation
                            </h3>
                            <p class="text-xs font-bold text-slate-500 leading-relaxed uppercase tracking-wider">
                                Controls: http://www_crm.test/admin/register
                            </p>
                            <p class="text-sm text-slate-500 pt-2 italic">
                                Toggle ability to register new administrative accounts.
                            </p>
                        </div>
                        
                        <div class="mt-6 md:mt-0">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="admin_register_enabled" value="1" {{ $settings['admin_register'] == '1' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-16 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-7 after:transition-all peer-checked:bg-slate-900"></div>
                                <span class="ms-3 text-sm font-black text-slate-900 uppercase peer-checked:text-emerald-600 transition-colors">
                                    {{ $settings['admin_register'] == '1' ? 'Active' : 'Locked' }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-10 flex justify-end">
                        <button type="submit" class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.25em] hover:bg-slate-800 transition duration-150 shadow-2xl hover:-translate-y-1 active:scale-95">
                            💾 Commit Security Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
