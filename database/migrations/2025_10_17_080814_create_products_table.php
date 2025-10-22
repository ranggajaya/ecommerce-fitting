<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke categories
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            
            // Basic Info
            $table->string('name');                          // Nama baju
            $table->string('slug')->unique();                // URL slug
            $table->text('description');                     // Deskripsi detail
            
            // Pricing untuk Rental
            $table->decimal('daily_rental_price', 10, 2);   // Harga sewa per hari
            $table->decimal('weekly_rental_price', 10, 2);  // Harga sewa per minggu
            
            // Stock Management
            $table->integer('stock_available');              // Jumlah stok tersedia
            
            // Rental Duration Rules
            $table->integer('min_rental_days')->default(1); // Minimal hari sewa
            $table->integer('max_rental_days')->default(30); // Maksimal hari sewa
            
            // Images
            $table->string('image');                         // Foto utama
            $table->json('images')->nullable();              // Array foto tambahan
            
            // Featured
            $table->boolean('is_featured')->default(false);  // Tampil di homepage
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};