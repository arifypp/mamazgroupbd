<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;

class Depositor extends Model
{
    use HasFactory;

    protected $table = 'depositors';

    protected $fillable = [
        'txn_id',
        'purpose',
        'amount',
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
