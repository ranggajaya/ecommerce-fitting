@extends('layouts.admin')

@section('title', 'Detail Penyewaan')
@section('page_title', 'Detail Penyewaan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Rental Info -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Penyewaan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">No Rental</p>
                        <p class="font-semibold text-gray-900">{{ $rental->rental_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="font-semibold text-gray-900">
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <hr class="border-gray-200">

                <h4 class="font-semibold text-gray-900">Data Pelanggan</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Nama</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Telepon</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Alamat</p>
                        <p class="font-semibold text-gray-900">{{ $rental->customer_address }}</p>
                    </div>
                </div>

                <hr class="border-gray-200">

                <h4 class="font-semibold text-gray-900">Tanggal Penyewaan</h4>
                <div class="grid grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Mulai</p>
                        <p class="font-semibold text-gray-900">{{ $rental->rental_start_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Selesai</p>
                        <p class="font-semibold text-gray-900">{{ $rental->rental_end_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Hari</p>
                        <p class="font-semibold text-gray-900">{{ $rental->total_rental_days }} hari</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Item Penyewaan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Produk</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Qty</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Harga/Hari</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($rental->items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $item->product->name }}</td>
                                <td class="px-6 py-3">{{ $item->quantity }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($item->daily_price) }}</td>
                                <td class="px-6 py-3 font-semibold">Rp {{ number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payments -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Pembayaran</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">No Pembayaran</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Jumlah</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Metode</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($rental->payments as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $payment->payment_number }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($payment->amount) }}</td>
                                <td class="px-6 py-3">{{ ucfirst($payment->payment_method) }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada pembayaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden sticky top-20">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Ringkasan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Subtotal</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($rental->subtotal) }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Deposit</p>
                    <p class="font-semibold text-gray-900">Rp {{ number_format($rental->deposit) }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Diskon</p>
                    <p class="font-semibold text-gray-900">Rp {{ number_format($rental->discount) }}</p>
                </div>

                <hr class="border-gray-200">

                <div class="bg-indigo-50 p-4 rounded-lg border-2 border-indigo-200">
                    <p class="text-sm text-gray-600 mb-1">Total Harga</p>
                    <p class="text-3xl font-bold text-indigo-600">Rp {{ number_format($rental->total_price) }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-2">Status Bayar</p>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">
                        {{ ucfirst($rental->payment_status) }}
                    </span>
                </div>

                <a href="{{ route('admin.rentals.edit', $rental->id) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                    <i class="fas fa-edit"></i> Edit Status
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
