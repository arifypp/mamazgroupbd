<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourservice extends Model
{
    use HasFactory;

    protected $table="ourservices";
    protected $fillable = [
        'name',
        'image',
        'slug',
        'desc',
        'status',
        'is_featured'
    ];
}
