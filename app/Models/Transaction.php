<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'payment_id',
        'txn_id',
        'status',
        'amount',
        'network_fee',
        'wallet_id',
        'user_id',
    ];
}
