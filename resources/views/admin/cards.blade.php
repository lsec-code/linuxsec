@extends('layouts.admin')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Manajemen Kartu</h1>
            <p class="text-gray-400">Atur konten dinamis untuk halaman Home, Tools, dan Tutorial.</p>
        </div>
        <div class="flex p-1 bg-slate-900/50 backdrop-blur-md rounded-xl border border-white/10">
            <a href="?location=home" class="px-6 py-2 rounded-lg text-sm font-medium transition-all {{ $location == 'home' ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:text-white' }}">Home</a>
            <a href="?location=tools" class="px-6 py-2 rounded-lg text-sm font-medium transition-all {{ $location == 'tools' ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:text-white' }}">Tools</a>
            <a href="?location=tutorial" class="px-6 py-2 rounded-lg text-sm font-medium transition-all {{ $location == 'tutorial' ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:text-white' }}">Tutorial</a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="relative group mb-10">
        <div class="absolute inset-0 bg-emerald-600 blur-xl opacity-10 group-hover:opacity-20 transition duration-500 rounded-2xl"></div>
        <div class="relative bg-slate-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl group-hover:border-emerald-500/30 transition duration-300">
            <h2 class="text-xl font-semibold text-white mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-lg">+</span>
                Tambah Kartu Baru ({{ ucfirst($location) }})
            </h2>
            
            <form action="{{ route('admin.cards.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <input type="hidden" name="page_location" value="{{ $location }}">
                <input type="hidden" name="is_active" value="1">
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Judul Kartu</label>
                    <input type="text" name="title" required class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition text-white placeholder-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">URL / Link Tujuan</label>
                    <input type="text" name="url" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition text-white placeholder-gray-600">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi Singkat</label>
                    <input type="text" name="description" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition text-white placeholder-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Urutan (Prioritas)</label>
                    <input type="number" name="order" value="0" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition text-white placeholder-gray-600">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-emerald-500/20 transition">Tambahkan Kartu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- List Cards -->
    <div class="grid grid-cols-1 gap-4">
        @foreach($cards as $card)
            <div class="group relative bg-slate-900/40 backdrop-blur-md border border-white/5 p-6 rounded-2xl flex items-center justify-between hover:border-blue-500/30 hover:bg-slate-900/60 transition duration-300">
                <div class="flex items-start gap-4">
                    <div class="flex flex-col items-center justify-center w-12 h-12 rounded-xl bg-white/5 border border-white/10 text-gray-400 font-mono text-sm">
                        <span class="text-[10px] uppercase">Urutan</span>
                        <span class="font-bold text-white">{{ $card->order }}</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white mb-1 group-hover:text-blue-400 transition">{{ $card->title }}</h3>
                        <p class="text-gray-400 text-sm mb-2 line-clamp-1">{{ $card->description }}</p>
                        <a href="{{ $card->url }}" target="_blank" class="text-xs text-blue-400 hover:text-blue-300 bg-blue-500/10 px-2 py-1 rounded border border-blue-500/20 inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            {{ $card->url }}
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.cards.delete', $card->id) }}" method="POST" onsubmit="return confirm('Hapus kartu ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition flex items-center justify-center" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
