<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0f172a; color: white; }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .glass-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
            transition: all 0.3s ease;
        }
        .glass-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px 0 rgba(0,0,0,0.5); border-color: rgba(255,255,255,0.3); }
        .input-field {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        .input-field:focus { border-color: #3b82f6; outline: none; }
        /* Hide scrollbar for clean modal */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    </style>
    <!-- Captcha Scripts -->
    @if(($settings['captcha_provider'] ?? 'none') == 'recaptcha')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @elseif(($settings['captcha_provider'] ?? 'none') == 'turnstile')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
</head>
<body class="min-h-screen flex flex-col p-4 bg-[url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat bg-fixed relative">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/70 z-0"></div>

    <div class="relative z-10 w-full max-w-5xl mx-auto flex-grow flex flex-col justify-center">
        <!-- Header -->
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 w-full">
            <div class="text-center md:text-left mb-4 md:mb-0">
                <h1 class="text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-cyan-400">LinuxSec Tools</h1>
                <p class="text-gray-400 text-sm mt-1">Gerbang Premium Menuju Keahlihan Digital</p>
                
                <!-- Live Stats -->
                <div class="flex gap-4 mt-4 justify-center md:justify-start">
                    <div class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 flex items-center gap-2">
                        <span class="text-green-400 text-xs">● Live</span>
                        <div class="text-xs text-gray-400">Pengunjung: <span id="visitor-count" class="text-white font-bold">...</span></div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-lg px-3 py-1 flex items-center gap-2">
                        <div class="text-xs text-gray-400">Users: <span id="user-count" class="text-white font-bold">...</span></div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col items-end gap-2">
                @auth
                    <div class="flex gap-4 items-center bg-white/5 px-6 py-2 rounded-full border border-white/10">
                        <span class="text-blue-400 font-medium hidden md:inline">Selamat datang, {{ Auth::user()->username }}</span>
                        
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-xs bg-emerald-600 text-white px-3 py-1 rounded-full hover:bg-emerald-500 transition font-bold shadow-lg shadow-emerald-500/20">
                                PANEL ADMIN
                            </a>
                        @endif

                        <button onclick="logout()" class="px-4 py-1 rounded-full border border-red-500/50 text-red-400 hover:bg-red-500/10 text-sm transition font-semibold">Keluar</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Dynamic Cards (Home) -->
            @php
                $homeCards = \App\Models\Card::where('page_location', 'home')->where('is_active', true)->orderBy('order')->get();
            @endphp
            @foreach($homeCards as $card)
                <a href="{{ $card->url }}" class="group relative block p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-white/10 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
                    <div class="relative z-10">
                        <div class="h-12 w-12 bg-blue-500/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $card->title }}</h3>
                        <p class="text-gray-400 text-sm">{{ $card->description }}</p>
                    </div>
                </a>
            @endforeach
            <!-- Tools Card -->
            <div onclick="handleToolsClick()" class="glass-card p-6 rounded-2xl cursor-pointer group flex flex-col items-center text-center h-64 justify-center">
                <div class="w-16 h-16 rounded-full bg-blue-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition text-blue-400 text-3xl">🛠️</div>
                <h3 class="text-xl font-bold mb-2 text-white">Alat / Tools</h3>
                <p class="text-gray-400 text-sm">Akses utilitas premium. Wajib login.</p>
                <div class="mt-4 px-4 py-1 rounded-full bg-white/5 border border-white/10 text-xs">
                    @auth Terbuka @else Terkunci 🔒 @endauth
                </div>
            </div>

            <!-- Tutorial Card -->
            <a href="{{ route('tutorial') }}" class="glass-card p-6 rounded-2xl cursor-pointer group flex flex-col items-center text-center h-64 justify-center">
                <div class="w-16 h-16 rounded-full bg-purple-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition text-purple-400 text-3xl">📚</div>
                <h3 class="text-xl font-bold mb-2 text-white">Tutorial</h3>
                <p class="text-gray-400 text-sm">Pelajari cara memaksimalkan potensimu.</p>
            </a>

            <!-- Contact Card -->
            <a href="https://wa.me/{{ $settings['admin_wa'] ?? '6283896554444' }}" target="_blank" class="glass-card p-6 rounded-2xl cursor-pointer group flex flex-col items-center text-center h-64 justify-center">
                <div class="w-16 h-16 rounded-full bg-green-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition text-green-400 text-3xl">📞</div>
                <h3 class="text-xl font-bold mb-2 text-white">Hubungi Admin</h3>
                <p class="text-gray-400 text-sm">Butuh bantuan? Chat kami di WhatsApp.</p>
            </a>

            <!-- Channel Card -->
            <a href="{{ $settings['wa_channel'] ?? '#' }}" target="_blank" class="glass-card p-6 rounded-2xl cursor-pointer group flex flex-col items-center text-center h-64 justify-center">
                <div class="w-16 h-16 rounded-full bg-teal-500/20 flex items-center justify-center mb-4 group-hover:scale-110 transition text-teal-400 text-3xl">📢</div>
                <h3 class="text-xl font-bold mb-2 text-white">Saluran WA</h3>
                <p class="text-gray-400 text-sm">Gabung channel update kami.</p>
            </a>
        </div>
    </div>

    <!-- Auth Modal -->
    <div id="authModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeModal()"></div>
        
        <div class="glass relative z-10 w-full max-w-md p-8 rounded-2xl transform transition-all scale-95 opacity-0" id="modalContent">
            
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white">&times;</button>

            <!-- Tab Buttons -->
            <div class="flex mb-6 border-b border-white/10">
                <button onclick="switchTab('login')" id="tab-login" class="flex-1 py-3 text-center border-b-2 border-blue-500 text-blue-400 font-semibold transition">Masuk</button>
                <button onclick="switchTab('register')" id="tab-register" class="flex-1 py-3 text-center border-b-2 border-transparent text-gray-400 hover:text-gray-200 transition">Daftar</button>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-4">
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Username</label>
                    <input type="text" name="username" class="input-field w-full p-3 rounded-lg" placeholder="Masukkan username..." required>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-gray-400 text-sm">Password</label>
                        <button type="button" onclick="switchTab('forgot')" class="text-xs text-blue-400 hover:text-blue-300">Lupa Password?</button>
                    </div>
                    <input type="password" name="password" class="input-field w-full p-3 rounded-lg" placeholder="••••••••" required>
                </div>
                <div id="loginError" class="text-red-400 text-sm hidden"></div>
                
                <!-- Captcha Widget -->
                @if(($settings['captcha_provider'] ?? 'none') == 'recaptcha')
                    <div class="g-recaptcha mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @elseif(($settings['captcha_provider'] ?? 'none') == 'turnstile')
                    <div class="cf-turnstile mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @endif

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-blue-500/30">Masuk</button>
            </form>

            <!-- Register Form -->
            <form id="registerForm" class="space-y-4 hidden">
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Username (Min 3 kar)</label>
                    <input type="text" name="username" class="input-field w-full p-3 rounded-lg" placeholder="contoh: user123 (Tanpa spasi/simbol kecuali titik)" required>
                    <p class="text-xs text-gray-500 mt-1">Hanya huruf, angka, dan titik.</p>
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Email</label>
                    <input type="email" name="email" class="input-field w-full p-3 rounded-lg" placeholder="email@contoh.com" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Password</label>
                        <input type="password" name="password" class="input-field w-full p-3 rounded-lg" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="input-field w-full p-3 rounded-lg" placeholder="••••••••" required>
                    </div>
                </div>
                
                <div id="registerError" class="text-red-400 text-sm hidden"></div>

                <!-- Captcha Widget -->
                @if(($settings['captcha_provider'] ?? 'none') == 'recaptcha')
                    <div class="g-recaptcha mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @elseif(($settings['captcha_provider'] ?? 'none') == 'turnstile')
                    <div class="cf-turnstile mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @endif

                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-emerald-500/30">Daftar</button>
            </form>

            <!-- Forgot Password Form -->
            <form id="forgotForm" class="space-y-4 hidden">
                <div class="text-center mb-4">
                    <h3 class="text-lg font-semibold text-white">Reset Password</h3>
                    <p class="text-gray-400 text-xs">Masukkan email Anda untuk menerima link reset.</p>
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-1">Email Terdaftar</label>
                    <input type="email" name="email" class="input-field w-full p-3 rounded-lg" placeholder="email@contoh.com" required>
                </div>
                <div id="forgotError" class="text-red-400 text-sm hidden"></div>
                <div id="forgotSuccess" class="text-green-400 text-sm hidden"></div>
                
                <!-- Captcha Widget -->
                @if(($settings['captcha_provider'] ?? 'none') == 'recaptcha')
                    <div class="g-recaptcha mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @elseif(($settings['captcha_provider'] ?? 'none') == 'turnstile')
                    <div class="cf-turnstile mb-4" data-sitekey="{{ $settings['captcha_site_key'] ?? '' }}"></div>
                @endif
                
                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-purple-500/30">Kirim Link Reset</button>
                
                <div class="text-center mt-4">
                    <button type="button" onclick="switchTab('login')" class="text-sm text-gray-400 hover:text-white">Kembali ke Login</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        const modal = document.getElementById('authModal');
        const modalContent = document.getElementById('modalContent');

        function handleToolsClick() {
            if (isAuthenticated) {
                window.location.href = "{{ route('tools') }}";
            } else {
                openModal();
            }
        }

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.getElementById('loginForm').reset();
            document.getElementById('registerForm').reset();
            document.getElementById('forgotForm').reset();
            switchTab('login'); // Reset to login tab
            clearErrors();
        }

        function switchTab(tab) {
            const loginBtn = document.getElementById('tab-login');
            const regBtn = document.getElementById('tab-register');
            const loginForm = document.getElementById('loginForm');
            const regForm = document.getElementById('registerForm');
            const forgotForm = document.getElementById('forgotForm');

            clearErrors();

            // Hide all forms first
            loginForm.classList.add('hidden');
            regForm.classList.add('hidden');
            forgotForm.classList.add('hidden');

            // Reset tab styles
            loginBtn.classList.replace('border-blue-500', 'border-transparent');
            loginBtn.classList.replace('text-blue-400', 'text-gray-400');
            regBtn.classList.replace('border-blue-500', 'border-transparent');
            regBtn.classList.replace('text-blue-400', 'text-gray-400');

            if (tab === 'login') {
                loginBtn.classList.replace('border-transparent', 'border-blue-500');
                loginBtn.classList.replace('text-gray-400', 'text-blue-400');
                loginForm.classList.remove('hidden');
            } else if (tab === 'register') {
                regBtn.classList.replace('border-transparent', 'border-blue-500');
                regBtn.classList.replace('text-gray-400', 'text-blue-400');
                regForm.classList.remove('hidden');
            } else if (tab === 'forgot') {
                forgotForm.classList.remove('hidden');
            }
        }

        function clearErrors() {
            document.getElementById('loginError').classList.add('hidden');
            document.getElementById('loginError').innerHTML = '';
            document.getElementById('registerError').classList.add('hidden');
            document.getElementById('registerError').innerHTML = '';
        }

        function logout() {
            document.getElementById('logout-form').submit();
        }

        // Axios setup
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Helper for Countdown
        function startCountdown(btn, originalText, seconds = 10) {
            if (btn.dataset.countdownActive) return; // Prevent double intervals
            
            btn.dataset.countdownActive = true;
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            
            let counter = seconds;
            btn.innerText = `Tunggu ${counter}s`;
            
            const interval = setInterval(() => {
                counter--;
                btn.innerText = `Tunggu ${counter}s`;
                
                if (counter <= 0) {
                    clearInterval(interval);
                    delete btn.dataset.countdownActive;
                    btn.disabled = false;
                    btn.innerText = originalText;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }, 1000);
        }

        // Login Handler
        // Login Handler
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            if (btn.disabled) return; // Prevent submission if locked

            const formData = new FormData(e.target);
            const errorDiv = document.getElementById('loginError');
            const originalText = btn.innerText;

            errorDiv.classList.add('hidden');

            try {
                const response = await axios.post("{{ route('login') }}", formData);
                window.location.reload();
            } catch (error) {
                errorDiv.classList.remove('hidden');
                
                if (error.response?.status === 429) {
                    const waitSeconds = error.response.data.retry_after || 10;
                    startCountdown(btn, originalText, waitSeconds);
                    errorDiv.innerHTML = error.response.data.errors?.username?.[0] || 'Terlalu banyak percobaan.';
                } else if (error.response?.data?.errors) {
                    errorDiv.innerHTML = Object.values(error.response.data.errors).flat().join('<br>');
                } else {
                    errorDiv.innerHTML = 'Login gagal. Silakan coba lagi.';
                }
            }
        });

        // Register Handler (No rate limit logic needed as per request, but keeping consistency)
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const errorDiv = document.getElementById('registerError');
            
            errorDiv.classList.add('hidden');

            try {
                const response = await axios.post("{{ route('register') }}", formData);
                window.location.reload();
            } catch (error) {
                errorDiv.classList.remove('hidden');
                if (error.response?.data?.errors) {
                    errorDiv.innerHTML = Object.values(error.response.data.errors).flat().join('<br>');
                } else {
                    errorDiv.innerHTML = 'Registrasi gagal. Cek inputan Anda.';
                }
            }
        });

        // Forgot Password Handler
        document.getElementById('forgotForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            if (btn.disabled) return; // Prevent submission if locked

            const formData = new FormData(e.target);
            const errorDiv = document.getElementById('forgotError');
            const successDiv = document.getElementById('forgotSuccess');
            const originalText = 'Kirim Link Reset'; // Hardcoded original text since we change it during submit
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            btn.disabled = true;
            btn.innerText = 'Mengirim...';

            try {
                const response = await axios.post("{{ route('password.email') }}", formData);
                successDiv.innerText = response.data.message;
                successDiv.classList.remove('hidden');
                
                if(response.data.debug_link) {
                    window.open(response.data.debug_link, '_blank');
                }

                btn.innerText = 'Terkirim!';
            } catch (error) {
                btn.disabled = false;
                btn.innerText = originalText;
                errorDiv.classList.remove('hidden');

                if (error.response?.status === 429) {
                    const waitSeconds = error.response.data.retry_after || 10;
                    startCountdown(btn, originalText, waitSeconds);
                    errorDiv.innerHTML = error.response.data.errors?.email?.[0] || 'Terlalu banyak percobaan.';
                } else if (error.response?.data?.errors) {
                    errorDiv.innerHTML = Object.values(error.response.data.errors).flat().join('<br>');
                } else {
                    errorDiv.innerHTML = 'Gagal mengirim link reset.';
                }
            }
        });
        // Stats Polling
        async function updateStats() {
            try {
                const response = await axios.get('/api/stats');
                document.getElementById('visitor-count').innerText = response.data.visitors;
                document.getElementById('user-count').innerText = response.data.users;
            } catch (error) {
                console.error('Failed to fetch stats', error);
            }
        }

        // Initial fetch and interval
        updateStats();
        setInterval(updateStats, 5000); // 5 seconds
    </script>
    </script>

    <!-- Toast Component -->
    @include('components.toast')

    <!-- Global Ad Banner -->
    @include('components.global-ads')

    <footer class="relative z-10 text-center py-8 text-gray-500 text-sm">
        &copy; {{ $settings['footer_year'] ?? date('Y') }} <span class="text-gray-400 font-semibold">{{ $settings['footer_text'] ?? 'LinuxSec Tools' }}</span>. All rights reserved.
    </footer>

    <!-- Global Ad Header/Popup Scripts (Executed Last) -->
    @if(isset($settings['ad_header']))
        {!! $settings['ad_header'] !!}
    @endif
</body>
</html>
