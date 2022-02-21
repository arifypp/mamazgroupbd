<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourserviceshead extends Model
{
    use HasFactory;
    protected $table="ourserviceshead";
    protected $fillable = [
        'title',
        'desc',
    ];
}
