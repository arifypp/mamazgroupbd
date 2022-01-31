<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignupCash extends Model
{
    use HasFactory;
    protected $table="signup_cashes";
    protected $fillable = [
        'userid',
        'refereluser',
        'bookingmoneymehtod',
        'bkashtransiction',
        'bkashnumber',
        'nagadtransiction',
        'nagadnumber',
        'rockettransiction',
        'rocketnumber',
    ];
}
