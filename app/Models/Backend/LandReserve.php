<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\LandReserveCat;
class LandReserve extends Model
{
    use HasFactory;

    protected $table = 'land_reserves';

    protected $fillable = [
        'sft',
        'land_cat',
        'cat_id'
    ];

    public function LandCatName()
    {
        return $this->belongsTo(LandReserveCat::class, 'land_cat');
    }
}
