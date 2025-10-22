@extends('layouts.app')

@section('title', 'Penyewaan Saya')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Penyewaan Saya</h1>
        <p class="text-gray-600">Kelola dan pantau status penyewaan Anda</p>
    </div>
    
    @if($rentals->count() > 0)
        <!-- Rentals List -->
        <div class="space-y-4">
            @foreach($rentals as $rental)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex flex-col lg:flex-row justify-between gap-4">
                            
                            <!-- Left Info -->
                            <div class="flex-1">
                                <!-- Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-lg mb-1">
                                            {{ $rental->rental_number }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-calendar text-purple-600"></i>
                                            Dibuat: {{ $rental->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    
                                    <!-- Status Badges -->
                                    <div class="flex flex-col gap-2 items-end">
                                        @php
                                            $statusConfig = [
                                                'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Pending'],
                                                'confirmed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'label' => 'Terkonfirmasi'],
                                                'active' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Aktif'],
                                                'completed' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => 'Selesai'],
                                                'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Dibatalkan'],
                                            ];
                                            $status = $statusConfig[$rental->status] ?? $statusConfig['pending'];
                                            
                                            $paymentConfig = [
                                                'pending' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'label' => 'Belum Bayar'],
                                                'partial' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'DP'],
                                                'paid' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Lunas'],
                                                'refund' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'label' => 'Refund'],
                                            ];
                                            $payment = $paymentConfig[$rental->payment_status] ?? $paymentConfig['pending'];
                                        @endphp
                                        
                                        <span class="{{ $status['bg'] }} {{ $status['text'] }} text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $status['label'] }}
                                        </span>
                                        <span class="{{ $payment['bg'] }} {{ $payment['text'] }} text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $payment['label'] }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Rental Details -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Tanggal Mulai</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($rental->rental_start_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Tanggal Selesai</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Durasi</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $rental->total_rental_days }} hari
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Total Bayar</p>
                                        <p class="text-sm font-semibold text-purple-600">
                                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Items Preview -->
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-xs text-gray-500">Produk:</p>
                                    @foreach($rental->items->take(3) as $item)
                                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                            {{ $item->product->name }}
                                        </span>
                                    @endforeach
                                    @if($rental->items->count() > 3)
                                        <span class="text-xs text-gray-500">
                                            +{{ $rental->items->count() - 3 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex flex-row lg:flex-col gap-2 justify-end">
                                <a href="{{ route('rentals.show', $rental->rental_number) }}" 
                                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                
                                @if($rental->payment_status !== 'paid' && $rental->status !== 'cancelled')
                                    <a href="{{ route('payment.show', $rental->rental_number) }}" 
                                       class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                        <i class="fas fa-money-bill"></i> Bayar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $rentals->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Penyewaan</h3>
            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat penyewaan</p>
            <a href="{{ route('products.index') }}" 
               class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors font-semibold">
                <i class="fas fa-search"></i> Jelajahi Produk
            </a>
        </div>
    @endif
</div>

@endsection