<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasa Digital Sosial Media - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0f172a; color: white; }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            transform: translateY(-8px);
            background: rgba(30, 41, 59, 0.9);
            border-color: rgba(99, 102, 241, 0.5); /* Indigo-500 */
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.4);
        }
        .wa-btn {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transition: all 0.3s ease;
        }
        .wa-btn:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
        }
        }
    </style>
    @if(isset($settings['ad_header']))
        {!! $settings['ad_header'] !!}
    @endif
</head>
<body class="min-h-screen p-8 bg-[url('https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=1974&auto=format&fit=crop')] bg-cover bg-center bg-fixed bg-no-repeat">
    
    <div class="absolute inset-0 bg-[#0f172a]/90 z-0 fixed"></div>

    <div class="relative z-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16 space-y-4">
            <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 pb-2">
                Jasa Digital Sosial Media
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                Solusi terpercaya untuk kebutuhan digital marketing Anda. Dijamin aman, cepat, dan profesional.
            </p>
            <a href="{{ route('tools') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-white/5 hover:bg-white/10 rounded-full transition border border-white/10 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Tools
            </a>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Service 1: Hapus Rating -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-blue-500/20 flex items-center justify-center mb-6 ring-1 ring-blue-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Hapus Rating & Ulasan Buruk</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Google Maps Permanen. Hilangkan ulasan bintang 1-3 untuk reputasi bisnis yang lebih baik.</p>
                <div class="w-full mt-auto">
                    <div class="text-blue-400 font-bold text-lg mb-4">Mulai Rp 200.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20memesan%20Jasa%20Hapus%20Rating%20%26%20Ulasan%20Buruk%20Google%20Maps" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Service 2: Recovery Akun -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-purple-500/20 flex items-center justify-center mb-6 ring-1 ring-purple-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Jasa Recovery Akun</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Instagram/FB/TikTok Lupa Password atau Kena Hack. Kembalikan akses akun Anda dalam 1-3 hari.</p>
                <div class="w-full mt-auto">
                    <div class="text-purple-400 font-bold text-lg mb-4">Mulai Rp 50.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20recovery%20akun%20sosial%20media" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Service 3: Followers IG -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-pink-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-pink-500/20 flex items-center justify-center mb-6 ring-1 ring-pink-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Followers Instagram</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Real Aktif Indonesia & Luar Negeri. Berkualitas tinggi, non-drop, aman untuk bisnis & influencer.</p>
                <div class="w-full mt-auto">
                    <div class="text-pink-400 font-bold text-lg mb-4">Mulai Rp 50.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20memesan%20Followers%20Instagram" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Service 4: Subscriber Youtube -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-red-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-red-500/20 flex items-center justify-center mb-6 ring-1 ring-red-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Subscriber Youtube</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Subscriber Real + 4000 Jam Tayang Permanen. Siap monetisasi saluran Anda.</p>
                <div class="w-full mt-auto">
                    <div class="text-red-400 font-bold text-lg mb-4">Mulai Rp 250.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20memesan%20Subscriber%20Youtube%20%2B%20Watch%20Hours" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Service 5: Facebook Page -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-cyan-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-cyan-500/20 flex items-center justify-center mb-6 ring-1 ring-cyan-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Followers Facebook</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Facebook Page & TikTok Shop Real. Boost profil page Anda dengan cepat dan aman.</p>
                <div class="w-full mt-auto">
                    <div class="text-cyan-400 font-bold text-lg mb-4">Mulai Rp 80.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20memesan%20Followers%20Facebook%2F%20Tiktok%20Shop" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Service 6: Lacak Lokasi -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="w-20 h-20 rounded-2xl bg-indigo-500/20 flex items-center justify-center mb-6 ring-1 ring-indigo-500/30 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Jasa Lacak Lokasi</h3>
                <p class="text-gray-400 text-sm mb-6 flex-grow">Identitas Penipu Online (Nomor HP, Akun, Alamat). Data lengkap dan akurat.</p>
                <div class="w-full mt-auto">
                    <div class="text-indigo-400 font-bold text-lg mb-4">Mulai Rp 250.000,-</div>
                    <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}?text=Halo%20saya%20mau%20memesan%20Jasa%20Lacak%20Lokasi%20%26%20Identitas" target="_blank" class="wa-btn w-full py-3 rounded-xl flex items-center justify-center gap-2 text-white font-semibold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        Pesan Sekarang
                    </a>
                </div>
            </div>

        </div>

        </div>

    </div>
    <!-- Global Ad Banner -->
    @include('components.global-ads')

    <footer class="relative z-10 text-center py-8 text-gray-500 text-sm">
        &copy; {{ $settings['footer_year'] ?? date('Y') }} <span class="text-gray-400 font-semibold">{{ $settings['footer_text'] ?? 'LinuxSec Tools' }}</span>. All rights reserved.
    </footer>
</body>
</html>
