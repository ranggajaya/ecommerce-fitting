@extends('layouts.app')

@section('title', 'Detail Penyewaan #' . $rental->rental_number)

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Back Button -->
    <a href="{{ route('rentals.index') }}" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 mb-6">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Penyewaan
    </a>
    
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $rental->rental_number }}</h1>
                <p class="text-gray-600">
                    <i class="fas fa-calendar"></i> 
                    Dibuat: {{ $rental->created_at->format('d M Y, H:i') }}
                </p>
            </div>
            
            <!-- Status Badges -->
            <div class="flex gap-2">
                @php
                    $statusConfig = [
                        'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Menunggu Konfirmasi'],
                        'confirmed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'label' => 'Terkonfirmasi'],
                        'active' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Sedang Berlangsung'],
                        'completed' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => 'Selesai'],
                        'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Dibatalkan'],
                    ];
                    $status = $statusConfig[$rental->status] ?? $statusConfig['pending'];
                    
                    $paymentConfig = [
                        'pending' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'label' => 'Belum Bayar'],
                        'partial' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Pembayaran Sebagian'],
                        'paid' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Lunas'],
                        'refund' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'label' => 'Refund'],
                    ];
                    $payment = $paymentConfig[$rental->payment_status] ?? $paymentConfig['pending'];
                @endphp
                
                <span class="{{ $status['bg'] }} {{ $status['text'] }} text-sm font-semibold px-4 py-2 rounded-lg">
                    {{ $status['label'] }}
                </span>
                <span class="{{ $payment['bg'] }} {{ $payment['text'] }} text-sm font-semibold px-4 py-2 rounded-lg">
                    {{ $payment['label'] }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Rental Period -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-calendar-alt text-purple-600"></i> Periode Sewa
                </h2>
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Mulai</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ \Carbon\Carbon::parse($rental->rental_start_date)->format('d M Y') }}
                        </p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Durasi</p>
                        <p class="text-lg font-bold text-purple-600">
                            {{ $rental->total_rental_days }} hari
                        </p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Selesai</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Rented Items -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-box text-purple-600"></i> Produk yang Disewa
                </h2>
                
                <div class="space-y-4">
                    @foreach($rental->items as $item)
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-lg">
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-20 h-20 rounded-lg object-cover">
                            
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $item->product->category->name }}</p>
                                
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="text-gray-600">Qty: <strong>{{ $item->quantity }}</strong></span>
                                    <span class="text-gray-600">
                                        Harga: <strong>Rp {{ number_format($item->daily_price, 0, ',', '.') }}/hari</strong>
                                    </span>
                                </div>
                                
                                @if($item->size)
                                    <p class="text-sm text-gray-600 mt-2">Ukuran: {{ $item->size }}</p>
                                @endif
                                
                                @if($item->special_request)
                                    <p class="text-sm text-gray-600 mt-1">Catatan: {{ $item->special_request }}</p>
                                @endif
                            </div>
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-600 mb-1">Subtotal</p>
                                <p class="text-lg font-bold text-purple-600">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Customer Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-user text-purple-600"></i> Data Penyewa
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Nama</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Email</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Telepon</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Alamat</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_address }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Payment History -->
            @if($rental->payments->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-receipt text-purple-600"></i> Riwayat Pembayaran
                </h2>
                
                <div class="space-y-3">
                    @foreach($rental->payments as $payment)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $payment->payment_number }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y, H:i') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Metode: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                                </p>
                                @if($payment->reference_number)
                                    <p class="text-sm text-gray-600">Ref: {{ $payment->reference_number }}</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-green-600">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </p>
                                <span class="inline-block mt-1 bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-20">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($rental->subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($rental->deposit)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Deposit</span>
                            <span class="font-semibold">Rp {{ number_format($rental->deposit, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    
                    @if($rental->discount)
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Diskon</span>
                            <span class="font-semibold">- Rp {{ number_format($rental->discount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    
                    <div class="pt-3 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold text-gray-900">Total</span>
                            <span class="text-xl font-bold text-purple-600">
                                Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    
                    @php
                        $totalPaid = $rental->payments->sum('amount');
                        $remaining = $rental->total_price - $totalPaid;
                    @endphp
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Sudah Dibayar</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($remaining > 0)
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-900">Sisa</span>
                            <span class="text-lg font-bold text-orange-600">
                                Rp {{ number_format($remaining, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Action Button -->
                @if($rental->payment_status !== 'paid' && $rental->status !== 'cancelled')
                    <a href="{{ route('payment.show', $rental->rental_number) }}" 
                       class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors text-center">
                        <i class="fas fa-money-bill-wave"></i> Lakukan Pembayaran
                    </a>
                @elseif($rental->payment_status === 'paid')
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-center">
                        <i class="fas fa-check-circle"></i> Pembayaran Lunas
                    </div>
                @endif
                
                <!-- Notes -->
                @if($rental->notes)
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm font-semibold text-gray-900 mb-1">Catatan Admin:</p>
                        <p class="text-sm text-gray-700">{{ $rental->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection