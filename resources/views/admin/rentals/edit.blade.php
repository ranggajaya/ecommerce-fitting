@extends('layouts.admin')

@section('title', 'Edit Penyewaan')
@section('page_title', 'Ubah Status Penyewaan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Ubah Status Penyewaan</h3>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Info -->
            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div>
                    <p class="text-sm text-gray-600">No Rental</p>
                    <p class="font-semibold text-gray-900">{{ $rental->rental_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Customer</p>
                    <p class="font-semibold text-gray-900">{{ $rental->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status Bayar</p>
                    <p class="font-semibold text-gray-900">{{ ucfirst($rental->payment_status) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Harga</p>
                    <p class="font-semibold text-gray-900">Rp {{ number_format($rental->total_price) }}</p>
                </div>
            </div>

            <!-- Status Selection -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Status Penyewaan *</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('status') border-red-500 @enderror" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $rental->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="ready_to_pickup" {{ $rental->status == 'ready_to_pickup' ? 'selected' : '' }}>Ready to Pickup</option>
                    <option value="picked_up" {{ $rental->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                    <option value="returned" {{ $rental->status == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                    <i class="fas fa-save"></i> Update Status
                </button>
                <a href="{{ route('admin.rentals.index') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection