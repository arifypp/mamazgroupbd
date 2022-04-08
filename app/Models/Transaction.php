<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;

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


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wallettype()
    {
        return $this->belongsTo(WalletType::class, 'wallet_id');
    }
}
