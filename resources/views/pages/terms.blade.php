@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan - Benara Attire')

@section('content')

<div class="bg-gradient-to-b from-cream-100 to-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-serif text-4xl md:text-5xl font-bold text-primary-800 mb-4">
                Syarat dan Ketentuan
            </h1>
            <p class="text-gray-600 text-lg">
                Harap dibaca dengan teliti sebelum melakukan pemesanan
            </p>
        </div>
        
        <!-- Content -->
        <div class="space-y-8">
            
            <!-- Pembayaran dan Booking -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-primary-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    Pembayaran dan Booking
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Fix booking hanya berlaku setelah melakukan pembayaran <strong>DP Rp 100.000</strong> untuk kebaya. Diharapkan para penyewa kebaya menyertakan tanggal dan bulan yang pasti. <strong>Sistem First Get berlaku</strong>.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Pelunasan sebelum pengiriman untuk sewa luar kota. Untuk sewa dalam kota H-1 yang langsung diambil dilempar.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            <strong>DP tidak hangus</strong> apabila melakukan pembatalan sewa dalam kondisi apa pun dan sudah full payment dan pembatalan terjadi pada H-3 sebelum acara.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Ganti kebaya atau reschedule hanya dapat dilakukan 1 kali, wajib menyertakan foto surat edaran resmi kampus (khusus acara kampus).
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Jika sudah melakukan penggantian dan ingin mengganti kembali, dikenakan biaya <strong>Rp 50.000/ganti</strong> atau reschedule.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-600 mt-1"></i>
                        <p>
                            H-20 acara tidak menerima penggantian kebaya atau reschedule.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                        <p>
                            Jika kebaya yang diinginkan tidak tersedia saat reschedule, uang yang ready.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Deposit dan Identitas -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-primary-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-id-card"></i>
                    </div>
                    Deposit dan Identitas
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Deposit merupakan jaminan sewa yaitu sebesar <strong>Rp 100.000</strong> dan akan dikembalikan 100% jika tidak terdapat kerusakan pada kebaya yang di sewa.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            <strong>Identitas Wajib</strong>. Untuk Online/luar kota wajib Kirim 2 foto identitas (KTP/SIM/KTM/Paspor). Untuk area Bekasi atau pengambilan langsung, wajib tunjukkan 2 sesi identitas, tinggalkan 1 asli identitas.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Pelunasan + kirim identitas maksimal <strong>H-1 sebelum pengiriman</strong>. Untuk area Bekasi atau dalam kota H-1 sebelum pengambilan atau pengiriman.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Fitting -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-primary-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    Fitting
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Dapat fitting setelah melakukan DP.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Wajib appointment dulu, hanya ada <strong>1x sesi fitting</strong>.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Bisa mencoba kebaya yaitu <strong>1 kebaya yang sudah di-keep</strong> dan <strong>1 kebaya tambahan</strong> jika masih tersedia.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-primary-600 mt-1"></i>
                        <p>
                            Disarankan memakai manset, dan maksimal membawa <strong>1-2 pendamping</strong>.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Pengambilan dan Pengembalian -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-primary-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-truck"></i>
                    </div>
                    Area Bekasi & Sekitarnya
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-clock text-primary-600 mt-1"></i>
                        <p><strong>H-1: Pengambilan</strong></p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-clock text-primary-600 mt-1"></i>
                        <p><strong>Hari H: Pemakaian</strong></p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-clock text-primary-600 mt-1"></i>
                        <p><strong>H+1: Pengembalian, maksimal pukul 13.00 WIB</strong></p>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-primary-100">
                    <h3 class="font-serif text-xl font-semibold text-primary-700 mb-4">Luar Jabodetabek / Luar Kota</h3>
                    <div class="space-y-4 text-gray-700">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary-600 mt-1"></i>
                            <p><strong>H-3: Pengiriman dari Bekasi</strong></p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary-600 mt-1"></i>
                            <p><strong>H-1: Barang sampai</strong></p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary-600 mt-1"></i>
                            <p><strong>Hari H: Pemakaian</strong></p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary-600 mt-1"></i>
                            <p><strong>H+1: Pengembalian, kirim resi maksimal pukul 11.00 WIB</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Keterlambatan & Denda -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-red-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    Keterlambatan & Denda
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-orange-600 mt-1"></i>
                        <p>
                            Keterlambatan pengembalian (baik barang maupun resi): <strong>Denda Rp 100.000/hari</strong>. Permintaan kirim lebih awal: <strong>Charge Rp 50.000/hari</strong>
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-money-bill-wave text-green-600 mt-1"></i>
                        <p>
                            Harga sewa tidak termasuk ongkir kirim & balik. Ongkir dan ekspedisi ditanggung penyewa.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-shipping-fast text-blue-600 mt-1"></i>
                        <p>
                            Area Bekasi, sekitarnya bisa menggunakan pengiriman instan dan Wajib konfirmasi terlebih dahulu.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-box text-primary-600 mt-1"></i>
                        <p>
                            Luar kota, wajib gunakan layanan pengiriman nextday, dan <strong>Wajib kirim resi pengembalian maksimal H+1 pukul 11.00</strong>
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-camera text-purple-600 mt-1"></i>
                        <p>
                            Semua kebaya tidak perlu dicuci, <strong>Wajib foto bukti resi</strong>. Pastikan semua item kembali lengkap & tidak tertinggal.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-ban text-red-600 mt-1"></i>
                        <p>
                            <strong>Durasi sewa tidak termasuk ongkir kirim dan pengembalian.</strong>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Pembatalan dan Perubahan -->
            <div class="bg-white rounded-xl shadow-sm border border-primary-100 p-8">
                <h2 class="font-serif text-2xl font-bold text-primary-800 mb-6 flex items-center gap-3">
                    <div class="bg-orange-600 text-white rounded-lg px-4 py-2">
                        <i class="fas fa-undo"></i>
                    </div>
                    Pembatalan dan Perubahan
                </h2>
                
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-ban text-red-600 mt-1"></i>
                        <p>
                            <strong>Cancel booking = DP hangus</strong>. DP tidak bisa dialihkan ke produk lain.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-calendar-times text-orange-600 mt-1"></i>
                        <p>
                            Ganti tanggal/kebaya Maks. 1: Konfirmasi paling lambat <strong>H-30</strong>
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-coins text-yellow-600 mt-1"></i>
                        <p>
                            Ganti lebih dari 1x ⇒ <strong>Denda Rp 50.000/ganti</strong>.
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                        <p>
                            Mohon segera infokan jika ada perubahan : jadwal , Alamat , Ukuran tubuh (TB, BB, LD)
                        </p>
                    </div>
                    
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mt-6">
                        <p class="font-semibold text-red-800 text-lg">
                            <i class="fas fa-handshake"></i> DEAL = SETUJU DENGAN SELURUH SYARAT & KETENTUAN INI
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- CTA -->
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-6">Sudah memahami syarat dan ketentuan?</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors font-semibold text-lg">
                <i class="fas fa-check-circle mr-2"></i> Saya Setuju, Lanjut Pilih Kebaya
            </a>
        </div>
        
    </div>
</div>

@endsection