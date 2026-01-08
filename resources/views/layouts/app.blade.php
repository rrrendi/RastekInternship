<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RastekInternship Recruitment')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Animasi untuk mobile menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .mobile-menu.active {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">RI</span>
                        </div>
                        <span class="ml-3 text-lg sm:text-xl font-bold text-gray-900">RastekInternship</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition">
                        Beranda
                    </a>
                    <a href="{{ route('applicant.register') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition">
                        Daftar
                    </a>
                    <a href="{{ route('applicant.check-status') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition">
                        Cek Status
                    </a>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition">
                            Login Admin
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-button" class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:bg-green-50 hover:text-green-600 px-3 py-2 rounded-md text-base font-medium transition">
                    Beranda
                </a>
                <a href="{{ route('applicant.register') }}" class="block text-gray-700 hover:bg-green-50 hover:text-green-600 px-3 py-2 rounded-md text-base font-medium transition">
                    Daftar
                </a>
                <a href="{{ route('applicant.check-status') }}" class="block text-gray-700 hover:bg-green-50 hover:text-green-600 px-3 py-2 rounded-md text-base font-medium transition">
                    Cek Status
                </a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block bg-green-600 text-white px-3 py-2 rounded-md text-base font-medium hover:bg-green-700 transition">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:bg-green-50 hover:text-green-600 px-3 py-2 rounded-md text-base font-medium transition">
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    <main class="py-6 sm:py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-4">
            <div class="text-center text-gray-600">
                <p class="mb-2 text-sm sm:text-base">&copy; {{ date('Y') }} RastekInternship. Semua hak dilindungi.</p>
                <p class="text-xs sm:text-sm">Sistem Rekrutmen dan Pendaftaran Online</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript untuk Mobile Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            menuButton.addEventListener('click', function() {
                // Toggle mobile menu
                mobileMenu.classList.toggle('active');
                
                // Toggle icons
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = menuButton.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInside && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            // Close menu when clicking a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>