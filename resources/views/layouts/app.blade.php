<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Uknight Cloud') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #2A6B51;
            --primary-dark: #1F4F3A;
            --primary-light: #4A8B6B;
            --secondary-color: #F5E0B3;
            --secondary-dark: #E6C896;
            --secondary-light: #FDF4E3;
            --accent-color: #8B4513;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --text-light: #9CA3AF;
            --bg-primary: #FFFFFF;
            --bg-secondary: #F9FAFB;
            --bg-tertiary: #F3F4F6;
            --border-color: #E5E7EB;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles - Modern & Refined */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            padding: 1.25rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: var(--primary-color) !important;
            text-decoration: none;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-brand:hover {
            background: rgba(42, 107, 81, 0.05);
            transform: translateY(-1px);
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-secondary) !important;
            padding: 0.625rem 1.25rem !important;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(99, 102, 241, 0.05);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(99, 102, 241, 0.1);
        }

        .nav-link.btn-primary {
            color: #ffffff !important;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .nav-link.btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-link.btn-primary:hover::before {
            left: 100%;
        }

        .nav-link.btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #4338ca 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Card Styles - Modern & Refined */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg-primary);
            overflow: hidden;
            border: 1px solid rgba(229, 231, 235, 0.8);
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border-color: rgba(42, 107, 81, 0.2);
        }

        /* Button Styles - Modern & Refined */
        .btn {
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            padding: 0.875rem 2rem;
            border-radius: 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(42, 107, 81, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1a3d2b 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(42, 107, 81, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(42, 107, 81, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #d97706 100%);
            border: none;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            padding: 0.75rem 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .dropdown-item i {
            width: 1.25rem;
            margin-right: 0.75rem;
        }

        /* Layout */
        main {
            flex: 1;
        }

        footer {
            margin-top: auto;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 3rem 0 2rem;
        }

        footer h5, footer h6 {
            color: var(--secondary-color) !important;
        }

        footer p, footer a {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        footer a:hover {
            color: var(--secondary-color) !important;
        }

        footer hr {
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Social Buttons */
        .btn-social {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            color: var(--secondary-color);
            font-size: 1.2rem;
            text-decoration: none;
        }

        .btn-social:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-social i {
            font-size: 1.2rem;
            line-height: 1;
        }

        /* User Avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 0.75rem;
            border: 2px solid var(--primary-light);
        }

        /* Navbar Toggler */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            .nav-item {
                margin: 0.25rem 0;
            }
            .navbar-brand {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Uknight Cloud
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                                <i class="fas fa-lightbulb me-2"></i>プロジェクト
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('guide') ? 'active' : '' }}" href="{{ route('guide') }}">
                                <i class="fas fa-book-open me-2"></i>ガイド
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="fas fa-chart-line me-2"></i>ダッシュボード
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        ログイン
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('register') }}">
                                        新規登録
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6366f1&color=fff" alt="{{ Auth::user()->name }}" class="user-avatar">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-columns"></i>ダッシュボード
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}">
                                        <i class="fas fa-user-edit"></i>プロフィール
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard.purchaseHistory') }}">
                                        <i class="fas fa-history"></i>支援履歴
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>ログアウト
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main style="margin-top: 120px;">
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-rocket me-2"></i>Uknight Cloud
                        </h5>
                        <p class="text-muted">夢を現実にするクラウドファンディングプラットフォーム</p>
                        <div class="d-flex gap-2">
                            <a href="https://x.com/uknight_hc" target="_blank" rel="noopener noreferrer" class="btn-social" title="X (Twitter)">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/uknight_hc/" target="_blank" rel="noopener noreferrer" class="btn-social" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://hachiouji-uknight.com/" target="_blank" rel="noopener noreferrer" class="btn-social" title="公式ウェブサイト">
                                <i class="fas fa-globe"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="mb-3">サービス</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('projects.index') }}" class="text-muted text-decoration-none">プロジェクト</a></li>
                            <li><a href="{{ route('categories') }}" class="text-muted text-decoration-none">カテゴリ</a></li>
                            <li><a href="{{ route('faq') }}" class="text-muted text-decoration-none">よくある質問</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="mb-3">サポート</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('contact') }}" class="text-muted text-decoration-none">お問い合わせ</a></li>
                            <li><a href="#" class="text-muted text-decoration-none">ヘルプセンター</a></li>
                            <li><a href="{{ route('guide') }}" class="text-muted text-decoration-none">ガイド</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="mb-3">会社</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('company') }}" class="text-muted text-decoration-none">会社概要</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h6 class="mb-3">法的</h6>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('terms') }}" class="text-muted text-decoration-none">利用規約</a></li>
                            <li><a href="{{ route('privacy') }}" class="text-muted text-decoration-none">プライバシー</a></li>
                            <li><a href="{{ route('commercial-law') }}" class="text-muted text-decoration-none">特定商取引法</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">&copy; {{ date('Y') }} Uknight Cloud. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 text-muted"></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong class="me-auto">成功</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="toast show bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong class="me-auto">エラー</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @stack('scripts')
</body>
</html>
