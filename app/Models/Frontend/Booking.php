<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use App\Models\User;
use Auth;
class Booking extends Model
{
    use HasFactory;
    protected $table="bookings";

    /** Present Address Model **/
    // Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'divisionid');
    }
    // District
    public function district()
    {
        return $this->belongsTo(District::class, 'districtid');
    }
    // Thana
    public function thana()
    {
        return $this->belongsTo(Thana::class, 'districtid');
    }
    /** Present Address Model End **/

    /** Permanent Address Model **/

    // Division
    public function pdivision()
    {
        return $this->belongsTo(Division::class, 'permanetdivisionid');
    }
    // District
    public function pdistrict()
    {
        return $this->belongsTo(District::class, 'permanentdistrictid');
    }
    // Thana
    public function pthana()
    {
        return $this->belongsTo(Thana::class, 'permanentthanaid');
    }
    /** Permanent Address Model End **/

    // User Model
    public function user()
    {
        return $this->belongsTo(User::class, 'bookingauthid');
    }

    // Counting Booking number by user
    public static function bookcount()
    {
        $booking = Booking::where('bookingauthid', Auth::user()->id )->count();

        return $booking;
    }
    // Admin booking counting
    public static function Adminbookcount()
    {
        $booking = Booking::all()->count();

        return $booking;
    }
}
