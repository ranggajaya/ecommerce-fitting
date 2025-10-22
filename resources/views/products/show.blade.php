@extends('layouts.app')

@section('title', $product->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Beranda</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('products.index') }}" class="hover:text-purple-600">Koleksi</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-purple-600">
            {{ $product->category->name }}
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-semibold">{{ $product->name }}</span>
    </nav>
    
    <!-- Product Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
        
        <!-- Images -->
        <div>
            <!-- Main Image -->
            <div class="aspect-[3/4] rounded-xl overflow-hidden bg-gray-100 mb-4">
                <img id="main-image" 
                     src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            </div>
            
            <!-- Thumbnails -->
            @if($product->images)
                <div class="grid grid-cols-4 gap-2">
                    <button onclick="changeImage('{{ asset('storage/' . $product->image) }}')" 
                            class="aspect-square rounded-lg overflow-hidden border-2 border-purple-600">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                    </button>
                    @foreach(json_decode($product->images) as $img)
                        <button onclick="changeImage('{{ asset('storage/' . $img) }}')" 
                                class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-purple-600">
                            <img src="{{ asset('storage/' . $img) }}" alt="Thumbnail" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Info -->
        <div>
            <!-- Category & Featured Badge -->
            <div class="flex items-center gap-2 mb-3">
                <span class="bg-purple-100 text-purple-600 text-sm font-semibold px-3 py-1 rounded-full">
                    {{ $product->category->name }}
                </span>
                @if($product->is_featured)
                    <span class="bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-star"></i> Featured
                    </span>
                @endif
            </div>
            
            <!-- Name -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            
            <!-- Price -->
            <div class="bg-purple-50 rounded-xl p-6 mb-6">
                <p class="text-sm text-gray-600 mb-1">Harga Sewa</p>
                <div class="flex items-baseline gap-3">
                    <span class="text-4xl font-bold text-purple-600">
                        Rp {{ number_format($product->daily_rental_price, 0, ',', '.') }}
                    </span>
                    <span class="text-gray-600">/hari</span>
                </div>
                @if($product->weekly_rental_price)
                    <div class="mt-3 pt-3 border-t border-purple-200">
                        <span class="text-gray-600">Paket Mingguan: </span>
                        <span class="text-xl font-bold text-purple-600">
                            Rp {{ number_format($product->weekly_rental_price, 0, ',', '.') }}
                        </span>
                    </div>
                @endif
            </div>
            
            <!-- Stock & Rental Days -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <p class="text-xs text-gray-500 mb-1">Stok</p>
                    <p class="text-lg font-bold text-gray-900">{{ $product->stock_available }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <p class="text-xs text-gray-500 mb-1">Min. Sewa</p>
                    <p class="text-lg font-bold text-gray-900">{{ $product->min_rental_days }} hari</p>
                </div>
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <p class="text-xs text-gray-500 mb-1">Max. Sewa</p>
                    <p class="text-lg font-bold text-gray-900">{{ $product->max_rental_days }} hari</p>
                </div>
            </div>
            
            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Produk</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>
            
            <!-- Action Buttons -->
            @auth
                @if($product->stock_available > 0)
                    <form action="{{ route('rental.create') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-lg font-semibold hover:bg-purple-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-bag"></i>
                            Sewa Sekarang
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-300 text-gray-600 py-4 rounded-lg font-semibold cursor-not-allowed">
                        <i class="fas fa-times-circle"></i> Stok Habis
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="block w-full bg-purple-600 text-white py-4 rounded-lg font-semibold hover:bg-purple-700 transition-colors text-center">
                    <i class="fas fa-sign-in-alt"></i> Login untuk Menyewa
                </a>
            @endauth
            
            <!-- Info Cards -->
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <i class="fas fa-check-circle text-blue-600 text-xl mb-2"></i>
                    <p class="text-sm font-semibold text-gray-900">Kualitas Premium</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <i class="fas fa-truck text-green-600 text-xl mb-2"></i>
                    <p class="text-sm font-semibold text-gray-900">Gratis Antar</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4">
                    <i class="fas fa-shield-alt text-yellow-600 text-xl mb-2"></i>
                    <p class="text-sm font-semibold text-gray-900">Asuransi Rusak</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <i class="fas fa-headset text-purple-600 text-xl mb-2"></i>
                    <p class="text-sm font-semibold text-gray-900">Customer Care</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="border-t border-gray-200 pt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Serupa</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                @include('components.product-card', ['product' => $related])
            @endforeach
        </div>
    </section>
    @endif
</div>

@push('scripts')
<script>
    function changeImage(src) {
        document.getElementById('main-image').src = src;
    }
</script>
@endpush

@endsection