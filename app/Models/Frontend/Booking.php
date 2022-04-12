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

    protected $fillable = [
        'bookingid',
        'user_id',
        'status',
        'name',
        'phonenumber',
        'religion',
        'nationality',
        'nidnumber',
        'dob',
        'maritalstatus',
        'fathername',
        'fatherphone',
        'mothername',
        'motherphone',
        'spousename',
        'spousephonenumber',
        'flatorhouse',
        'divisionid'.
        'districtid'.
        'thanaid'.
        'ppostoffice'.
        'ppostcode'.
        'permanenthouse'.
        'permanetdivisionid'.
        'permanentdistrictid'.
        'permanentthanaid'.
        'permanentpostoffice'.
        'permanentpostcode'.
        'nominyname'.
        'nominyphone'.
        'nominyaddress'.
        'nominynid'.
        'nominyrelatoin'.
        'referelname'.
        'referelphone'.
        'referelemail'.
        'landvalue'.
        'landquality'.
        'paymentSystem'.
        'kistiDuration'.
        'bookingcash'.
        'total_flat_price',
        'kistypayment',
        'dueamount',
        'fullamount',
    ];

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
        return $this->belongsTo(User::class, 'user_id');
    }

    // Counting Booking number by user
    public static function bookcount()
    {
        $booking = Booking::where('user_id', Auth::user()->id )->count();

        return $booking;
    }
    // Admin booking counting
    public static function Adminbookcount()
    {
        $booking = Booking::all()->count();

        return $booking;
    }
}
