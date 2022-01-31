<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Frontend\Booking;
class Application extends Model
{
    use HasFactory;

    // User Model
    public function user()
    {
        return $this->belongsTo(User::class, 'auth_id');
    }
    // Booking Model
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'auth_id');
    }
}
