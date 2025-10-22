@extends('layouts.app')

@section('title', 'Pembayaran #' . $rental->rental_number)

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Back Button -->
    <a href="{{ route('rentals.show', $rental->rental_number) }}" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 mb-6">
        <i class="fas fa-arrow-left"></i> Kembali ke Detail Penyewaan
    </a>
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
        <p class="text-gray-600">Penyewaan #{{ $rental->rental_number }}</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Payment Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">
                    <i class="fas fa-credit-card text-purple-600"></i> Form Pembayaran
                </h2>
                
                <form action="{{ route('payment.store', $rental->rental_number) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Jumlah Pembayaran (Rp) *
                        </label>
                        <input type="number" 
                               name="amount" 
                               value="{{ old('amount', $remainingAmount) }}"
                               min="1"
                               max="{{ $remainingAmount }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-lg font-semibold @error('amount') border-red-500 @enderror" 
                               placeholder="Masukkan jumlah"
                               required>
                        <p class="text-sm text-gray-500 mt-2">
                            Sisa yang harus dibayar: <strong class="text-orange-600">Rp {{ number_format($remainingAmount, 0, ',', '.') }}</strong>
                        </p>
                        @error('amount')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-3">
                            Metode Pembayaran *
                        </label>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="transfer" 
                                       class="peer sr-only" 
                                       {{ old('payment_method') == 'transfer' ? 'checked' : '' }}
                                       required>
                                <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all">
                                    <i class="fas fa-university text-2xl text-purple-600 mb-2"></i>
                                    <p class="font-semibold text-gray-900">Transfer Bank</p>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="e-wallet" 
                                       class="peer sr-only"
                                       {{ old('payment_method') == 'e-wallet' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all">
                                    <i class="fas fa-wallet text-2xl text-purple-600 mb-2"></i>
                                    <p class="font-semibold text-gray-900">E-Wallet</p>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="cash" 
                                       class="peer sr-only"
                                       {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all">
                                    <i class="fas fa-money-bill-wave text-2xl text-purple-600 mb-2"></i>
                                    <p class="font-semibold text-gray-900">Cash</p>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" 
                                       name="payment_method" 
                                       value="credit_card" 
                                       class="peer sr-only"
                                       {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all">
                                    <i class="fas fa-credit-card text-2xl text-purple-600 mb-2"></i>
                                    <p class="font-semibold text-gray-900">Kartu Kredit</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Reference Number -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Nomor Referensi/Bukti Transfer (Opsional)
                        </label>
                        <input type="text" 
                               name="reference_number" 
                               value="{{ old('reference_number') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('reference_number') border-red-500 @enderror" 
                               placeholder="Contoh: TRX123456789">
                        <p class="text-sm text-gray-500 mt-2">
                            Masukkan nomor referensi dari bank/e-wallet jika ada
                        </p>
                        @error('reference_number')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex gap-3">
                        <button type="submit" 
                                class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                            <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
                        </button>
                        <a href="{{ route('rentals.show', $rental->rental_number) }}" 
                           class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- Bank Account Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mt-6">
                <h3 class="font-semibold text-gray-900 mb-3">
                    <i class="fas fa-info-circle text-blue-600"></i> Informasi Rekening
                </h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span>Bank BCA</span>
                        <strong>1234567890 a.n. RentalKebaya</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Bank Mandiri</span>
                        <strong>9876543210 a.n. RentalKebaya</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>GoPay</span>
                        <strong>0812-3456-7890</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>OVO</span>
                        <strong>0812-3456-7890</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-20">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Tagihan</h2>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Nomor Penyewaan</span>
                        <span class="font-semibold">{{ $rental->rental_number }}</span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Harga</span>
                        <span class="font-semibold">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Sudah Dibayar</span>
                        <span class="font-semibold text-green-600">
                            Rp {{ number_format($rental->payments->sum('amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="pt-3 border-t border-gray-200">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-900">Sisa Pembayaran</span>
                            <span class="text-xl font-bold text-orange-600">
                                Rp {{ number_format($remainingAmount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Rental Info -->
                <div class="pt-4 border-t border-gray-200 text-sm text-gray-600 space-y-2">
                    <div class="flex justify-between">
                        <span>Periode Sewa:</span>
                        <span class="font-semibold">{{ $rental->total_rental_days }} hari</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Mulai:</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($rental->rental_start_date)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Selesai:</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($rental->rental_end_date)->format('d M Y') }}</span>
                    </div>
                </div>
                
                <!-- Info -->
                <div class="mt-6 bg-purple-50 border border-purple-200 rounded-lg p-4">
                    <p class="text-xs text-gray-700">
                        <i class="fas fa-shield-alt text-purple-600"></i>
                        Pembayaran Anda aman dan terenkripsi
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection