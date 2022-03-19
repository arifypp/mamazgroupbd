<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class WalletsLadger extends Model
{
    use HasFactory;
    protected $table="wallets";
    protected $fillable = [
        'user_type',
        'user_id',
        'wallet_type_id',
        'raw_balance',
    ];

    static public function getCountVisitor($start_date, $end_date)
    {
        $totalvisitors = DB::table('wallets')->where('user_id', auth()->user()->id );

        $totalvisitors = $totalvisitors->where(DB::raw("(DATE_FORMAT(wallets.created_at,'%Y-%m-%d'))"), '>=' , $start_date);

        $totalvisitors = $totalvisitors->where(DB::raw("(DATE_FORMAT(wallets.created_at,'%Y-%m-%d'))"), '<=' , $end_date);

        return $totalvisitors->sum('raw_balance');
    }
}
