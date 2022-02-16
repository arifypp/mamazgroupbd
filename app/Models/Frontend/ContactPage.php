<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;

    protected $table="contact_pages";
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}
