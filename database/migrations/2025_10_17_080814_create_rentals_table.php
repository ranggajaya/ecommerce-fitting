<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Rental Number (Invoice-like)
            $table->string('rental_number')->unique();       // RNT-20250101-0001
            
            // Rental Dates
            $table->date('rental_start_date');               // Tanggal mulai sewa
            $table->date('rental_end_date');                 // Tanggal selesai sewa
            $table->integer('total_rental_days');            // Total hari sewa
            
            // Pricing
            $table->decimal('subtotal', 10, 2);              // Total harga sebelum diskon
            $table->decimal('deposit', 10, 2)->default(0);   // DP/Uang jaminan
            $table->decimal('discount', 10, 2)->default(0);  // Diskon (jika ada)
            $table->decimal('total_price', 10, 2);           // Total harga akhir
            
            // Status Tracking
            $table->enum('status', [
                'pending',           // Menunggu konfirmasi
                'confirmed',         // Sudah dikonfirmasi
                'ready_to_pickup',   // Siap diambil
                'picked_up',         // Sudah diambil customer
                'returned',          // Sudah dikembalikan
                'cancelled'          // Dibatalkan
            ])->default('pending');
            
            // Customer Info
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address');
            
            // Payment Status
            $table->enum('payment_status', [
                'unpaid',    // Belum bayar
                'partial',   // Sebagian bayar
                'paid',      // Lunas
                'refunded'   // Uang kembali
            ])->default('unpaid');
            
            // Additional Notes
            $table->text('notes')->nullable();               // Catatan khusus
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};