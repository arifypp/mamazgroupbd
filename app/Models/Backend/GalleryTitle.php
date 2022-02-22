<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryTitle extends Model
{
    use HasFactory;

    protected $table = 'galleriestitle';

    protected $fillable = [
        'title', 'desc'
    ];
}
