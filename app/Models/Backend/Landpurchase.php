<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landpurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'itemname',
        'cost',
        'landid',
    ];
}
