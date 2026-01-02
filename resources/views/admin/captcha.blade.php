@extends('layouts.admin')

@section('content')
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Pengaturan Captcha</h1>
                <p class="text-gray-400">Amankan website dari bot dengan Google ReCaptcha atau Cloudflare Turnstile.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-800 text-gray-300 rounded-lg hover:bg-slate-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="max-w-4xl">
        @csrf
        
        <!-- Pilihan Layanan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Nonaktif -->
            <label class="cursor-pointer relative group">
                <input type="radio" name="captcha_provider" value="none" class="peer sr-only" {{ ($settings['captcha_provider'] ?? 'none') == 'none' ? 'checked' : '' }}>
                <div class="absolute inset-0 bg-slate-800/80 rounded-2xl border-2 border-slate-700 transition-all duration-300 peer-checked:border-gray-500 peer-checked:bg-slate-700 group-hover:border-slate-500"></div>
                <div class="relative p-6 flex flex-col items-center justify-center text-center h-full">
                    <div class="w-12 h-12 rounded-full bg-slate-600/50 flex items-center justify-center mb-4 text-gray-400 peer-checked:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                    </div>
                    <div class="font-bold text-gray-300 peer-checked:text-white">Nonaktif</div>
                </div>
            </label>

            <!-- ReCaptcha -->
            <label class="cursor-pointer relative group">
                <input type="radio" name="captcha_provider" value="recaptcha" class="peer sr-only" {{ ($settings['captcha_provider'] ?? '') == 'recaptcha' ? 'checked' : '' }}>
                <div class="absolute inset-0 bg-slate-800/80 rounded-2xl border-2 border-slate-700 transition-all duration-300 peer-checked:border-blue-500 peer-checked:bg-blue-900/40 group-hover:border-blue-500/50"></div>
                <div class="relative p-6 flex flex-col items-center justify-center text-center h-full">
                    <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center mb-4 text-blue-400">
                        <span class="font-bold text-lg">G</span>
                    </div>
                    <div class="font-bold text-gray-300 peer-checked:text-blue-400">Google ReCaptcha v2</div>
                </div>
            </label>

            <!-- Turnstile -->
            <label class="cursor-pointer relative group">
                <input type="radio" name="captcha_provider" value="turnstile" class="peer sr-only" {{ ($settings['captcha_provider'] ?? '') == 'turnstile' ? 'checked' : '' }}>
                <div class="absolute inset-0 bg-slate-800/80 rounded-2xl border-2 border-slate-700 transition-all duration-300 peer-checked:border-orange-500 peer-checked:bg-orange-900/40 group-hover:border-orange-500/50"></div>
                <div class="relative p-6 flex flex-col items-center justify-center text-center h-full">
                    <div class="w-12 h-12 rounded-full bg-orange-500/20 flex items-center justify-center mb-4 text-orange-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11.96 11.23a8.94 8.94 0 0 0-5.83-2.16 8.54 8.54 0 0 0 0 17.08 7.6 7.6 0 0 0 3.3-.77v-2.6A5.16 5.16 0 0 1 6.13 23.51a5.95 5.95 0 0 1 0-11.9 6.47 6.47 0 0 1 4.18 1.57l1.65-2zm9.95-6.8a8.88 8.88 0 0 0-4.04-1A8.54 8.54 0 0 0 9.33 11.97 7.6 7.6 0 0 0 12.63 12.74v2.6a5.16 5.16 0 0 1-3.3-6.4 5.95 5.95 0 0 1 8.54 0 6.47 6.47 0 0 1 2.45 5.75l1.63 2z"/></svg>
                    </div>
                    <div class="font-bold text-gray-300 peer-checked:text-orange-400">Cloudflare Turnstile</div>
                </div>
            </label>
        </div>

        <!-- Configuration Form -->
        <div class="relative group">
            <!-- Background Container -->
            <div class="absolute inset-0 bg-slate-900/90 rounded-2xl border border-white/10 z-0"></div>
            
            <div class="relative z-10 p-8">
                <!-- Dynamic Title -->
                <div class="flex items-center gap-3 mb-6" id="configTitleParent">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        Konfigurasi Key
                    </h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2 uppercase tracking-wide">Site Key</label>
                        <input type="text" name="captcha_site_key" value="{{ $settings['captcha_site_key'] ?? '' }}" class="w-full bg-slate-950 border border-slate-700/50 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-cyan-500 focus:bg-slate-900 focus:ring-1 focus:ring-cyan-500 placeholder-gray-600 font-mono shadow-inner transition-all">
                        <p class="text-xs text-gray-500 mt-2">Dapatkan Site Key dari dashboard penyedia layanan.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2 uppercase tracking-wide">Secret Key</label>
                        <input type="text" name="captcha_secret_key" value="{{ $settings['captcha_secret_key'] ?? '' }}" class="w-full bg-slate-950 border border-slate-700/50 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-cyan-500 focus:bg-slate-900 focus:ring-1 focus:ring-cyan-500 placeholder-gray-600 font-mono shadow-inner transition-all">
                        <p class="text-xs text-gray-500 mt-2">Pastikan Secret Key dijaga kerahasiaannya.</p>
                    </div>
                </div>

                <div class="flex justify-end mt-10">
                   <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-1 active:translate-y-0 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
            
            <!-- Glow Effect -->
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 to-blue-500/5 blur-2xl rounded-2xl -z-10"></div>
        </div>
    </form>
@endsection
