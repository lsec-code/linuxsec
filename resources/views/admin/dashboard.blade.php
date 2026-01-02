@extends('layouts.admin')

@section('content')
@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-white mb-2">Dashboard</h1>
        <p class="text-gray-400">Ringkasan aktivitas website Anda hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Visitors Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-blue-600 blur-xl opacity-20 group-hover:opacity-40 transition duration-500 rounded-2xl"></div>
            <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl flex items-center justify-between group-hover:border-blue-500/30 transition duration-300">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-2">Total Pengunjung</h3>
                    <p class="text-4xl font-bold text-white">{{ \App\Models\Visitor::count() }}</p>
                </div>
                <div class="h-14 w-14 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-400">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-purple-600 blur-xl opacity-20 group-hover:opacity-40 transition duration-500 rounded-2xl"></div>
            <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl flex items-center justify-between group-hover:border-purple-500/30 transition duration-300">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-2">Total Users</h3>
                    <p class="text-4xl font-bold text-white">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="h-14 w-14 rounded-xl bg-purple-500/20 flex items-center justify-center text-purple-400">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Active Cards -->
        <div class="relative group">
            <div class="absolute inset-0 bg-emerald-600 blur-xl opacity-20 group-hover:opacity-40 transition duration-500 rounded-2xl"></div>
            <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl flex items-center justify-between group-hover:border-emerald-500/30 transition duration-300">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-2">Total Kartu Aktif</h3>
                    <p class="text-4xl font-bold text-white">{{ \App\Models\Card::where('is_active', true)->count() }}</p>
                </div>
                <div class="h-14 w-14 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Management Grid -->
    <div class="mt-12">
        <h2 class="text-xl font-bold text-white mb-6">Admin Management</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            
            <!-- ADS / Iklan -->
            <a href="{{ route('admin.settings') }}" class="group relative bg-slate-900/40 backdrop-blur-sm border border-white/5 hover:bg-slate-800/60 p-6 rounded-2xl transition-all duration-300 flex items-start gap-4 hover:border-yellow-500/30">
                <div class="w-12 h-12 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-500 group-hover:scale-110 transition-transform duration-300">
                    <span class="font-bold text-xs">Ad</span>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-1 group-hover:text-yellow-400 transition">ADS / Iklan</h3>
                    <p class="text-gray-400 text-sm">Kelola kode iklan & penempatan script (Global & Spesifik).</p>
                </div>
            </a>

            <!-- Manajemen Kartu -->
            <a href="{{ route('admin.cards') }}" class="group relative bg-slate-900/40 backdrop-blur-sm border border-white/5 hover:bg-slate-800/60 p-6 rounded-2xl transition-all duration-300 flex items-start gap-4 hover:border-blue-500/30">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-1 group-hover:text-blue-400 transition">Manajemen Kartu</h3>
                    <p class="text-gray-400 text-sm">Tambah/Hapus kartu di Dashboard, Tools, dan Tutorial.</p>
                </div>
            </a>

            <!-- Pengaturan Umum (Placeholder for future features) -->
             <a href="{{ route('admin.settings') }}" class="group relative bg-slate-900/40 backdrop-blur-sm border border-white/5 hover:bg-slate-800/60 p-6 rounded-2xl transition-all duration-300 flex items-start gap-4 hover:border-emerald-500/30">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-1 group-hover:text-emerald-400 transition">Pengaturan Umum</h3>
                    <p class="text-gray-400 text-sm">Edit info dasar, kontak WA, dan copyright footer.</p>
                </div>
            </a>
            


        </div>
    </div>
@endsection
