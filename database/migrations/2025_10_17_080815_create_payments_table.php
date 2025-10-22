<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke rentals
            $table->foreignId('rental_id')
                  ->constrained('rentals')
                  ->onDelete('cascade');
            
            // Payment Number (Invoice-like)
            $table->string('payment_number')->unique();      // PAY-20250101-0001
            
            // Payment Details
            $table->decimal('amount', 10, 2);                // Jumlah pembayaran
            
            $table->enum('payment_method', [
                'cash',           // Tunai
                'transfer',       // Transfer bank
                'e-wallet',       // GCash, Dana, OVO, dll
                'credit_card'     // Kartu kredit
            ])->default('transfer');
            
            $table->enum('status', [
                'pending',        // Menunggu konfirmasi
                'completed',      // Berhasil
                'failed',         // Gagal
                'cancelled'       // Dibatalkan
            ])->default('pending');
            
            // Reference & Tracking
            $table->string('reference_number')->nullable();  // No resi transfer, no invoice, dll
            $table->date('payment_date')->nullable();        // Tanggal pembayaran
            
            // Notes
            $table->text('notes')->nullable();               // Catatan pembayaran
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};