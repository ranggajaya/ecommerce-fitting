<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'daily_rental_price', 'weekly_rental_price', 
        'stock_available', 'min_rental_days', 'max_rental_days',
        'image', 'images', 'is_featured'
    ];
    
    protected $casts = [
        'images' => 'array',
        'daily_rental_price' => 'decimal:2',
        'weekly_rental_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function getAvailableStock($startDate, $endDate)
    {
        $bookedItems = RentalItem::whereHas('rental', function($q) use ($startDate, $endDate) {
            $q->whereBetween('rental_start_date', [$startDate, $endDate])
              ->orWhereBetween('rental_end_date', [$startDate, $endDate])
              ->whereNotIn('status', ['cancelled']);
        })->where('product_id', $this->id)->sum('quantity');

        return $this->stock_available - $bookedItems;
    }
}