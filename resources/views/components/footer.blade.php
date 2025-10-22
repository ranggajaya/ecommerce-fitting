<footer class="bg-gray-900 text-gray-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- About -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4">RentalKebaya</h3>
                <p class="text-sm text-gray-400 mb-4">
                    Layanan rental kebaya dan baju adat terlengkap dengan kualitas terbaik untuk acara spesial Anda.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-semibold mb-4">Menu Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-purple-400 transition-colors">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-purple-400 transition-colors">
                            Koleksi Produk
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('rentals.index') }}" class="hover:text-purple-400 transition-colors">
                                Penyewaan Saya
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
            
            <!-- Categories -->
            <div>
                <h3 class="text-white font-semibold mb-4">Kategori</h3>
                <ul class="space-y-2 text-sm">
                    @php
                        $footerCategories = \App\Models\Category::limit(5)->get();
                    @endphp
                    @foreach($footerCategories as $cat)
                        <li>
                            <a href="{{ route('categories.show', $cat->slug) }}" class="hover:text-purple-400 transition-colors">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-4">Kontak Kami</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt text-purple-400 mt-1"></i>
                        <span>Jl. Contoh No. 123, Jakarta Pusat</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone text-purple-400"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope text-purple-400"></i>
                        <span>info@rentalkebaya.com</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-clock text-purple-400"></i>
                        <span>Senin - Sabtu: 09:00 - 18:00</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} RentalKebaya. All rights reserved.</p>
        </div>
    </div>
</footer>