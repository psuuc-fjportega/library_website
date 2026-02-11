<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Urdaneta City Public Library and Tech4Ed Center • Modern Library System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --accent: #8b5cf6;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
        }

        .dark body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.025em;
        }

        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .dark .glass {
            background: rgba(30, 41, 59, 0.65);
            border-color: rgba(255, 255, 255, 0.08);
        }

        .btn-primary {
            @apply bg-indigo-600 text-white shadow-lg shadow-indigo-200/50 hover:bg-indigo-700 hover:shadow-indigo-300/50 dark:shadow-indigo-900/30 dark:hover:shadow-indigo-800/40 transition-all duration-300;
        }

        .card-hover {
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(79, 70, 229, 0.18);
        }

        .dark .card-hover:hover {
            box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.25);
        }
    </style>
</head>
<body class="antialiased min-h-screen bg-gradient-to-br from-sky-50 via-white to-indigo-50/30 dark:from-gray-950 dark:via-gray-900 dark:to-indigo-950/20 text-gray-900 dark:text-gray-100">

<div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-16">

    <!-- Header -->
    <header class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-16">
        <div class="flex items-center gap-4">
            <x-application-logo class="h-12 w-12 md:h-14 md:w-14 fill-current text-indigo-600 dark:text-indigo-400 drop-shadow-md" />
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Urdaneta City Public Library and Tech4Ed Center
                </h2>
                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium">
                    Your modern reading and digital learning hub
                </p>
            </div>
        </div>

        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
    </header>

    <!-- Hero -->
    <section class="relative mb-20 lg:mb-28">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight leading-tight">
                Discover • Learn • Connect
                <span class="block mt-2 bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                    Urdaneta City Public Library Experience
                </span>
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Seamless book discovery, digital resources, Tech4Ed services, and modern library management — designed for readers, students, and the Urdaneta community.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-4 sm:gap-6">
                <a href="{{ route('books.index') }}" class="btn-primary inline-flex items-center gap-3 px-7 py-4 text-base sm:text-lg font-semibold rounded-xl">
                    Explore Books
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-3 px-7 py-4 text-base sm:text-lg font-semibold rounded-xl border-2 border-indigo-200 dark:border-indigo-800 bg-white/70 dark:bg-gray-800/50 backdrop-blur-sm hover:bg-indigo-50 dark:hover:bg-indigo-950/30 transition-all duration-300">
                        Join as Member
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 dark:text-gray-400 pt-12 border-t border-gray-200/70 dark:border-gray-700/50">
        Urdaneta City Public Library and Tech4Ed Center • Laravel {{ Illuminate\Foundation\Application::VERSION }} • PHP {{ PHP_VERSION }}
        <span class="mx-2">•</span>
        {{ date('Y') }} • Serving the community
    </footer>

</div>
</body>
</html>
