@extends('layouts.app')

@section('title', 'Benara Attire - Rental Kebaya & Baju Adat Premium')

@section('content')

<!-- Hero Section (Only on homepage) -->
@if(!request()->has('search') && !request()->has('category'))
<section class="relative gradient-bg text-white py-24 overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="font-serif text-4xl md:text-6xl font-bold mb-4 text-shadow">
                BENARA ATTIRE
            </h1>
            <p class="text-xl md:text-2xl text-cream-100 mb-2">
                Rental Kebaya & Baju Adat
            </p>
            <p class="text-lg md:text-xl text-cream-200 mb-8 max-w-2xl mx-auto">
                Berkualitas Premium untuk Acara Spesial Anda
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#koleksi" class="inline-block bg-white text-primary-700 px-8 py-3 rounded-lg font-semibold hover:bg-cream-100 transition-colors">
                    Jelajahi Koleksi <i class="fas fa-arrow-down ml-2"></i>
                </a>
                <a href="/how-to-rent" class="inline-block bg-primary-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-800 transition-colors border border-white/30">
                    Cara Menyewa <i class="fas fa-info-circle ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Info Banner -->
<section class="bg-primary-700 text-white py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="flex items-center justify-center gap-2">
                <i class="fas fa-check-circle text-green-400"></i>
                <span class="text-sm">Kualitas Premium</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <i class="fas fa-shipping-fast text-blue-400"></i>
                <span class="text-sm">Pengiriman Seluruh Indonesia</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <i class="fas fa-shield-alt text-yellow-400"></i>
                <span class="text-sm">Deposit 100% Kembali</span>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
@if($featured->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-serif text-4xl font-bold text-primary-800 mb-2">
                <i class="fas fa-star text-primary-600"></i> Koleksi Pilihan
            </h2>
            <p class="text-gray-600">Kebaya terbaik dan paling populer dari kami</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featured as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif
@endif

<!-- All Products Section -->
<section id="koleksi" class="py-16 bg-cream-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h2 class="font-serif text-3xl font-bold text-primary-800">Semua Koleksi</h2>
                <p class="text-gray-600">{{ $products->total() }} produk tersedia</p>
            </div>
            
            <!-- Search & Filter -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Search -->
                <form action="{{ route('products.index') }}" method="GET" class="flex gap-2">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari produk..." 
                           class="px-4 py-2 border border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('products.index') }}" 
               class="px-4 py-2 rounded-lg font-semibold transition-colors {{ !request('category') ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-primary-50 border border-primary-200' }}">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
                   class="px-4 py-2 rounded-lg font-semibold transition-colors {{ request('category') == $cat->slug ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-primary-50 border border-primary-200' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
        
        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white rounded-xl">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba gunakan kata kunci lain atau lihat semua koleksi</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                    Lihat Semua Koleksi
                </a>
            </div>
        @endif
    </div>
</section>

@endsection