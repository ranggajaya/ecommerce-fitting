<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'rental_number', 'rental_start_date', 'rental_end_date',
        'total_rental_days', 'subtotal', 'deposit', 'discount', 'total_price',
        'status', 'customer_name', 'customer_email', 'customer_phone',
        'customer_address', 'payment_status', 'notes'
    ];

    protected $casts = [
        'rental_start_date' => 'date',
        'rental_end_date' => 'date',
        'subtotal' => 'decimal:2',
        'deposit' => 'decimal:2',
        'discount' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function generateRentalNumber()
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'RNT-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}