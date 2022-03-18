<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;
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

    // Counting Booking number by user
    public static function reportCount()
    {
        $reportCount = Report::where('userid', Auth::user()->id )->count();

        return $reportCount;
    }
}
