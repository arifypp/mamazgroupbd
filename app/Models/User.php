<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use CoreProc\WalletPlus\Models\Traits\HasWallets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Frontend\Booking;
use CoreProc\WalletPlus\Models\WalletType;
use App\Models\Frontend\Addmoney;
use Auth;
use DB;
use Carbon\Carbon;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasWallets;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'dob', 
        'avatar',
        'referrer_id',
        'username',
        'auth_role'
    ];

    protected $appends = ['referral_link'];

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }

    public static function AllBookingCount()
    {
      $countBooking = Booking::where('bookingauthid', Auth::user()->id)->count();
      return $countBooking;
    }

    public static function PromoteLevel()
    {
        $output = '';
        $referlID = User::where('referrer_id', Auth::user()->id)->count();

        if( Auth::user()->auth_promote == -0 && $referlID > 0)
        {
            $output = '<small>Marketing Associate</small><br>';
        }
        elseif( Auth::user()->auth_promote == 0 && $referlID > 6)
        {
          $output = '<small>Marketing Co-Ordinator</small><br>';
        }
        elseif( Auth::user()->auth_promote == 1 && $referlID > 13)
        {
            $output = '<small>Marketing Executive</small><br>';
        }
        elseif( Auth::user()->auth_promote == 2 && $referlID > 20)
        {
            $output = '<small>Assitant General Manager</small><br>';
        }
        elseif( Auth::user()->auth_promote == 3 && $referlID > 27)
        {
            $output = '<small>General Manager</small><br>';
        }
        elseif( Auth::user()->auth_promote == 4 && $referlID > 34)
        {
            $output = '<small>Project Director</small><br>';
        }
        return $output;
    }

    public static function PromotionMsg()
    {
        $levelOutput= '';
        $Userlevel = User::where('referrer_id', Auth::user()->id)->count();

        if( Auth::check() && $Userlevel > 6 )
        {
            $levelOutput    .= '
            <div class="modal fade" id="PromoteLevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <img src="/admin/assets/images/cg.svg" class="img-fluid" alt="Congrasulation" width="150"><br><br>
                  <h1>স্বাগতম!!!</h1>
                  <p>আপনি এখন মার্কেটিং এক্সিউটিভ পদে পদান্নিত হয়েছেন।</p>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="promotelevelupdate">ধন্যবাদ!!!</button>
                </div>
              </div>
            </div>
          </div>
            ';
        }
        elseif( Auth::check() && $Userlevel > 13 )
        {
            $levelOutput    .= '
            <div class="modal fade" id="PromoteLevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <img src="/admin/assets/images/cg.svg" class="img-fluid" alt="Congrasulation" width="150"><br><br>
                  <h1>স্বাগতম!!!</h1>
                  <p>আপনি এখন পদে পদান্নিত হয়েছেন।</p>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">ধন্যবাদ!!!</button>
                </div>
              </div>
            </div>
          </div>
            ';
        }
        elseif( Auth::check() && $Userlevel > 20 )
        {
            $levelOutput    .= '
            <div class="modal fade" id="PromoteLevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <img src="/admin/assets/images/cg.svg" class="img-fluid" alt="Congrasulation" width="150"><br><br>
                  <h1>স্বাগতম!!!</h1>
                  <p>আপনি এখন পদে 20 পদান্নিত হয়েছেন।</p>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">ধন্যবাদ!!!</button>
                </div>
              </div>
            </div>
          </div>
            ';
        }

        elseif( Auth::check() && $Userlevel > 27 )
        {
            $levelOutput    .= '
            <div class="modal fade" id="PromoteLevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <img src="/admin/assets/images/cg.svg" class="img-fluid" alt="Congrasulation" width="150"><br><br>
                  <h1>স্বাগতম!!!</h1>
                  <p>আপনি এখন পদে 270 পদান্নিত হয়েছেন।</p>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">ধন্যবাদ!!!</button>
                </div>
              </div>
            </div>
          </div>
            ';
        }

        elseif( Auth::check() && $Userlevel > 34 )
        {
            $levelOutput    .= '
            <div class="modal fade" id="PromoteLevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <img src="/admin/assets/images/cg.svg" class="img-fluid" alt="Congrasulation" width="150"><br><br>
                  <h1>স্বাগতম!!!</h1>
                  <p>আপনি এখন পদে 34 পদান্নিত হয়েছেন।</p>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">ধন্যবাদ!!!</button>
                </div>
              </div>
            </div>
          </div>
            ';
        }

        return $levelOutput;
    }

    // User level promote by numnber
    public static function PromoteNumber()
    {
        $UserCountLevel = User::where('id', Auth::user()->id)->get();
        foreach( $UserCountLevel as $userID )
        {
          return $userID->auth_promote;
        }
    }

    // User asset money 
    public static function AssetMoney()
    {
      $BDT = "৳";
      $AssetWallets = auth()->user()->wallet('Assets Money');
      if( !empty( $AssetWallets->balance ) ){
        return $BDT. $AssetWallets->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    // User cash money 
    public static function CashMoney()
    {
      $BDT = "৳";
      $CashWallets = auth()->user()->wallet('Cash Money');
      if( !empty( $CashWallets->balance ) ){
        return $BDT. $CashWallets->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    // User agent money 
    public static function AgentMoney()
    {
      $BDT = "৳";
      $AgentCash = auth()->user()->wallet('Agent Money');
      if( !empty( $AgentCash->balance ) ){
        return $BDT. $AgentCash->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    // User charity money 
    public static function CharityMoney()
    {
      $BDT = "৳";
      $CharityCash = auth()->user()->wallet('Agent Money');
      if( !empty( $CharityCash->balance ) ){
        return $BDT. $CharityCash->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    // User vat/tax money 
    public static function VatTaxCost()
    {
      $BDT = "৳";
      $VatTaxCost = auth()->user()->wallet('Vat And Text');
      if( !empty( $VatTaxCost->balance ) ){
        return $BDT. $VatTaxCost->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    // User vat/tax money 
    public static function MamazPoisa()
    {
      $BDT = "৳";
      $MamazCash = auth()->user()->wallet('Mamaz Money');
      if( !empty( $MamazCash->balance ) ){
        return $BDT. $MamazCash->balance; 
      }
      else
      {
        return $BDT. 0;
      }

    }

    public static function RedialChart()
    {
      $SumRedialChart = DB::table('wallets')->where('user_id', auth()->user()->id )->where('created_at','>=',Carbon::now()->subdays(30))->sum('raw_balance', 'created_at');
      
      return $SumRedialChart;
    }

    public static function BestPerformanceBonus()
    {
      $booking = Booking::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();

      $bpbonus = config('bonus_settings.bestperformancebonus');

        foreach( $booking as $value )
        {
          $user = User::where('id', $value->bookingauthid)->get();
               
          $findwallelt = WalletType::where("name", "=", "Best Performance")->get();
          $walletidrequest = $findwallelt['0']->id;


          if( empty( $user->wallets()->wallet_type_id ) ) 
          {
              $user->wallets()->create(['wallet_type_id' => $walletidrequest]);
              // Add payment
              
              $admoneydeposit = $user->wallet('Best Performance');
              $admoneydeposit->incrementBalance( $bpbonus );
              $admoneydeposit->balance;
              return $admoneydeposit->balance;
          }
          else
          {
              $admoneydeposit = $user->wallet('Best Performance');
              $admoneydeposit->incrementBalance( $bpbonus );
              $admoneydeposit->balance;
              return $admoneydeposit->balance;
          }
          
        }
    }

    // User Best performance bonus 
    public static function BestPerfomance()
    {
        $BDT = "৳";
        $MamzPerformance = auth()->user()->wallet('Best Performance');
        if( !empty( $MamzPerformance->balance ) ){
          return $BDT. $MamzPerformance->balance; 
        }
        else
        {
          return $BDT. 0;
        }

    }

    // Admin foundership bonus
    
    public static function FounderShip()
    {
        $BDT = "৳";
        $FounderShipBonus = auth()->user()->wallet('Foundership Bonus');
        if( !empty( $FounderShipBonus->balance ) ){
          return $BDT. $FounderShipBonus->balance; 
        }
        else
        {
          return $BDT. 0;
        }
    }


    public static function FounderShipBonus()
    {
      $bookingdata = Booking::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

      $bfbonus = config('bonus_settings.foundershipbonus') * $bookingdata;

      $user = User::find(Auth::user()->id);

               
      $findwallelt = WalletType::where("name", "=", "Foundership Bonus")->get();
      $walletidrequest = $findwallelt['0']->id;

      if( empty( $user->wallets()->wallet_type_id ) ) 
        {
            $user->wallets()->create(['wallet_type_id' => $walletidrequest]);
            // Add payment
            
            $admoneydeposit = $user->wallet('Foundership Bonus');
            $admoneydeposit->incrementBalance( $bfbonus );
            $admoneydeposit->balance;
            return $admoneydeposit->balance;
        }
        else
        {
            $admoneydeposit = $user->wallet('Foundership Bonus');
            $admoneydeposit->incrementBalance( $bfbonus );
            $admoneydeposit->balance;
            return $admoneydeposit->balance;
        }

    }

    // Non-sponsor bonus
    public static function NonSponsorbonus()
    {
        $BDT = "৳";
        $bonus = auth()->user()->wallet('Non-Sponsor Bonus');
        if( !empty( $bonus->balance ) ){
          return $BDT. $bonus->balance; 
        }
        else
        {
          return $BDT. 0;
        }
    }
    // Land coverage bonus
    public static function LandCoverageBonus()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Land Coverage');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Club bonus
    public static function ClubBonus()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Club Bonus');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // generation bonus
    public static function GenerationBonus()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Generation Bonus');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Land Reserve Money
    public static function LandReserveCash()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Land Reserve Cash');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Gift and tour
    public static function GiftandTour()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Gift And Tour');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Honda And Car
    public static function HondCar()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Honda And Car');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Land Insurance	
    public static function LandInsurance()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Land Insurance');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Turism Found	
    public static function TurismFound()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Turism Found');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // GoldPinCreastCertificate Found	
    public static function GoldPinCreastCertficate()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('GoldPinCreastCertificate Found');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Office Maintaince Found	
    public static function OfficeMaintainceFound()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Office Maintaince Found');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Demarage and Backup Found
    public static function DemarageAndBackupFound()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Demarage and Backup Found');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Mamaz Development Found
    public static function MamazDevelopmentFound()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Mamaz Development Found');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    public static function FollowUpBonus()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('FollowUp Bonus');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }

    // Money request from agent
    public static function MoneyRequestAgent()
    {
      $requestmoney = Addmoney::where('status', 0)->count();
      return $requestmoney;
    }

    // Service Charge for agent
    public static function MoneyrestAgent()
    {
      $BDT = "৳";
      $bonus = auth()->user()->wallet('Money Request');
      if( !empty( $bonus->balance ) ){
        return $BDT. $bonus->balance; 
      }
      else
      {
        return $BDT. 0;
      }
    }
    	

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
