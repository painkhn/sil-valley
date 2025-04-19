<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script>
        (function() {
            const theme = localStorage.theme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="bg-[#f5f5f5] dark:bg-gradient-to-r dark:from-[#0a0a0a] dark:to-[#1f1f1f] text-white flex min-h-screen flex-col relative">
    <!-- хедер -->
    <x-header />

    <main class="py-10 px-5 min-h-[calc(100vh-205px)]">
        <x-notifications />
        <div class="space-y-20">
            @yield('content')
        </div>
    </main>

    <!-- футер -->
    <x-footer />
</body>

<script>
    const value = document.querySelector("#shopMinPriceValue");
    const input = document.querySelector("#shopMinPriceInput");

    const valueMax = document.querySelector("#shopMaxPriceValue");
    const inputMax = document.querySelector("#shopMaxPriceInput");

    value.textContent = input.value;
    valueMax.textContent = inputMax.value;

    input.addEventListener("input", (event) => {
        value.textContent = event.target.value;
    });
    inputMax.addEventListener("input", (event) => {
        valueMax.textContent = event.target.value;
    });
</script>

<!-- сдн флоубайта -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</html>
