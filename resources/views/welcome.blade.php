<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Library') }} • Modern Library System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #4f46e5;       /* indigo-600 */
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --accent: #8b5cf6;        /* violet-500 for subtle highlights */
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

        <!-- Header / Navbar -->
        <header class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-16">
            <div class="flex items-center gap-4">
                <x-application-logo class="h-12 w-12 md:h-14 md:w-14 fill-current text-indigo-600 dark:text-indigo-400 drop-shadow-md" />
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ config('app.name', 'Library') }}
                    </h2>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium">
                        {{ __('Your modern reading sanctuary') }}
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
                    Discover • Borrow • Enjoy
                    <span class="block mt-2 bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                        Your Library, Reimagined
                    </span>
                </h1>

                <p class="mt-6 text-lg sm:text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    {{ __('Seamless book discovery, instant requests, powerful admin tools — designed for readers and librarians alike.') }}
                </p>

                <div class="mt-10 flex flex-wrap justify-center gap-4 sm:gap-6">
                    <a href="{{ route('books.index') }}" class="btn-primary inline-flex items-center gap-3 px-7 py-4 text-base sm:text-lg font-semibold rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        {{ __('Explore Books') }}
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-3 px-7 py-4 text-base sm:text-lg font-semibold rounded-xl border-2 border-indigo-200 dark:border-indigo-800 bg-white/70 dark:bg-gray-800/50 backdrop-blur-sm hover:bg-indigo-50 dark:hover:bg-indigo-950/30 transition-all duration-300">
                            {{ __('Join as Member') }}
                        </a>
                    @endif
                </div>
            </div>
        </section>

        <!-- Features / For Who -->
        <div class="grid lg:grid-cols-2 gap-8 xl:gap-12 mb-20">
            <div class="glass rounded-3xl p-8 md:p-10 card-hover">
                <h3 class="text-2xl md:text-3xl font-semibold mb-6 text-indigo-700 dark:text-indigo-300">
                    {{ __('For Readers & Members') }}
                </h3>
                <ul class="space-y-5 text-gray-700 dark:text-gray-300 text-lg">
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 text-xl font-bold">✓</span>
                        <span>{{ __('Advanced search, filters & availability checker') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 text-xl font-bold">✓</span>
                        <span>{{ __('One-click borrow requests & reservation') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 text-xl font-bold">✓</span>
                        <span>{{ __('Personal dashboard with reading history & due dates') }}</span>
                    </li>
                </ul>
            </div>

            <div class="glass rounded-3xl p-8 md:p-10 card-hover">
                <h3 class="text-2xl md:text-3xl font-semibold mb-6 text-blue-700 dark:text-blue-300">
                    {{ __('For Librarians & Admins') }}
                </h3>
                <ul class="space-y-5 text-gray-700 dark:text-gray-300 text-lg">
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-xl font-bold">✓</span>
                        <span>{{ __('Full catalog CRUD + bulk import/export') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-xl font-bold">✓</span>
                        <span>{{ __('Smart request approval workflow & notifications') }}</span>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-xl font-bold">✓</span>
                        <span>{{ __('Analytics, overdue tracking & member insights') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-20">
            <a href="{{ route('login') }}" class="glass rounded-2xl p-7 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all card-hover flex flex-col">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-14 w-14 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl">
                        👤
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold">{{ __('Member Login') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Browse & request instantly') }}</p>
                    </div>
                </div>
                <div class="mt-auto text-right">
                    <span class="text-indigo-600 dark:text-indigo-400 font-medium inline-flex items-center gap-2">
                        Sign in → 
                    </span>
                </div>
            </a>

            <a href="{{ route('librarian.login') ?? route('login') }}" class="glass rounded-2xl p-7 hover:border-blue-300 dark:hover:border-blue-600 transition-all card-hover flex flex-col">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-14 w-14 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 text-2xl">
                        📚
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold">{{ __('Librarian Login') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Manage catalog & requests') }}</p>
                    </div>
                </div>
                <div class="mt-auto text-right">
                    <span class="text-blue-600 dark:text-blue-400 font-medium inline-flex items-center gap-2">
                        Access panel →
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.login') ?? route('login') }}" class="glass rounded-2xl p-7 hover:border-purple-300 dark:hover:border-purple-600 transition-all card-hover flex flex-col">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-14 w-14 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400 text-2xl">
                        ⚙️
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold">{{ __('Admin Login') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Full system control') }}</p>
                    </div>
                </div>
                <div class="mt-auto text-right">
                    <span class="text-purple-600 dark:text-purple-400 font-medium inline-flex items-center gap-2">
                        Enter dashboard →
                    </span>
                </div>
            </a>
        </div>

        <!-- Footer -->
        <footer class="text-center text-sm text-gray-500 dark:text-gray-400 pt-12 border-t border-gray-200/70 dark:border-gray-700/50">
            {{ config('app.name') }} • Laravel {{ Illuminate\Foundation\Application::VERSION }} • PHP {{ PHP_VERSION }}
            <span class="mx-2">•</span>
            {{ date('Y') }} • Made with care
        </footer>

    </div>

</body>
</html>