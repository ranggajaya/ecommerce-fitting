<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-gray-900">
                    <i class="fas fa-vest text-purple-600"></i>
                    <span>Rental<span class="text-purple-600">Kebaya</span></span>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                        Koleksi
                    </a>
                    @auth
                        <a href="{{ route('rentals.index') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                            Penyewaan Saya
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Right Menu -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-gray-700 hover:text-purple-600 transition-colors">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('measurement.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-ruler-combined w-5"></i> Data Ukuran
                            </a>
                            <a href="{{ route('rentals.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-shopping-bag w-5"></i> Penyewaan
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-user-edit w-5"></i> Profil
                            </a>
                            
                            @if(auth()->user()->is_admin)
                                <hr class="my-2">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-purple-600 hover:bg-purple-50 font-semibold">
                                    <i class="fas fa-cog w-5"></i> Admin Panel
                                </a>
                            @endif
                            
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        Daftar
                    </a>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-purple-600">
                Beranda
            </a>
            <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-purple-600">
                Koleksi
            </a>
            @auth
                <a href="{{ route('rentals.index') }}" class="block py-2 text-gray-700 hover:text-purple-600">
                    Penyewaan Saya
                </a>
                <a href="{{ route('measurement.edit') }}" class="block py-2 text-gray-700 hover:text-purple-600">
                    Data Ukuran
                </a>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700 hover:text-purple-600">
                    Profil
                </a>
            @endauth
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush