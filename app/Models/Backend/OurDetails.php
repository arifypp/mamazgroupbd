<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurDetails extends Model
{
    use HasFactory;
    protected $table = 'our_details';
    protected $fillable = [
        'title',
        'desc',
        'image',
    ];
    
}
