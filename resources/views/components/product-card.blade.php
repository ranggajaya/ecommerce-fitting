{{-- Usage: @include('components.product-card', ['product' => $product]) --}}

<div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover border border-primary-100">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <!-- Image -->
        <div class="relative aspect-[3/4] overflow-hidden bg-gray-100">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
            
            <!-- Featured Badge -->
            @if($product->is_featured)
                <div class="absolute top-3 left-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    <i class="fas fa-star"></i> Featured
                </div>
            @endif
            
            <!-- Stock Badge -->
            <div class="absolute top-3 right-3">
                @if($product->stock_available > 0)
                    <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Tersedia
                    </span>
                @else
                    <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Habis
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-4">
            <!-- Category -->
            <p class="text-xs text-primary-600 font-semibold mb-1">
                {{ $product->category->name }}
            </p>
            
            <!-- Name -->
            <h3 class="font-serif font-semibold text-gray-900 mb-2 line-clamp-2">
                {{ $product->name }}
            </h3>
            
            <!-- Description -->
            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                {{ $product->description }}
            </p>
            
            <!-- Price -->
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Mulai dari</p>
                    <p class="text-lg font-bold text-primary-600">
                        Rp {{ number_format($product->daily_rental_price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500">/hari</p>
                </div>
                
                <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors text-sm font-semibold">
                    Lihat Detail
                </button>
            </div>
        </div>
    </a>
</div>