<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .mobile-menu-button {
            display: block;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 50;
            background: rgba(31, 41, 55, 0.8);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            padding: 0.75rem;
            color: white;
            border: none;
        }

        .sidebar {
            position: fixed;
            width: 16rem;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 40;
            background-color: #1f2937;
            color: white;
        }

        .sidebar.active {
            transform: translateX(0);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        /* Navigation enhancements */
        .nav-link {
            transition: all 0.2s ease;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            transform: translateX(4px);
        }

        /* Dashboard content responsive styles */
        .summary-card {
            padding: 1rem;
            border-radius: 1rem;
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* Table responsive styles */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* For tablets and larger */
        @media (min-width: 768px) {
            .mobile-menu-button {
                display: none;
            }

            .sidebar {
                transform: translateX(0);
                position: fixed;
            }

            .main-content {
                margin-left: 16rem;
            }

            .sidebar-overlay {
                display: none !important;
            }
        }

        /* For desktop */
        @media (min-width: 1024px) {
            .chart-container {
                height: 300px;
            }
        }
    </style>
</head>

<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <x-sidebar />

    <div class="flex-1 min-h-screen flex flex-col main-content">
        <!-- Navbar -->
        <nav class="bg-white shadow-md px-4 py-3 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center space-x-2 ml-14"> <!-- ml-14 untuk kasih jarak biar ga ketiban tombol -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2" />
                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
                <span class="text-xl font-extrabold text-gray-800">{{ $title }}</span>
            </div>

            <div class="flex items-center space-x-2">
                <button onclick="openEditProfileModal()"
                    class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-800 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828L6.414 16H3v-3.414l10.586-10.586z" />
                    </svg>
                </button>

                <form id="logout-form" action="/logout" method="POST">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                        class="flex items-center bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded transition duration-200">
                        <img src="storage/assets/logout.png" alt="Logout" class="w-4 h-4">
                    </button>
                </form>
            </div>
        </nav>


        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        <footer class="bg-white shadow p-3 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Kasir Toko. All rights reserved.
        </footer>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="fixed inset-0 bg-gray-600/50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="p-4">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Profile</h3>
                    <button onclick="closeEditProfileModal()" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ auth()->user()->nama }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-3">
                        <label for="nama_toko" class="block text-sm font-medium text-gray-700 mb-1">Nama Toko</label>
                        <input type="text" id="nama_toko" name="nama_toko" value="{{ auth()->user()->nama_toko }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ auth()->user()->no_hp }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan alamat lengkap">{{ auth()->user()->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (Kosongkan
                            jika tidak ingin mengubah)</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeEditProfileModal()"
                            class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        // Modal functions
        function openEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('editProfileModal');
            if (event.target === modal) {
                closeEditProfileModal();
            }
        }

        // Handle form submission
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // You can add form validation here

            // Submit form via AJAX or normally
            this.submit();
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: "Kamu akan keluar dari aplikasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>
</body>

</html>
