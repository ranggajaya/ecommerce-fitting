<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'is_admin', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function measurement()
    {
        return $this->hasOne(Measurement::class);
    }

    public function isAdmin()
    {
        return $this->is_admin || $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }
}