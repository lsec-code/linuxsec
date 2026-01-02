<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0f172a; color: white; }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0.2) 100%);
        }
    </style>
    @if(isset($settings['ad_header']))
        {!! $settings['ad_header'] !!}
    @endif
</head>
<body class="min-h-screen p-8 bg-[url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center bg-fixed bg-no-repeat">
    
    <div class="absolute inset-0 bg-black/80 z-0 fixed"></div>

    <div class="relative z-10 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-400">Tutorial Premium</h1>
                <p class="text-gray-400 mt-2">Tingkatkan keahlianmu dengan panduan pilihan kami.</p>
            </div>
            <a href="{{ route('home') }}" class="px-6 py-2 bg-white/10 hover:bg-white/20 rounded-full transition backdrop-blur-sm border border-white/10">Kembali ke Home</a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1: Hack WiFi -->
            <a href="https://www.youtube.com/watch?v=Of0egP8Y2ZM" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/wifi_security_1767372843935.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Wifi">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-red-500/80 rounded-full text-xs font-bold mb-3 inline-block">KEAMANAN</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-red-400 transition">Hack Password WiFi</h3>
                    <p class="text-gray-300 text-sm line-clamp-2">Pelajari dasar keamanan jaringan dan password.</p>
                </div>
            </a>

            <!-- Card 2: Pterodactyl Panel -->
            <a href="https://www.youtube.com/watch?v=LURKGDnxQ60" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/pterodactyl_server_1767372862798.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Server">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-blue-500/80 rounded-full text-xs font-bold mb-3 inline-block">HOSTING</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-blue-400 transition">Panel Pterodactyl (No VPS)</h3>
                    <p class="text-gray-300 text-sm line-clamp-2">Deploy game panel gratis tanpa sewa VPS.</p>
                </div>
            </a>

            <!-- Card 3: Minecraft Server -->
            <a href="https://www.youtube.com/watch?v=OOYLSu5NIlc" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/minecraft_server_1767372882274.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Minecraft">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-green-500/80 rounded-full text-xs font-bold mb-3 inline-block">GAMING</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-green-400 transition">Server Minecraft (Java & Bedrock)</h3>
                    <p class="text-gray-300 text-sm line-clamp-2">Buat server sendiri untuk main bareng teman.</p>
                </div>
            </a>

            <!-- Card 4: DDOS -->
            <a href="https://www.youtube.com/watch?v=lI2kUETUJ8I" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/ddos_attack_1767372900281.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Hacker">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-purple-500/80 rounded-full text-xs font-bold mb-3 inline-block">CYBER WARFARE</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-purple-400 transition">Tutorial DDOS Website</h3>
                    <p class="text-gray-300 text-sm line-clamp-2">Stress testing dan pemahaman serangan jaringan.</p>
                </div>
            </a>

            <!-- Card 5: Official Channel -->
            <a href="https://www.youtube.com/@lsectutorial" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block col-span-1 md:col-span-2 lg:col-span-1 border-yellow-500/30">
                <div class="absolute inset-0 bg-gradient-to-br from-red-600/20 to-yellow-600/20 z-0"></div>
                <img src="/images/lsec_channel_1767372919517.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110 opacity-60" alt="Youtube">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full text-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-red-600/40 group-hover:scale-110 transition">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-1">LSec Tutorial</h3>
                    <p class="text-gray-300 text-sm">Official Youtube Channel</p>
                </div>
            </a>

        </div>
    </div>
    <!-- Global Ad Banner -->
    @include('components.global-ads')

    <footer class="relative z-10 text-center py-8 text-gray-500 text-sm">
        &copy; {{ $settings['footer_year'] ?? date('Y') }} <span class="text-gray-400 font-semibold">{{ $settings['footer_text'] ?? 'LinuxSec Tools' }}</span>. All rights reserved.
    </footer>
</body>
</html>
