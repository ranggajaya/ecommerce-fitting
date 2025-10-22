<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Kebaya, Gaun, Dress, dll
            $table->string('slug')->unique();                // kebaya, gaun, dress
            $table->text('description')->nullable();         // Deskripsi kategori
            $table->string('image')->nullable();             // Foto kategori
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};