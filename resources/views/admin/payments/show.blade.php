@extends('layouts.admin')

@section('title', 'Detail Pembayaran')
@section('page_title', 'Detail Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ $payment->payment_number }}</h3>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Payment Info -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Informasi Pembayaran</p>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-3">
                        <div>
                            <p class="text-xs text-gray-600">No Penyewaan</p>
                            <a href="{{ route('admin.rentals.show', $payment->rental->id) }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                                {{ $payment->rental->rental_number }}
                            </a>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Jumlah</p>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($payment->amount) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Metode</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($payment->payment_method) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Status</p>
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full mt-1">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-1">Informasi Pelanggan</p>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-3">
                        <div>
                            <p class="text-xs text-gray-600">Nama</p>
                            <p class="font-semibold text-gray-900">{{ $payment->rental->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Email</p>
                            <p class="font-semibold text-gray-900">{{ $payment->rental->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Telepon</p>
                            <p class="font-semibold text-gray-900">{{ $payment->rental->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Tanggal Pembayaran</p>
                            <p class="font-semibold text-gray-900">{{ $payment->payment_date?->format('d/m/Y H:i') ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($payment->reference_number)
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-gray-600">Nomor Referensi</p>
                    <p class="font-semibold text-gray-900">{{ $payment->reference_number }}</p>
                </div>
            @endif

            <!-- Back Button -->
            <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection-6 py-4">
                            <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">{{ Str::limit($category->description, 50) }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                {{ $category->products->count() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors duration-200">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            Belum ada kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $categories->links() }}
    </div>
</div>
@endsection