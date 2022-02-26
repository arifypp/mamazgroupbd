<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $table = 'aboutscontents';

    protected $fillable = [
        'title',
        'desc',
        'image',
        'layout',
    ];
}