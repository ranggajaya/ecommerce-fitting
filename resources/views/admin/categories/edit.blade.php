@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit Kategori</h3>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Kategori *</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror" 
                       value="{{ $category->name }}" required>
                @error('name') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror">{{ $category->description }}</textarea>
                @error('description') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Foto Kategori</label>
                @if($category->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                    </div>
                @endif
                <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 @error('image') border-red-500 @enderror" 
                       accept="image/*">
                <p class="text-sm text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto</p>
                @error('image') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection