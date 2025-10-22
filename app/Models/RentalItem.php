<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id', 'product_id', 'quantity', 'daily_price', 'subtotal',
        'size', 'special_request', 'condition_at_pickup', 
        'condition_at_return', 'damage_notes'
    ];

    protected $casts = [
        'daily_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}