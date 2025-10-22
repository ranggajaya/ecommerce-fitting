@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Form Tambah Produk</h3>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Kategori *</label>
                <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('category_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Produk *</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror" 
                       value="{{ old('name') }}" placeholder="Contoh: Kebaya Modern" required>
                @error('name') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi *</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror" 
                          placeholder="Deskripsi detail produk" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Harga Sewa Harian (Rp) *</label>
                    <input type="number" name="daily_rental_price" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('daily_rental_price') border-red-500 @enderror" 
                           value="{{ old('daily_rental_price') }}" placeholder="150000" required>
                    @error('daily_rental_price') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Harga Sewa Mingguan (Rp) <span class="text-gray-500 text-xs">(Opsional)</span></label>
                    <input type="number" name="weekly_rental_price" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('weekly_rental_price') border-red-500 @enderror" 
                           value="{{ old('weekly_rental_price') }}" placeholder="900000">
                    @error('weekly_rental_price') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Main Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Foto Utama *</label>
                <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('image') border-red-500 @enderror" 
                    accept="image/*" required>
                @error('image') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Additional Images -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Foto Tambahan <span class="text-gray-500 text-xs">(Opsional, bisa lebih dari 1)</span></label>
                <input type="file" name="images[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" 
                    accept="image/*">
                <p class="text-sm text-gray-500 mt-2">Bisa pilih multiple gambar sekaligus (Ctrl/Cmd + Click)</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Stok Tersedia *</label>
                    <input type="number" name="stock_available" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" 
                           value="{{ old('stock_available', 1) }}" min="1" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Min Hari Sewa *</label>
                    <input type="number" name="min_rental_days" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" 
                           value="{{ old('min_rental_days', 1) }}" min="1" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Max Hari Sewa *</label>
                    <input type="number" name="max_rental_days" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200" 
                           value="{{ old('max_rental_days', 30) }}" min="1" required>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" 
                       class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
                       {{ old('is_featured') ? 'checked' : '' }}>
                <label class="text-sm text-gray-700">Tampilkan di Homepage (Featured)</label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection