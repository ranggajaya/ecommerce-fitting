<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            $table->foreignId('rental_id')
                  ->constrained('rentals')
                  ->onDelete('cascade');
            
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            
            // Item Details
            $table->integer('quantity');                     // Jumlah item
            $table->decimal('daily_price', 10, 2);           // Harga sewa per hari (snapshot)
            $table->decimal('subtotal', 10, 2);              // Total untuk item ini
            
            // Size & Customization
            $table->string('size')->nullable();              // XS, S, M, L, XL, Free
            $table->text('special_request')->nullable();     // Custom alterasi, tambahan, dll
            
            // Condition Tracking
            $table->enum('condition_at_pickup', [
                'good',      // Kondisi baik
                'fair',      // Kondisi cukup
                'damaged'    // Rusak
            ])->nullable();                                  // Kondisi saat customer pickup
            
            $table->enum('condition_at_return', [
                'good',
                'fair',
                'damaged'
            ])->nullable();                                  // Kondisi saat customer kembalikan
            
            $table->text('damage_notes')->nullable();        // Catatan kerusakan (jika ada)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_items');
    }
};