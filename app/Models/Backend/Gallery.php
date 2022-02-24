<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\GalleryCategory;
class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';

    protected $fillable = [
        'image', 'gallaryscatid'
    ];

    public function gallerycat()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallaryscatid');
    }
}
