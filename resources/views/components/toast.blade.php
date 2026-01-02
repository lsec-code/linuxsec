<!-- Toast Container -->
<div id="toast-container" class="fixed top-10 left-1/2 -translate-x-1/2 z-[9999] space-y-4 w-full max-w-sm flex flex-col items-center pointer-events-none"></div>

<script>
    /**
     * Show a custom Glassmorphism Toast
     * @param {string} message - Message text
     * @param {string} type - 'success', 'error', 'info', 'warning'
     */
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        
        // Colors & Icons based on type
        const styles = {
            success: { bg: 'bg-emerald-500/20', border: 'border-emerald-500/30', text: 'text-emerald-400', icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' },
            error:   { bg: 'bg-red-500/20',     border: 'border-red-500/30',     text: 'text-red-400',     icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>' },
            info:    { bg: 'bg-blue-500/20',    border: 'border-blue-500/30',    text: 'text-blue-400',    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' },
            warning: { bg: 'bg-yellow-500/20',  border: 'border-yellow-500/30',  text: 'text-yellow-400',  icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>' }
        };

        const style = styles[type] || styles.success;

        // Create Toast Element
        const toast = document.createElement('div');
        toast.className = `flex items-center gap-3 px-4 py-3 rounded-xl border backdrop-blur-md shadow-lg transform -translate-y-full opacity-0 transition-all duration-300 w-full pointer-events-auto ${style.bg} ${style.border}`;
        
        toast.innerHTML = `
            <div class="h-8 w-8 rounded-full ${style.bg} flex items-center justify-center shrink-0 border ${style.border}">
                <svg class="w-4 h-4 ${style.text}" fill="none" stroke="currentColor" viewBox="0 0 24 24">${style.icon}</svg>
            </div>
            <div class="flex-1">
                <p class="text-white text-sm font-medium leading-tight text-left">${message}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;

        // Append & Animate
        container.appendChild(toast);
        
        // Trigger generic animation
        requestAnimationFrame(() => {
            toast.classList.remove('-translate-y-full', 'opacity-0');
        });

        // Auto Remove after 3s
        setTimeout(() => {
            toast.classList.add('-translate-y-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
