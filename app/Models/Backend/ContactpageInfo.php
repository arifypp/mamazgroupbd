<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactpageInfo extends Model
{
    use HasFactory;

    protected $table = 'contactpage_infos';

    protected $fillable = [
        'address',
        'email',
        'phone',
    ];
}
