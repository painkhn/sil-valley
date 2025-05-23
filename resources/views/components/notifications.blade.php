@if (session('success'))
    <div class="flex absolute top-32 max-[650px]:right-0 right-10 items-center p-4 mb-4 text-sm text-green-800 border shadow-[0_2px_15px_rgba(74,222,128,.3)] border-green-300 rounded-lg bg-green-50 dark:bg-gradient-to-t dark:from-[#111111] dark:to-[#181818] dark:text-green-400 dark:border-green-800 max-w-xl max-[650px]:max-w-md w-full mx-auto"
        role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div>
            <span class="font-medium">Успех!</span> {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="flex absolute top-32 right-10 items-center p-4 mb-4 text-sm text-red-800 border shadow-[0_2px_15px_rgba(239,68,68,.3)] border-red-300 rounded-lg bg-red-50 bg-gradient-to-t dark:from-[#111111] dark:to-[#181818] dark:text-red-400 dark:border-red-800 max-w-xl w-full mx-auto"
        role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div>
            <span class="font-medium">Ошибка!</span> {{ session('error') }}
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
    });
</script>
