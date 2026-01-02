<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools - {{ config('app.name') }}</title>
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
        .glass {
             background: rgba(30, 41, 59, 0.8);
             backdrop-filter: blur(12px);
             border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    @if(isset($settings['ad_header']))
        {!! $settings['ad_header'] !!}
    @endif
</head>
<body class="min-h-screen p-8 bg-[url('https://images.unsplash.com/photo-1519638399535-1b036603ac77?q=80&w=2031&auto=format&fit=crop')] bg-cover bg-center bg-fixed bg-no-repeat">
    
    <div class="absolute inset-0 bg-black/80 z-0 fixed"></div>

    <div class="relative z-10 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400">Tools Premium</h1>
                <p class="text-gray-400 mt-2">Kumpulan alat khusus untuk kebutuhan digital Anda.</p>
            </div>
            <a href="{{ route('home') }}" class="px-6 py-2 bg-white/10 hover:bg-white/20 rounded-full transition backdrop-blur-sm border border-white/10">Kembali ke Home</a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1: Pterodactyl Panel -->
            <a href="https://server-linuxsec.web.id" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/pterodactyl_tool_1767373463701.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Pterodactyl">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-blue-500/80 rounded-full text-xs font-bold mb-3 inline-block">SERVER</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-blue-400 transition">Panel Pterodactyl</h3>
                    <p class="text-gray-300 text-sm">Free Trial 7 Hari (Gratis Uji Coba)</p>
                </div>
            </a>

            <!-- Card 2: Wifi Password Generator -->
            <div onclick="openWifiModal()" class="glass-card group relative h-64 rounded-2xl overflow-hidden block cursor-pointer">
                <img src="/images/wifi_generator_tool_1767373482915.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Wifi Gen">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-green-500/80 rounded-full text-xs font-bold mb-3 inline-block">SECURITY Tool</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-green-400 transition">Wifi Password Generator FH</h3>
                    <p class="text-gray-300 text-sm">Generate secure passkey untuk jaringan FH.</p>
                </div>
            </div>

            <!-- Card 3: NGL Spammer -->
            <a href="https://ngl.linuxsec.web.id/" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/ngl_spammer_1767373499344.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="NGL">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-orange-500/80 rounded-full text-xs font-bold mb-3 inline-block">FUN</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-orange-400 transition">NGL Spammer</h3>
                    <p class="text-gray-300 text-sm">Kirim pesan anonim secara massal.</p>
                </div>
            </a>

            <!-- Card 4: Jasa Digital (New Page) -->
            <a href="{{ route('social-services') }}" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/digi_media_1767373518695.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="SMM">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full">
                    <span class="px-3 py-1 bg-purple-500/80 rounded-full text-xs font-bold mb-3 inline-block">MARKETING</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-purple-400 transition">Jasa Digital Sosial Media</h3>
                    <p class="text-gray-300 text-sm">Layanan boosting follower & engagement.</p>
                </div>
            </a>

            <!-- Card 5: Website Penghasil Uang -->
            <a href="https://lsec.web.id" target="_blank" class="glass-card group relative h-64 rounded-2xl overflow-hidden block">
                <img src="/images/money_website_1767373534812.png" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Money">
                <div class="absolute inset-0 overlay"></div>
                <div class="absolute bottom-0 p-6 w-full text-left">
                     <span class="px-3 py-1 bg-yellow-500/80 rounded-full text-xs font-bold mb-3 inline-block">EARNING</span>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-yellow-400 transition">Website Penghasil Uang</h3>
                    <p class="text-gray-300 text-sm">Hanya upload video dan shared.</p>
                    <!-- Dynamic Tools Cards -->
            @php
                $toolCards = \App\Models\Card::where('page_location', 'tools')->where('is_active', true)->orderBy('order')->get();
            @endphp
            @foreach($toolCards as $card)
                <a href="{{ $card->url }}" class="group relative block p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-white/10 transition-all duration-300">
                    <div class="relative z-10">
                        <div class="h-12 w-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="text-2xl">🔧</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $card->title }}</h3>
                        <p class="text-gray-400 text-sm">{{ $card->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
            </a>

        </div>
    </div>

    <!-- Wifi Generator Modal -->
    <div id="wifiModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md transition-opacity duration-300" onclick="closeWifiModal()"></div>
        
        <!-- Modal Card -->
        <div class="relative z-10 w-full max-w-md p-[1px] rounded-2xl bg-gradient-to-br from-cyan-500/30 via-blue-500/10 to-purple-500/30 shadow-2xl shadow-cyan-500/20 transform transition-all scale-95 opacity-0" id="wifiModalContent">
            
            <div class="bg-[#0f172a]/95 backdrop-blur-xl rounded-2xl p-8 w-full h-full relative overflow-hidden">
                
                <!-- Decorative Glows -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-cyan-500/20 rounded-full blur-3xl -translate-x-16 -translate-y-16 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl translate-x-16 translate-y-16 pointer-events-none"></div>

                <button onclick="closeWifiModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white transition bg-white/5 hover:bg-white/10 rounded-full p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <div class="text-center relative">
                    <h2 class="text-2xl font-bold text-white mb-2 tracking-wide font-[Outfit]">FH PASSKEY GENERATOR</h2>
                    <div class="h-1 w-20 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full mx-auto mb-8"></div>
                    
                    <div class="text-left mb-6 space-y-2">
                        <label class="block text-gray-300 text-sm font-medium ml-1">SSID Jaringan</label>
                        <div class="relative group">
                            <input type="text" id="ssidInput" 
                                class="w-full bg-[#1e293b] border border-gray-700/50 rounded-xl p-4 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/20 transition-all font-mono tracking-wide group-hover:bg-[#1e293b]/80" 
                                placeholder="fh_XXXXXX" autocomplete="off">
                            <div class="absolute right-3 top-3.5 text-gray-600 group-hover:text-cyan-500/50 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                            </div>
                        </div>
                        <p id="wifiError" class="text-red-400 text-xs mt-2 pl-1 hidden flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <span>Format salah!</span>
                        </p>
                    </div>

                    <div id="resultArea" class="hidden mb-6 p-1 rounded-xl bg-gradient-to-r from-green-500/20 to-emerald-500/20">
                        <div class="bg-[#0f172a] rounded-lg p-4 border border-green-500/20 relative overflow-hidden">
                             <div class="absolute inset-0 bg-green-500/5 animate-pulse pointer-events-none"></div>
                            <p class="text-green-400 text-xs uppercase font-bold tracking-wider mb-2">Generated Password</p>
                            <div class="flex items-center justify-between bg-black/30 rounded-lg p-3 border border-white/5">
                                <p class="text-white font-mono text-xl font-bold tracking-wider select-all truncate mr-2" id="generatedPass">...</p>
                                <button onclick="copyPass()" class="text-gray-400 hover:text-white transition active:scale-90 p-2 hover:bg-white/5 rounded-lg" title="Copy">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button onclick="generatePass()" id="generateBtn" class="w-full relative group overflow-hidden bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-600 bg-[length:200%_auto] hover:bg-right transition-all duration-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-cyan-500/25 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            GENERATE
                            <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const wifiModal = document.getElementById('wifiModal');
        const wifiContent = document.getElementById('wifiModalContent');

        function openWifiModal() {
            wifiModal.classList.remove('hidden');
            setTimeout(() => {
                wifiContent.classList.remove('scale-95', 'opacity-0');
                wifiContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeWifiModal() {
            wifiContent.classList.remove('scale-100', 'opacity-100');
            wifiContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                wifiModal.classList.add('hidden');
                document.getElementById('resultArea').classList.add('hidden');
                document.getElementById('ssidInput').value = '';
                document.getElementById('wifiError').classList.add('hidden');
            }, 300);
        }

        function generatePass() {
            const ssidInput = document.getElementById('ssidInput').value.trim().toLowerCase();
            const resArea = document.getElementById('resultArea');
            const resText = document.getElementById('generatedPass');
            const errorMsg = document.getElementById('wifiError');
            const btn = document.getElementById('generateBtn');

            // Reset UI
            errorMsg.classList.add('hidden');
            
            // Regex Validation
            const ssidRegex = /^fh_[0-9a-f]{6}(_5g|_4g)?$/;
            
            if (!ssidInput) {
                errorMsg.innerText = 'Masukkan SSID terlebih dahulu!';
                errorMsg.classList.remove('hidden');
                return;
            }

            if (!ssidRegex.test(ssidInput)) {
                errorMsg.innerText = 'Format SSID salah! Gunakan format fh_XXXXXX (contoh: fh_858dc0)';
                errorMsg.classList.remove('hidden');
                showToast('Format SSID tidak valid!', 'error');
                return;
            }

            // Logic
            btn.disabled = true;
            btn.innerHTML = '<span class="animate-spin inline-block mr-2">⟳</span> Processing...';

            setTimeout(() => {
                // Remove prefix and suffix
                const hexPart = ssidInput.replace(/^fh_/, '').replace(/_5g$|_4g$/, '');

                let kunci = 'wlan';
                for (let i = 0; i < 6; i += 2) {
                    const byteVal = parseInt(hexPart.substr(i, 2), 16);
                    const notVal = 255 - byteVal;
                    kunci += notVal.toString(16).padStart(2, '0');
                }

                resText.innerText = kunci;
                resArea.classList.remove('hidden');
                
                btn.disabled = false;
                btn.innerText = 'Generate';
            }, 800); // Fake Loading for effect
        }

        function copyPass() {
            const text = document.getElementById('generatedPass').innerText;
            navigator.clipboard.writeText(text).then(() => {
                showToast('Password berhasil disalin!', 'success');
            });
        }
    </script>
    <!-- Toast Component -->
    @include('components.toast')

    <!-- Global Ad Banner -->
    @include('components.global-ads')

    <footer class="relative z-10 text-center py-8 text-gray-500 text-sm">
        &copy; {{ $settings['footer_year'] ?? date('Y') }} <span class="text-gray-400 font-semibold">{{ $settings['footer_text'] ?? 'LinuxSec Tools' }}</span>. All rights reserved.
    </footer>
</body>
</html>
