<!-- Mobile menu button -->
    <button class="mobile-menu-button mb-2.5 " onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Brand/Logo Section -->
        <div class="p-5 bg-gray-800 text-white flex items-center space-x-3 border-b border-gray-700">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                    <path d="M12 8v4l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <span class="absolute -top-1 -right-1 bg-green-500 text-xs px-1.5 py-0.5 rounded-full font-bold">Kasir</span>
            </div>
            <div>
                <div class="text-xl font-bold">{{ Auth::user()->nama_toko }}</div>
                <div class="text-xs text-gray-400">Manajemen Penjualan</div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 bg-gray-900 py-5 overflow-y-auto">
            <div class="space-y-1 px-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-5 py-3 text-sm font-medium text-gray-300 hover:bg-blue-600 hover:text-white transition rounded nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2 7-7 7 7 2 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('barang.index') }}" class="flex items-center px-5 py-3 text-sm font-medium text-gray-300 hover:bg-green-600 hover:text-white transition rounded nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M20 7l-8-4-8 4v10l8 4 8-4V7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    Barang
                </a>

                <a href="{{ route('penjualan') }}" class="flex items-center px-5 py-3 text-sm font-medium text-gray-300 hover:bg-yellow-600 hover:text-white transition rounded nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4L7 13zm0 0l-2.293 2.293a1 1 0 00.707 1.707H17" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    Transaksi
                </a>

                <a href="{{ route('riwayat') }}" class="flex items-center px-5 py-3 text-sm font-medium text-gray-300 hover:bg-purple-600 hover:text-white transition rounded nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    Riwayat
                </a>
            </div>
        </nav>
    </div>