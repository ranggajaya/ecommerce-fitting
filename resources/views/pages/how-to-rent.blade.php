@extends('layouts.app')

@section('title', 'Cara Menyewa - Benara Attire')

@section('content')

<div class="bg-gradient-to-b from-cream-100 to-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-serif text-4xl md:text-5xl font-bold text-primary-800 mb-4">
                How to Rent
            </h1>
            <p class="text-gray-600 text-lg">
                Panduan lengkap untuk menyewa kebaya di Benara Attire
            </p>
        </div>
        
        <!-- Steps -->
        <div class="space-y-6">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        1
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Cek Ketersediaan Kebaya
                        </h3>
                        <p class="text-gray-600">
                            Setelah mengecek ketersediaan, isi format booking yang tersedia.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        2
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Fix Booking & Pembayaran
                        </h3>
                        <p class="text-gray-600">
                            Setelah booking fix, lakukan pembayaran DP / uang muka.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        3
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Pelunasan + Deposit + Identitas
                        </h3>
                        <p class="text-gray-600 mb-3">
                            Setelah itu, lakukan pelunasan pembayaran deposit + ongkos kirim (jika dikirim). Kirimkan foto identitas (KTP/SIM/KTM).
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 4 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        4
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Pengiriman Area Bekasi
                        </h3>
                        <p class="text-gray-600">
                            Pengiriman untuk Area Bekasi dan sekitarnya bisa ambil sendiri atau kirim via GoSend/jasa instan.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 5 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        5
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Pengiriman Luar Kota
                        </h3>
                        <p class="text-gray-600 mb-2">
                            Pengiriman untuk luar kota selain Bekasi dan sekitarnya akan dilakukan pengiriman H-3 sebelum acara.
                        </p>
                        <p class="text-gray-600 text-sm italic">
                            Wajib menggunakan layanan ekspedisi Nextday (seperti layanan nextday dari Paxel, JNT, TIKI, dsb)
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 6 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        6
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Konfirmasi Penerimaan
                        </h3>
                        <p class="text-gray-600">
                            Pastikan alamat jelas dan aktif menerima paket.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Step 7 -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-600 text-white rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 font-serif text-xl font-bold">
                        7
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-semibold text-primary-800 mb-2">
                            Biaya Kirim
                        </h3>
                        <p class="text-gray-600">
                            Biaya kirim ditanggung penyewa dan tidak dihitung sebagai masa sewa.
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- CTA -->
        <div class="mt-12 text-center">
            <a href="{{ route('products.index') }}" class="inline-block bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors font-semibold text-lg">
                <i class="fas fa-search mr-2"></i> Mulai Pilih Kebaya
            </a>
        </div>
        
    </div>
</div>

@endsection