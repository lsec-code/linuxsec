@extends('layouts.admin')

@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-white mb-2">Pengaturan Website</h1>
        <p class="text-gray-400">Konfigurasi informasi dasar dan kode iklan.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8 max-w-5xl">
        @csrf
        
        <!-- General Info -->
        <div class="relative group">
            <div class="absolute inset-0 bg-blue-600 blur-xl opacity-10 group-hover:opacity-20 transition duration-500 rounded-2xl"></div>
            <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl group-hover:border-blue-500/30 transition duration-300">
                <div class="flex items-center gap-4 mb-6 border-b border-white/5 pb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Informasi Dasar</h2>
                        <p class="text-sm text-gray-500">Identitas dan kontak website.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nomor WhatsApp Admin</label>
                        <input type="text" name="admin_wa" value="{{ $settings['admin_wa'] ?? '' }}" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-white placeholder-gray-600" placeholder="628123456789">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Link Saluran WhatsApp</label>
                        <input type="text" name="wa_channel" value="{{ $settings['wa_channel'] ?? '' }}" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-white placeholder-gray-600">
                    </div>
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Teks Copyright Footer</label>
                            <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? 'LinuxSec Tools' }}" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-white placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Tahun Copyright</label>
                            <input type="text" name="footer_year" value="{{ $settings['footer_year'] ?? date('Y') }}" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-white placeholder-gray-600">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ads Settings -->
        <div class="relative group">
            <div class="absolute inset-0 bg-yellow-600 blur-xl opacity-10 group-hover:opacity-20 transition duration-500 rounded-2xl"></div>
            <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl group-hover:border-yellow-500/30 transition duration-300">
                <div class="flex items-center gap-4 mb-6 border-b border-white/5 pb-4">
                    <div class="w-10 h-10 rounded-lg bg-yellow-500/20 flex items-center justify-center text-yellow-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Monetisasi (Ads)</h2>
                        <p class="text-sm text-gray-500">Kelola script iklan & popup (Global).</p>
                    </div>
                </div>

                <div class="p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl text-sm text-yellow-200 mb-6 flex gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>Masukkan kode script lengkap (termasuk tag &lt;script&gt;). Kode ini akan di-inject ke SEMUA halaman (Home, Tools, Error, dll).</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Script Popup / Header (Global)</label>
                        <p class="text-xs text-gray-500 mb-2">Script ini akan dieksekusi di dalam tag &lt;head&gt;. Cocok untuk script Popup, Google Analytics, atau meta tags.</p>
                        <textarea name="ad_header" rows="6" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition text-white placeholder-gray-600 font-mono text-xs">{{ $settings['ad_header'] ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Top Banner -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Banner Atas (Sticky Top)</label>
                            <p class="text-xs text-gray-500 mb-2">Posisi: Menempel di atas layar.</p>
                            <textarea name="ad_top" rows="6" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition text-white placeholder-gray-600 font-mono text-xs">{{ $settings['ad_top'] ?? '' }}</textarea>
                        </div>

                        <!-- Center Banner -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Banner Tengah (Floating)</label>
                            <p class="text-xs text-gray-500 mb-2">Posisi: Melayang di tengah layar.</p>
                            <textarea name="ad_center" rows="6" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition text-white placeholder-gray-600 font-mono text-xs">{{ $settings['ad_center'] ?? '' }}</textarea>
                        </div>

                        <!-- Bottom Banner -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Banner Bawah (Sticky Bottom)</label>
                            <p class="text-xs text-gray-500 mb-2">Posisi: Menempel di bawah layar.</p>
                            <textarea name="ad_footer" rows="6" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition text-white placeholder-gray-600 font-mono text-xs">{{ $settings['ad_footer'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1">Simpan Perubahan</button>
        </div>
    </form>
@endsection
