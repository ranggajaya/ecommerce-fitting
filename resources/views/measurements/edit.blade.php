@extends('layouts.app')

@section('title', 'Data Ukuran Badan')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Ukuran Badan</h1>
        <p class="text-gray-600">Simpan data ukuran Anda untuk memudahkan pemilihan produk yang sesuai</p>
    </div>
    
    <!-- Illustration -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 mb-8 border border-purple-100">
        <div class="flex items-center gap-4">
            <div class="bg-white rounded-full p-4">
                <i class="fas fa-ruler-combined text-3xl text-purple-600"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-1">Kenapa Penting?</h3>
                <p class="text-sm text-gray-600">
                    Data ukuran membantu kami merekomendasikan produk yang pas dengan bentuk tubuh Anda
                </p>
            </div>
        </div>
    </div>
    
    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                {{ $measurement->exists ? 'Update Data Ukuran' : 'Tambah Data Ukuran' }}
            </h3>
        </div>
        
        <!-- Form Content -->
        <form action="{{ route('measurement.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-gray-700">
                <p class="font-semibold mb-2">
                    <i class="fas fa-info-circle text-blue-600"></i> Panduan Pengukuran:
                </p>
                <ul class="space-y-1 text-xs ml-5 list-disc">
                    <li>Gunakan meteran kain untuk hasil yang lebih akurat</li>
                    <li>Ukur dalam satuan centimeter (cm)</li>
                    <li>Minta bantuan orang lain untuk hasil lebih presisi</li>
                    <li>Ukur dengan pakaian yang pas, tidak terlalu ketat atau longgar</li>
                </ul>
            </div>
            
            <!-- Measurements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Lingkar Dada -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-circle text-purple-600 text-xs"></i> Lingkar Dada (cm)
                    </label>
                    <input type="number" 
                           name="chest" 
                           value="{{ old('chest', $measurement->chest) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('chest') border-red-500 @enderror" 
                           placeholder="Contoh: 85">
                    <p class="text-xs text-gray-500 mt-1">Ukur bagian terlebar dada</p>
                    @error('chest')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Lingkar Pinggang -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-circle text-purple-600 text-xs"></i> Lingkar Pinggang (cm)
                    </label>
                    <input type="number" 
                           name="waist" 
                           value="{{ old('waist', $measurement->waist) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('waist') border-red-500 @enderror" 
                           placeholder="Contoh: 68">
                    <p class="text-xs text-gray-500 mt-1">Ukur bagian terkecil pinggang</p>
                    @error('waist')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Lingkar Pinggul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-circle text-purple-600 text-xs"></i> Lingkar Pinggul (cm)
                    </label>
                    <input type="number" 
                           name="hips" 
                           value="{{ old('hips', $measurement->hips) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('hips') border-red-500 @enderror" 
                           placeholder="Contoh: 92">
                    <p class="text-xs text-gray-500 mt-1">Ukur bagian terlebar pinggul</p>
                    @error('hips')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Lebar Bahu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-arrows-alt-h text-purple-600 text-xs"></i> Lebar Bahu (cm)
                    </label>
                    <input type="number" 
                           name="shoulder" 
                           value="{{ old('shoulder', $measurement->shoulder) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('shoulder') border-red-500 @enderror" 
                           placeholder="Contoh: 38">
                    <p class="text-xs text-gray-500 mt-1">Dari ujung bahu kiri ke kanan</p>
                    @error('shoulder')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Panjang Lengan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-arrows-alt-v text-purple-600 text-xs"></i> Panjang Lengan (cm)
                    </label>
                    <input type="number" 
                           name="sleeve_length" 
                           value="{{ old('sleeve_length', $measurement->sleeve_length) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('sleeve_length') border-red-500 @enderror" 
                           placeholder="Contoh: 58">
                    <p class="text-xs text-gray-500 mt-1">Dari bahu hingga pergelangan</p>
                    @error('sleeve_length')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Panjang Baju -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-arrows-alt-v text-purple-600 text-xs"></i> Panjang Baju (cm)
                    </label>
                    <input type="number" 
                           name="dress_length" 
                           value="{{ old('dress_length', $measurement->dress_length) }}"
                           step="0.1"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('dress_length') border-red-500 @enderror" 
                           placeholder="Contoh: 100">
                    <p class="text-xs text-gray-500 mt-1">Dari bahu hingga ujung bawah</p>
                    @error('dress_length')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <!-- Notes -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    <i class="fas fa-sticky-note text-purple-600"></i> Catatan Tambahan
                </label>
                <textarea name="notes" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('notes') border-red-500 @enderror" 
                          placeholder="Informasi tambahan tentang bentuk tubuh, preferensi, dll.">{{ old('notes', $measurement->notes) }}</textarea>
                @error('notes')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Visual Guide -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 border border-purple-100">
                <h4 class="font-semibold text-gray-900 mb-3">
                    <i class="fas fa-image text-purple-600"></i> Panduan Visual
                </h4>
                <div class="grid grid-cols-3 gap-4 text-center text-xs">
                    <div>
                        <div class="bg-white rounded-lg p-3 mb-2">
                            <i class="fas fa-user text-3xl text-purple-600"></i>
                        </div>
                        <p class="text-gray-700">Posisi berdiri tegak</p>
                    </div>
                    <div>
                        <div class="bg-white rounded-lg p-3 mb-2">
                            <i class="fas fa-ruler text-3xl text-purple-600"></i>
                        </div>
                        <p class="text-gray-700">Gunakan meteran kain</p>
                    </div>
                    <div>
                        <div class="bg-white rounded-lg p-3 mb-2">
                            <i class="fas fa-user-friends text-3xl text-purple-600"></i>
                        </div>
                        <p class="text-gray-700">Minta bantuan</p>
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition-colors font-semibold">
                    <i class="fas fa-save"></i> {{ $measurement->exists ? 'Update Data' : 'Simpan Data' }}
                </button>
                <a href="{{ url()->previous() }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
            
            @if($measurement->exists)
                <p class="text-xs text-gray-500 text-center">
                    Terakhir diupdate: {{ $measurement->updated_at->diffForHumans() }}
                </p>
            @endif
        </form>
    </div>
    
    <!-- Tips -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-check text-purple-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-sm">Akurat</p>
                    <p class="text-xs text-gray-600">Ukur dengan teliti</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-redo text-green-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-sm">Update Berkala</p>
                    <p class="text-xs text-gray-600">Periksa setiap 3-6 bulan</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-shield-alt text-blue-600"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-sm">Privasi Terjaga</p>
                    <p class="text-xs text-gray-600">Data Anda aman</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection