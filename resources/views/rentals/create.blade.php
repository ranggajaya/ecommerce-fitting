@extends('layouts.app')

@section('title', 'Checkout Penyewaan')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout Penyewaan</h1>
        <p class="text-gray-600">Lengkapi data di bawah untuk melanjutkan penyewaan</p>
    </div>
    
    <form action="{{ route('rental.checkout') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column - Form -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Rental Dates -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar-alt text-purple-600"></i> Tanggal Sewa
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Tanggal Mulai *
                            </label>
                            <input type="date" 
                                   name="rental_start_date" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ old('rental_start_date') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('rental_start_date') border-red-500 @enderror" 
                                   required>
                            @error('rental_start_date')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Tanggal Selesai *
                            </label>
                            <input type="date" 
                                   name="rental_end_date" 
                                   min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                                   value="{{ old('rental_end_date') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('rental_end_date') border-red-500 @enderror" 
                                   required>
                            @error('rental_end_date')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Customer Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-user text-purple-600"></i> Data Penyewa
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Lengkap *
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   value="{{ old('customer_name', auth()->user()->name) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('customer_name') border-red-500 @enderror" 
                                   required>
                            @error('customer_name')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Nomor Telepon *
                            </label>
                            <input type="tel" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone') }}"
                                   placeholder="08123456789"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror" 
                                   required>
                            @error('customer_phone')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Alamat Lengkap *
                            </label>
                            <textarea name="customer_address" 
                                      rows="3"
                                      placeholder="Jalan, Kelurahan, Kecamatan, Kota, Provinsi"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('customer_address') border-red-500 @enderror" 
                                      required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-20">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-shopping-cart text-purple-600"></i> Ringkasan Pesanan
                    </h2>
                    
                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @php $subtotal = 0; @endphp
                        @foreach($cart as $item)
                            @php
                                $product = \App\Models\Product::find($item['product_id']);
                                $itemTotal = $product->daily_rental_price * ($item['quantity'] ?? 1);
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="flex gap-3 pb-4 border-b border-gray-200">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900 text-sm">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-600">Qty: {{ $item['quantity'] ?? 1 }}</p>
                                    <p class="text-sm font-semibold text-purple-600 mt-1">
                                        Rp {{ number_format($itemTotal, 0, ',', '.') }}/hari
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Price Summary -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Durasi Sewa</span>
                            <span class="font-semibold" id="rental-days">- hari</span>
                        </div>
                        <div class="pt-3 border-t border-gray-200">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Total</span>
                                <span class="text-xl font-bold text-purple-600" id="total-price">Rp 0</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                        <i class="fas fa-check-circle"></i> Proses Penyewaan
                    </button>
                    
                    <p class="text-xs text-gray-500 text-center mt-3">
                        Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const subtotal = {{ $subtotal }};
    const startDateInput = document.querySelector('input[name="rental_start_date"]');
    const endDateInput = document.querySelector('input[name="rental_end_date"]');
    
    function calculateTotal() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        
        if (startDate && endDate && endDate > startDate) {
            const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            const total = subtotal * days;
            
            document.getElementById('rental-days').textContent = days + ' hari';
            document.getElementById('total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    }
    
    startDateInput.addEventListener('change', calculateTotal);
    endDateInput.addEventListener('change', calculateTotal);
</script>
@endpush

@endsection