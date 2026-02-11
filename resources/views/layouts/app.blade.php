<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Library') }} – @yield('title')</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts - nicer default typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Optional: icons (you can also use font-awesome or lucide) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Your custom styles -->
    <style>
        :root {
            --primary:    #4f46e5;    /* indigo-600 */
            --primary-d:  #4338ca;    /* indigo-700 */
            --primary-l:  #6366f1;    /* indigo-500 */
            --gray-50:    #f9fafb;
            --gray-100:   #f3f4f6;
            --gray-200:   #e5e7eb;
            --gray-700:   #374151;
            --gray-800:   #1f2937;
            --gray-900:   #111827;
        }

        [data-bs-theme="dark"] {
            --primary:    #6366f1;
            --primary-d:  #4f46e5;
            --primary-l:  #818cf8;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0e7ff 100%);
            color: var(--gray-900);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(to right, var(--primary), var(--primary-d)) !important;
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.25);
            backdrop-filter: blur(8px);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.55rem;
            letter-spacing: -0.5px;
            color: white !important;
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,0.92) !important;
            transition: all 0.18s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            transform: translateY(-1px);
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 38px -10px rgba(0,0,0,0.22);
            margin-top: 8px;
        }

        main {
            padding-top: 2.5rem;
            padding-bottom: 4rem;
        }

        .card, .table {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 6px 24px rgba(0,0,0,0.08);
            background: white;
        }

        h1, h2, h3, .display-6 {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.4px;
        }

        /* Optional subtle glass effect on some cards */
        .glass {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.25);
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                color: var(--gray-100);
            }
            .card, .table {
                background: #1e293b;
                border-color: #334155;
                color: var(--gray-100);
            }
        }
    </style>

    @yield('head-styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Library') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1 gap-lg-3">

                    @guest
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('login') }}">Sign in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-light px-4 py-2 rounded-pill" href="{{ route('register') }}">
                                    Create account
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-3 py-2" href="{{ route('profile.show') }}">
                                        <i class="bi bi-person fs-5"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center gap-3 text-danger py-2">
                                            <i class="bi bi-box-arrow-right fs-5"></i>
                                            <span>Sign out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @yield('scripts')

</body>
</html>