<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin;

// ========================================
// PUBLIC ROUTES (Tidak perlu login)
// ========================================

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/koleksi', [ProductController::class, 'index'])->name('products.index');
Route::get('/koleksi/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');


// ========================================
// AUTH ROUTES (Perlu login)
// ========================================

Route::middleware('auth')->group(function () {
    
    // ====== MEASUREMENT ROUTES ======
    // Untuk customer input/edit ukuran badan mereka
    Route::get('/ukuran', [MeasurementController::class, 'edit'])
        ->name('measurement.edit');
    
    Route::post('/ukuran', [MeasurementController::class, 'store'])
        ->name('measurement.store');
    
    
    // ====== RENTAL ROUTES ======
    // Untuk customer membuat & manage penyewaan
    
    // Membuat penyewaan baru
    Route::post('/penyewaan/buat', [RentalController::class, 'create'])
        ->name('rental.create');
    
    // Proses checkout
    Route::post('/penyewaan/checkout', [RentalController::class, 'checkout'])
        ->name('rental.checkout');
    
    // Lihat daftar penyewaan customer
    Route::get('/penyewaan', [RentalController::class, 'myRentals'])
        ->name('rentals.index');
    
    // Lihat detail 1 penyewaan
    Route::get('/penyewaan/{rental_number}', [RentalController::class, 'show'])
        ->name('rentals.show');
    
    
    // ====== PAYMENT ROUTES ======
    // Untuk customer lihat & lakukan pembayaran
    
    // Lihat form pembayaran
    Route::get('/pembayaran/{rental_number}', [PaymentController::class, 'show'])
        ->name('payment.show');
    
    // Submit pembayaran
    Route::post('/pembayaran/{rental_number}', [PaymentController::class, 'store'])
        ->name('payment.store');
    
});


// ========================================
// ADMIN ROUTES (Perlu login + admin)
// ========================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Categories CRUD
    Route::resource('/categories', Admin\CategoryController::class);
    
    // Products CRUD
    Route::resource('/products', Admin\ProductController::class);
    
    // Rentals Management
    Route::resource('/rentals', Admin\RentalController::class);
    
    // Payments Management
    Route::resource('/payments', Admin\PaymentController::class);
    
});


// ========================================
// INFORMATIONAL PAGES
// ========================================

Route::get('/how-to-rent', function () {
    return view('pages.how-to-rent');
})->name('how-to-rent');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');


// ========================================
// BREEZE AUTH ROUTES (Sudah include login, register, dll)
// ========================================

require __DIR__.'/auth.php';


/* ========================================
   PENJELASAN ROUTES
   ======================================== */

/*
PUBLIC ROUTES (Siapa aja bisa akses):
├─ GET  / 
│   └─ Tampil homepage dengan produk featured
│
├─ GET  /koleksi
│   └─ Tampil semua produk (dengan filter)
│
├─ GET  /koleksi/{slug}
│   └─ Tampil detail 1 produk
│
└─ GET  /kategori/{slug}
    └─ Tampil produk by kategori


PROTECTED ROUTES - CUSTOMER (Perlu login):
├─ MEASUREMENT (Data ukuran customer)
│  ├─ GET  /ukuran
│  │  └─ Tampil form edit ukuran
│  │
│  └─ POST /ukuran
│     └─ Simpan/update ukuran customer
│
├─ RENTAL (Penyewaan customer)
│  ├─ POST /penyewaan/buat
│  │  └─ Create rental baru
│  │
│  ├─ POST /penyewaan/checkout
│  │  └─ Proses checkout
│  │
│  ├─ GET  /penyewaan
│  │  └─ Tampil list rental customer
│  │
│  └─ GET  /penyewaan/{rental_number}
│     └─ Tampil detail 1 rental
│
└─ PAYMENT (Pembayaran)
   ├─ GET  /pembayaran/{rental_number}
   │  └─ Tampil form pembayaran
   │
   └─ POST /pembayaran/{rental_number}
      └─ Proses pembayaran


PROTECTED ROUTES - ADMIN (Perlu login + is_admin):
├─ GET    /admin/dashboard
│  └─ Tampil admin dashboard
│
├─ CATEGORIES (Kelola kategori)
│  ├─ GET    /admin/categories
│  ├─ GET    /admin/categories/create
│  ├─ POST   /admin/categories
│  ├─ GET    /admin/categories/{id}/edit
│  ├─ PUT    /admin/categories/{id}
│  └─ DELETE /admin/categories/{id}
│
├─ PRODUCTS (Kelola produk/baju)
│  ├─ GET    /admin/products
│  ├─ GET    /admin/products/create
│  ├─ POST   /admin/products
│  ├─ GET    /admin/products/{id}/edit
│  ├─ PUT    /admin/products/{id}
│  └─ DELETE /admin/products/{id}
│
├─ RENTALS (Kelola penyewaan)
│  ├─ GET    /admin/rentals
│  ├─ GET    /admin/rentals/{id}
│  ├─ GET    /admin/rentals/{id}/edit
│  ├─ PUT    /admin/rentals/{id}
│  └─ DELETE /admin/rentals/{id}
│
└─ PAYMENTS (Kelola pembayaran)
   ├─ GET    /admin/payments
   ├─ GET    /admin/payments/{id}
   ├─ GET    /admin/payments/{id}/edit
   ├─ PUT    /admin/payments/{id}
   └─ DELETE /admin/payments/{id}


HTTP METHODS:
- GET    = Ambil data / tampilkan halaman
- POST   = Submit form (create)
- PUT    = Update data
- DELETE = Hapus data
*/


/* ========================================
   MIDDLEWARE PENJELASAN
   ======================================== */

/*
Route::middleware('auth'):
├─ Cek user sudah login
├─ Jika belum → redirect ke login
└─ Jika sudah → lanjut ke controller

Route::middleware('auth', 'admin'):
├─ Cek user sudah login
├─ Cek user->is_admin = true
├─ Jika tidak → redirect dengan error
└─ Jika yes → lanjut ke admin panel

Route::prefix('admin'):
├─ Tambah prefix 'admin/' ke semua URL
├─ GET /categories → /admin/categories
├─ GET /products   → /admin/products
└─ GET /rentals    → /admin/rentals

Route::name('admin.'):
├─ Tambah prefix 'admin.' ke semua route name
├─ 'categories' → 'admin.categories'
├─ 'products'  → 'admin.products'
└─ 'rentals'   → 'admin.rentals'
*/


/* ========================================
   NAMED ROUTES (Route Naming)
   ======================================== */

/*
Alasan kita pakai named routes:

❌ BAD (Hardcoded URL):
<a href="/koleksi/kebaya-modern">Lihat Detail</a>

✅ GOOD (Named route):
<a href="{{ route('products.show', 'kebaya-modern') }}">Lihat Detail</a>

Keuntungan:
- Jika URL berubah, cukup update routes
- View otomatis update
- Lebih maintainable
- Lebih aman

Contoh:
route('home')                    → /
route('products.index')          → /koleksi
route('products.show', $slug)    → /koleksi/kebaya-modern
route('categories.show', $slug)  → /kategori/kebaya

route('rental.create')           → /penyewaan/buat
route('rentals.index')           → /penyewaan
route('rentals.show', $number)   → /penyewaan/RNT-20250101-001

route('admin.dashboard')         → /admin/dashboard
route('admin.products.index')    → /admin/products
route('admin.products.create')   → /admin/products/create
route('admin.products.edit', 1)  → /admin/products/1/edit
*/


/* ========================================
   RESOURCE ROUTES (@resource)
   ======================================== */

/*
Route::resource('/products', Admin\ProductController::class);

Ini sama dengan:
Route::get('/products', 'index')        # Tampil list
Route::get('/products/create', 'create')# Tampil form create
Route::post('/products', 'store')       # Simpan ke DB
Route::get('/products/{id}', 'show')    # Tampil detail
Route::get('/products/{id}/edit', 'edit')# Tampil form edit
Route::put('/products/{id}', 'update')  # Update ke DB
Route::delete('/products/{id}', 'destroy')# Hapus dari DB

Methods di controller:
✅ index()   - GET  /products (list semua)
✅ create()  - GET  /products/create (form create)
✅ store()   - POST /products (simpan)
✅ show()    - GET  /products/{id} (detail)
✅ edit()    - GET  /products/{id}/edit (form edit)
✅ update()  - PUT  /products/{id} (update)
✅ destroy() - DELETE /products/{id} (hapus)
*/