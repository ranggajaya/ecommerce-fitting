<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Body Measurements (dalam cm)
            $table->decimal('chest', 5, 2)->nullable();      // Lingkar dada
            $table->decimal('waist', 5, 2)->nullable();      // Lingkar pinggang
            $table->decimal('hips', 5, 2)->nullable();       // Lingkar pinggul
            $table->decimal('shoulder', 5, 2)->nullable();   // Lebar bahu
            $table->decimal('sleeve_length', 5, 2)->nullable(); // Panjang lengan
            $table->decimal('dress_length', 5, 2)->nullable(); // Panjang gaun
            
            // Additional Notes
            $table->text('notes')->nullable();               // Catatan khusus (misal: prefer loose fit)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};