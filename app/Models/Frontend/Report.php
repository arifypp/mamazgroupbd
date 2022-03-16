<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Report extends Model
{
    use HasFactory;
    

    // User Model
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    // User Model
    public function agent()
    {
        return $this->belongsTo(User::class, 'refereluserid');
    }
}
