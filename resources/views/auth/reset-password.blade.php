<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; background-color: #0f172a; color: white; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-[url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop')] bg-cover bg-center">
    
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm z-0"></div>

    <div class="relative z-10 w-full max-w-md bg-slate-900/80 p-8 rounded-2xl border border-white/10 shadow-2xl">
        <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>

        <form id="resetForm" class="space-y-4">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label class="block text-gray-400 text-sm mb-1">Password Baru</label>
                <input type="password" name="password" class="w-full bg-slate-800/50 border border-white/10 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 transition text-white" placeholder="••••••••" required>
            </div>
            <div>
                <label class="block text-gray-400 text-sm mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full bg-slate-800/50 border border-white/10 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 transition text-white" placeholder="••••••••" required>
            </div>

            <div id="resetError" class="text-red-400 text-sm hidden bg-red-500/10 p-3 rounded-lg border border-red-500/20"></div>
            <div id="resetSuccess" class="text-green-400 text-sm hidden bg-green-500/10 p-3 rounded-lg border border-green-500/20"></div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-blue-500/20">Simpan Password Baru</button>
        </form>
         <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition">Kembali ke Home</a>
        </div>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const errorDiv = document.getElementById('resetError');
            const successDiv = document.getElementById('resetSuccess');
            const btn = e.target.querySelector('button');
            
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');
            btn.disabled = true;
            btn.innerText = 'Processing...';

            try {
                const response = await axios.post("{{ route('password.update') }}", formData);
                successDiv.innerText = response.data.message;
                successDiv.classList.remove('hidden');
                
                setTimeout(() => {
                    window.location.href = "{{ route('home') }}";
                }, 2000);
            } catch (error) {
                btn.disabled = false;
                btn.innerText = 'Simpan Password Baru';
                errorDiv.classList.remove('hidden');
                if (error.response?.data?.errors) {
                    errorDiv.innerHTML = Object.values(error.response.data.errors).flat().join('<br>');
                } else {
                    errorDiv.innerHTML = 'Gagal mereset password.';
                }
            }
        });
    </script>
</body>
</html>
