<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'chest', 'waist', 'hips', 
        'shoulder', 'sleeve_length', 'dress_length', 'notes'
    ];

    protected $casts = [
        'chest' => 'decimal:2',
        'waist' => 'decimal:2',
        'hips' => 'decimal:2',
        'shoulder' => 'decimal:2',
        'sleeve_length' => 'decimal:2',
        'dress_length' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}