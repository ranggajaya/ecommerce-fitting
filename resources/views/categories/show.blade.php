@extends('layouts.app')

@section('title', $category->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Beranda</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('products.index') }}" class="hover:text-purple-600">Koleksi</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-semibold">{{ $category->name }}</span>
    </nav>
    
    <!-- Category Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl p-8 mb-8 text-white">
        <div class="flex items-center gap-3 mb-4">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" 
                     alt="{{ $category->name }}" 
                     class="w-20 h-20 rounded-lg object-cover border-2 border-white">
            @else
                <div class="w-20 h-20 rounded-lg bg-white/20 flex items-center justify-center">
                    <i class="fas fa-vest text-3xl"></i>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
                <p class="text-purple-100">{{ $products->total() }} produk tersedia</p>
            </div>
        </div>
        @if($category->description)
            <p class="text-purple-100">{{ $category->description }}</p>
        @endif
    </div>
    
    <!-- Category Filter Navigation -->
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('products.index') }}" 
           class="px-4 py-2 rounded-lg font-semibold bg-white text-gray-700 hover:bg-gray-100 transition-colors">
            Semua Kategori
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('categories.show', $cat->slug) }}" 
               class="px-4 py-2 rounded-lg font-semibold transition-colors {{ $cat->id == $category->id ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
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
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
            <p class="text-gray-600 mb-4">Kategori ini belum memiliki produk</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                Lihat Semua Koleksi
            </a>
        </div>
    @endif
</div>

@endsection