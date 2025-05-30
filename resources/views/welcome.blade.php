<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoKasir - Aplikasi Kasir Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #059669;
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        .fade-out {
            animation: fadeOut 0.8s ease-in-out;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .carousel-dot {
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            width: 20px;
            background: var(--primary);
            border-radius: 8px;
        }

        .title-word {
            animation: slideIn 0.8s ease forwards;
            opacity: 0;
            display: inline-block;
        }

        .title-word:nth-child(1) { animation-delay: 0.1s; }
        .title-word:nth-child(2) { animation-delay: 0.3s; }
        .title-word:nth-child(3) { animation-delay: 0.5s; }
        .title-word:nth-child(4) { animation-delay: 0.7s; }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-hover {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.open {
            max-height: 500px;
        }

        .carousel-image {
            object-fit: contain;
            width: 100%;
            height: 100%;
            padding: 1rem;
        }

        .carousel-slide {
            position: relative;
            height: 100%;
        }

        .carousel-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .carousel-img.active {
            opacity: 1;
        }

        .feature-section {
            scroll-margin-top: 80px;
        }

        .feature-card {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .feature-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-image {
            transition: all 0.5s ease;
            transform: scale(0.95);
        }

        .feature-image:hover {
            transform: scale(1);
        }

        /* Floating action button for mobile */
        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 100;
            transition: all 0.3s ease;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .hero-section {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            
            .hero-title {
                font-size: 2rem;
                line-height: 2.5rem;
            }
            
            .feature-reverse {
                flex-direction: column-reverse;
            }

            .carousel-container {
                height: 250px;
                margin-top: 1.5rem;
            }

            .feature-section {
                margin-bottom: 2rem !important;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-icons {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .feature-text {
                padding: 0 0.5rem;
                text-align: center;
            }
            
            .feature-text h2 {
                font-size: 1.5rem;
            }
            
            .mobile-stack {
                flex-direction: column;
            }
            
            .mobile-center {
                text-align: center;
            }
        }

        @media (max-width: 640px) {
            .title-word {
                display: block;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .hero-buttons button {
                width: 100%;
            }
            
            .carousel-container {
                height: 200px;
            }
            
            .fab {
                width: 50px;
                height: 50px;
                bottom: 1.5rem;
                right: 1.5rem;
            }
        }
        
        /* Animation for floating elements */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Pulse animation for CTA */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        /* Gradient border */
        .gradient-border {
            position: relative;
            border-radius: 1rem;
        }
        
        .gradient-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 1rem;
            z-index: -1;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        
        .gradient-border:hover::before {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Floating Action Button (Mobile Only) -->
    <a href="{{ route('login') }}" class="fab md:hidden">
        <i class="fas fa-sign-in-alt text-xl"></i>
    </a>

    <header class="flex items-center justify-around p-4 bg-white shadow-md sticky top-0 z-50 px-4 sm:px-6 lg:px-8">
        <div class="text-2xl font-bold text-gray-800 flex items-center">
            <span class="text-blue-600">Toko</span><span class="text-emerald-600">Kasir</span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="space-x-6 hidden md:block">
            <a href="#awal" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Home</a>
            <a href="#fitur" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Fitur</a>
            <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Kontak</a>
        </nav>

        <div class="flex items-center space-x-4">
            <button class="hidden md:block bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-700 hover:to-emerald-700 text-white px-6 py-2 rounded-lg transition-all duration-300 btn-hover shadow-md transform hover:scale-105">
                <a href="{{ route('login') }}">Masuk</a>
            </button>
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu bg-white shadow-md md:hidden">
        <div class="px-4 py-3 space-y-3">
            <a href="#awal" class="block text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Home</a>
            <a href="#fitur" class="block text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Fitur</a>
            <a href="#kontak" class="block text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Kontak</a>
            <button class="w-full bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-700 hover:to-emerald-700 text-white px-4 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                Masuk
            </button>
        </div>
    </div>

    <section id="awal" class="container mx-auto flex flex-col md:flex-row items-center gap-8 lg:gap-12 py-8 sm:py-12 px-4 sm:px-6 lg:py-16 hero-section">
        <!-- Left Content -->
        <div class="flex-1 text-center md:text-left px-2 sm:px-4 mobile-center md:text-left">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-800 mb-4 leading-tight hero-title">
                <span class="title-word">Aplikasi</span>
                <span class="title-word text-gradient">Kasir</span>
                <span class="title-word">Modern</span>
                <span class="title-word">untuk</span>
                <span class="title-word text-gradient">Bisnis Anda</span>
            </h1>
            <p class="text-gray-600 mb-6 text-base sm:text-lg animate__animated animate__fadeIn animate__delay-1s max-w-lg mx-auto md:mx-0">
                Solusi lengkap untuk mengelola transaksi, inventori, dan laporan keuangan bisnis Anda dengan mudah dan efisien.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate__animated animate__fadeIn animate__delay-1s hero-buttons">
                <button class="bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-700 hover:to-emerald-700 text-white px-6 py-3 rounded-lg transition-all duration-300 btn-hover shadow-lg font-medium pulse-animation">
                    Coba Gratis
                </button>
                <button class="border-2 border-gray-200 hover:border-emerald-500 text-gray-700 hover:text-emerald-600 px-6 py-3 rounded-lg transition-all duration-300 btn-hover font-medium">
                    Lihat Demo
                </button>
            </div>

            <div class="mt-6 sm:mt-8 flex flex-wrap justify-center md:justify-start gap-3 sm:gap-4 animate__animated animate__fadeIn animate__delay-1s mobile-stack">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-2 rounded-full mr-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-gray-600 text-sm sm:text-base">Gratis Trial</span>
                </div>
                <div class="flex items-center">
                    <div class="bg-emerald-100 p-2 rounded-full mr-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-gray-600 text-sm sm:text-base">Support 24/7</span>
                </div>
                <div class="flex items-center">
                    <div class="bg-purple-100 p-2 rounded-full mr-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-gray-600 text-sm sm:text-base">100% Cloud</span>
                </div>
            </div>
        </div>

        <!-- Carousel Right -->
        <div class="w-full md:w-3/5 lg:w-1/2 px-0 sm:px-4">
            <div class="mx-auto carousel-container floating">
                <div class="overflow-hidden rounded-xl shadow-xl h-64 sm:h-80 md:h-96 relative bg-gray-50 border border-gray-100 gradient-border">
                    <div id="carousel-slide" class="carousel-slide h-full w-full">
                        <img src="storage/assets/dashboard.png" class="carousel-img active" alt="Dashboard">
                        <img src="storage/assets/formbayar.png" class="carousel-img" alt="Form Bayar">
                        <img src="storage/assets/riwayat.png" class="carousel-img" alt="Riwayat Transaksi">
                    </div>

                    <!-- Navigation dots -->
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                        <button onclick="changeSlide(0)" class="carousel-dot w-3 h-3 bg-gray-300 rounded-full active"></button>
                        <button onclick="changeSlide(1)" class="carousel-dot w-3 h-3 bg-gray-300 rounded-full"></button>
                        <button onclick="changeSlide(2)" class="carousel-dot w-3 h-3 bg-gray-300 rounded-full"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gradient-to-r from-blue-50 to-emerald-50 py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4">
                    <div class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">500+</div>
                    <div class="text-gray-600 text-sm sm:text-base">Pengguna Aktif</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl sm:text-4xl font-bold text-emerald-600 mb-2">10K+</div>
                    <div class="text-gray-600 text-sm sm:text-base">Transaksi/Hari</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl sm:text-4xl font-bold text-purple-600 mb-2">99.9%</div>
                    <div class="text-gray-600 text-sm sm:text-base">Uptime</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl sm:text-4xl font-bold text-amber-600 mb-2">24/7</div>
                    <div class="text-gray-600 text-sm sm:text-base">Support</div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="container mx-auto py-12 sm:py-16 px-4 sm:px-6 lg:py-20">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 text-center mb-8 sm:mb-12">
            Fitur Unggulan <span class="text-gradient">TokoKasir</span>
        </h2>
        <p class="text-gray-600 text-center mb-8 sm:mb-12 max-w-2xl mx-auto text-sm sm:text-base">
            TokoKasir hadir dengan berbagai fitur canggih untuk membantu Anda mengelola bisnis dengan lebih efisien.
        </p>

        <!-- Feature 1 -->
        <div class="feature-section mb-16 sm:mb-20">
            <div class="flex flex-col md:flex-row items-center gap-6 lg:gap-8">
                <!-- Image Left -->
                <div class="w-full md:w-1/2 feature-card">
                    <div class="rounded-xl shadow-lg overflow-hidden bg-gray-50 border border-gray-100 p-2 sm:p-4 gradient-border">
                        <img src="storage/assets/dashboard.png" alt="Dashboard Analytics" class="feature-image w-full h-auto rounded-lg">
                    </div>
                </div>

                <!-- Text Right -->
                <div class="w-full md:w-1/2 feature-card feature-text">
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">
                            <span class="text-gradient">Analisis Bisnis</span> Secara Real-time
                        </h2>
                        <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">
                            Pantau perkembangan bisnis Anda dengan dashboard analitik yang lengkap dan mudah dipahami.
                            Dapatkan insight penjualan, produk terlaris, dan performa kasir secara real-time.
                        </p>
                        <ul class="space-y-2 sm:space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Laporan penjualan harian, mingguan, dan bulanan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Visualisasi data dengan grafik interaktif</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-emerald-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Laporan barang paling laris</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 2 (Reversed) -->
        <div class="feature-section mb-16 sm:mb-20">
            <div class="flex flex-col md:flex-row feature-reverse items-center gap-6 lg:gap-8">
                <!-- Text Left -->
                <div class="w-full md:w-1/2 feature-card feature-text">
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">
                            <span class="text-gradient">Catat Penjualan</span> Lebih Cepat & Efisien
                        </h2>
                        <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">
                            Memudahkan kasir dalam mencatat transaksi penjualan tanpa ribet.
                            Dengan fitur multi-item, total harga otomatis, dan form pembayaran langsung terintegrasi, proses
                            transaksi jadi lebih cepat, akurat, dan efisien.
                        </p>
                        <ul class="space-y-2 sm:space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Input jumlah bayaran dengan cepat</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Hitung total belanja dan kembalian otomatis</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Konfirmasi transaksi cepat</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Image Right -->
                <div class="w-full md:w-1/2 feature-card">
                    <div class="rounded-xl shadow-lg overflow-hidden bg-gray-50 border border-gray-100 p-2 sm:p-4 gradient-border">
                        <img src="storage/assets/formbayar.png" alt="Inventory Management" class="feature-image w-full h-auto rounded-lg">
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 3 -->
        <div class="feature-section">
            <div class="flex flex-col md:flex-row items-center gap-6 lg:gap-8">
                <!-- Image Left -->
                <div class="w-full md:w-1/2 feature-card">
                    <div class="rounded-xl shadow-lg overflow-hidden bg-gray-50 border border-gray-100 p-2 sm:p-4 gradient-border">
                        <img src="storage/assets/riwayat.png" alt="Multi-user Access" class="feature-image w-full h-auto rounded-lg">
                    </div>
                </div>

                <!-- Text Right -->
                <div class="w-full md:w-1/2 feature-card feature-text">
                    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">
                            <span class="text-gradient">Kelola Stok Barang</span> dengan Mudah
                        </h2>
                        <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">
                            Memudahkan pemilik usaha dan kasir dalam mengatur data barang yang tersedia di toko.
                            Tambah, edit, atau hapus data barang bisa dilakukan kapan saja hanya dalam beberapa klik.
                        </p>
                        <ul class="space-y-2 sm:space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-purple-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Tambah & update data barang tanpa ribet</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-purple-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Cek stok barang secara real-time.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-purple-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 text-sm sm:text-base">Data barang tersimpan aman & rapi.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-8 sm:mb-12">
                Apa Kata <span class="text-gradient">Pengguna Kami?</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                            <span class="text-blue-600 text-xl font-bold">A</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Fauzi</h4>
                            <p class="text-gray-500 text-sm">Pemilik Toko Serba Ada</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm sm:text-base">
                        "Sejak menggunakan TokoKasir, pencatatan transaksi jadi lebih cepat dan laporan keuangan lebih rapi. Sangat membantu untuk bisnis saya!"
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mr-4">
                            <span class="text-emerald-600 text-xl font-bold">S</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Siti Rahayu</h4>
                            <p class="text-gray-500 text-sm">Manajer Minimarket</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm sm:text-base">
                        "Aplikasi ini sangat mudah digunakan oleh kasir kami. Fitur stok otomatis sangat membantu mengurangi kesalahan pencatatan manual."
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                            <span class="text-purple-600 text-xl font-bold">B</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                            <p class="text-gray-500 text-sm">Pemilik Warung Sembako</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm sm:text-base">
                        "Dengan harga terjangkau, dapat fitur lengkap. Supportnya juga responsif banget. Recommended untuk UKM!"
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-16 bg-gradient-to-r from-blue-600 to-emerald-600 text-white">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4 sm:mb-6">Siap Meningkatkan Bisnis Anda?</h2>
            <p class="text-blue-100 mb-6 sm:mb-8 max-w-2xl mx-auto text-sm sm:text-base">
                Bergabunglah dengan ratusan bisnis yang telah mempercayakan manajemen toko mereka pada TokoKasir.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Mulai Sekarang - Gratis 14 Hari
                </button>
                <button class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                    Hubungi Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-12 sm:py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-4xl mx-auto contact-grid">
                <!-- Contact Form -->
                <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-3 sm:mb-4">Kirim Pesan</h3>
                    <form class="space-y-3 sm:space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Anda</label>
                            <input type="text" id="name" class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea id="message" rows="4" class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-700 hover:to-emerald-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors duration-300 btn-hover font-medium text-sm sm:text-base">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-3 sm:mb-4">Informasi Kontak</h3>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-full mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-phone-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm sm:text-base">Telepon</h4>
                                <p class="text-gray-600 text-sm sm:text-base">+62 812 3456 7890</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-emerald-100 p-2 rounded-full mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-emerald-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm sm:text-base">Email</h4>
                                <p class="text-gray-600 text-sm sm:text-base">support@tokokasir.app</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 p-2 rounded-full mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm sm:text-base">Alamat</h4>
                                <p class="text-gray-600 text-sm sm:text-base">Jl. Teknologi No. 123, Jakarta Selatan, Indonesia</p>
                            </div>
                        </div>

                        <div class="pt-2 sm:pt-4">
                            <h4 class="font-medium text-gray-800 mb-1 sm:mb-2 text-sm sm:text-base">Jam Operasional</h4>
                            <p class="text-gray-600 text-sm sm:text-base">Senin - Jumat: 08:00 - 17:00 WIB</p>
                            <p class="text-gray-600 text-sm sm:text-base">Sabtu: 09:00 - 14:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8 sm:py-12">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <span class="text-blue-400">Toko</span><span class="text-emerald-400">Kasir</span>
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Solusi aplikasi kasir modern untuk bisnis retail dan UMKM di Indonesia.
                    </p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-3">Perusahaan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-3">Produk</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-3">Dukungan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        © 2025 TokoKasir. All rights reserved.
                    </p>
                    <div class="flex space-x-4 footer-icons">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-img');
        const dots = document.querySelectorAll('.carousel-dot');
        let slideInterval;

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        function changeSlide(index) {
            currentIndex = index;
            updateCarousel();
            resetInterval();
        }

        function updateCarousel() {
            // Update slides
            slides.forEach((slide, i) => {
                if (i === currentIndex) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });

            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        }

        // Initialize
        updateCarousel();
        slideInterval = setInterval(nextSlide, 5000);

        // Add hover effect to dots
        dots.forEach(dot => {
            dot.addEventListener('mouseenter', () => {
                dot.style.transform = 'scale(1.3)';
            });
            dot.addEventListener('mouseleave', () => {
                dot.style.transform = 'scale(1)';
            });
        });
        
        // Intersection Observer for feature cards
        const featureCards = document.querySelectorAll('.feature-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });

        featureCards.forEach(card => {
            observer.observe(card);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Close mobile menu if open
                    mobileMenu.classList.remove('open');
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

</body>

</html>