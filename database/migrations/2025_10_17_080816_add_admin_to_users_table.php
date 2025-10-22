<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom setelah email_verified_at
            $table->boolean('is_admin')
                  ->default(false)
                  ->after('email_verified_at');
            
            $table->enum('role', [
                'customer',    // Pelanggan
                'admin',       // Admin (super user)
                'staff'        // Staff (untuk pickup/return)
            ])
                  ->default('customer')
                  ->after('is_admin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'role']);
        });
    }
};