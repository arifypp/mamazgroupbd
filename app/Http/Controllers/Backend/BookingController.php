<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use lemonpatwari\bangladeshgeocode\Models\Division;
use App\Models\Frontend\Booking;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;
use App\Notifications\BookingNotification;
use App\Notifications\BookingApproveNotification;
use Illuminate\Support\Facades\Notification;
use Response;
use Auth;
use DB;
use Session;
class BookingController extends Controller
{
    /**
     * Total Booking
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::orderBy('id', 'desc')->where('status', 3)->get();
        return view('Backend.booking.manage', compact('bookings'));
    }

    /**
     * New Booking
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        // 
        $bookings = Booking::where('status', 0)->get();
        return view('Backend.booking.new', compact('bookings'));

    }

    /**
     * Booking Approve Function.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        //
        $bookings = Booking::find($id);
        $bookings->status = 3;

        $DueCash = 0;

        // Collection user
        $bookinguser = User::where('id', $bookings->user_id)->first();
        $officer_red = $bookinguser->referrer_id;
        // Admin id 
        $admin    = User::where('id', Auth::user()->id)->first();
        // Sponsor
        $officer    = User::where('id', $officer_red)->first();
        // Sponsor one
        if( !empty($officer->referrer_id) ){
            $subofficer = User::where('id', $officer->referrer_id ? $officer->referrer_id : 'null')->first();
        }
        // Sponsor three
        if( !empty($subofficer->referrer_id) ){
        $sponsorthree = User::where('id', $subofficer->referrer_id ? $subofficer->referrer_id : 'null')->first();
        }
        // Sponsor four 
        if( !empty($sponsorthree->referrer_id) ){
        $sponsorfour = User::where('id', $sponsorthree->referrer_id ? $sponsorthree->referrer_id : 'null')->first();
        }
        // Sponsor five 
        if( !empty($sponsorfour->referrer_id) ){
        $sponsorfive = User::where('id', $sponsorfour->referrer_id ? $sponsorfour->referrer_id : 'null')->first();
        }
        // Bonus type
        $tourandbonus = config('bonus_settings.giftandtour');
        $CrestPincertificate = config('bonus_settings.gccf');
        $agentbonusbybooking = config('bonus_settings.agent_bonus');
        $clubBBonus      =   config('bonus_settings.clubbonus');
        $BestPerformance      =   config('bonus_settings.bestperformancebonus');
        $FundationCcashmoney      =   config('bonus_settings.foundershipbonus');
        $nonsponsorbonus        = config('bonus_settings.nonsponsorbonus');
        $fundetionBonustaka        = config('bonus_settings.fundatoinbonus');
        $LandInusrancetaka        = config('bonus_settings.landinsurance');
        $HondaandCarbonus        = config('bonus_settings.hondaandcar');
        $landReservecash        =   config('bonus_settings.landreserve');
        $OfficeMaintainancecash        =   config('bonus_settings.officemaintainance');
        $officedemaragebonus        =   config('bonus_settings.demarageandabckup');
        // Officer bonus
        $targetsellbonus = config('bonus_settings.TargetSell');
        $megadevelopmentbonus = config('bonus_settings.developmentbonus');
        $fivegeneratiobonus = config('bonus_settings.5generationbonus');

        // Collection payment
        $collectioncash = ($bookings->bookingcash) - ($tourandbonus+$CrestPincertificate+$agentbonusbybooking+$clubBBonus+$BestPerformance+$FundationCcashmoney+$nonsponsorbonus+$fundetionBonustaka+$LandInusrancetaka+$HondaandCarbonus+$HondaandCarbonus+$OfficeMaintainancecash+$officedemaragebonus+$targetsellbonus+$megadevelopmentbonus+$fivegeneratiobonus);

        $servicechargepercentage =  config('bonus_settings.ServiceCharge');

        $officerCollectioncash = $targetsellbonus+$megadevelopmentbonus+$fivegeneratiobonus;

        $serviceCharge =  $officerCollectioncash / 100 * $servicechargepercentage;

        $assettotalcash = ($officerCollectioncash - $serviceCharge) / 100 * config('bonus_settings.assetbonus');

        $cashtotalcash = ($officerCollectioncash - $serviceCharge) / 100 * config('bonus_settings.cashbonus');

        
        if ( $bookings->dueamount == $DueCash) {
            
            // Admin bonus
            if( !empty($admin) )
            {
                // officer payment
                $mainWallet = WalletType::find(7); //AssedMoney maincash
                $adminwallet = WalletType::find(25); //tourwallet
                $adminCrestWallet = WalletType::find(26); //crest and pin
                $OfficerWallet = WalletType::find(32); //Pending wallet
                $AgentMoneyBonus = WalletType::find(11); //Agent money
                $clubBonus = WalletType::find(19); //Club bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus
                $FundationBonus = WalletType::find(16); //Fundation bonus
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $FundationWallet = WalletType::find(33); //fundation wallet
                $LandInusrance = WalletType::find(24); //Land-Insurance wallet
                $HondaandCar = WalletType::find(23); //Honda-Car wallet
                $LandReservewalet = WalletType::find(21); //Land-reserve wallet
                $OfficeMaintaincewallet = WalletType::find(27); //Office-Maintainance wallet
                $demragebonus = WalletType::find(28); //Office-Demarage wallet
                $serviceChargewallet = WalletType::find(13); //Service wallet

                if( empty( $admin->wallets()->wallet_type_id )  )
                {
                    $admin->wallets()->create(['wallet_type_id' => $mainWallet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $adminwallet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $adminCrestWallet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $AgentMoneyBonus->id]);
                    $admin->wallets()->create(['wallet_type_id' => $clubBonus->id]);
                    $admin->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $admin->wallets()->create(['wallet_type_id' => $FundationBonus->id]);
                    $admin->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $admin->wallets()->create(['wallet_type_id' => $FundationWallet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $LandInusrance->id]);
                    $admin->wallets()->create(['wallet_type_id' => $HondaandCar->id]);
                    $admin->wallets()->create(['wallet_type_id' => $LandReservewalet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $OfficeMaintaincewallet->id]);
                    $admin->wallets()->create(['wallet_type_id' => $demragebonus->id]);
                    $admin->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);
                    // Tour Bonus payment
                    $tourBonus = $admin->wallet('Turism Found');
                    $tourBonus->incrementBalance($tourandbonus);
                    $tourBonus->balance;

                    // Crest and pin Bonus payment
                    $CrestAndPin = $admin->wallet('GoldPinCreastCertificate Found');
                    $CrestAndPin->incrementBalance($CrestPincertificate);
                    $CrestAndPin->balance;

                    // Agent bonus by book
                    $AgentBonus = $admin->wallet('Agent Money');
                    $AgentBonus->incrementBalance($agentbonusbybooking);
                    $AgentBonus->balance;

                    // Club bonus by book
                    $clubAndBonus = $admin->wallet('Club Bonus');
                    $clubAndBonus->incrementBalance($clubBBonus);
                    $clubAndBonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $admin->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Fundation bonus by book
                    $FundationCash = $admin->wallet('Foundership Bonus');
                    $FundationCash->incrementBalance($FundationCcashmoney);
                    $FundationCash->balance;

                    // Non-sponsor bonus by book
                    $NonSponserCash = $admin->wallet('Non-Sponsor Bonus');
                    $NonSponserCash->incrementBalance($nonsponsorbonus);
                    $NonSponserCash->balance;

                    // Fundation bonus by book
                    $FundationCash = $admin->wallet('Fundation Bonus');
                    $FundationCash->incrementBalance($fundetionBonustaka);
                    $FundationCash->balance;

                    // Land Insurance by book
                    $LandInsuraceCash = $admin->wallet('Land Insurance');
                    $LandInsuraceCash->incrementBalance($LandInusrancetaka);
                    $LandInsuraceCash->balance;

                    // Honda-car by book
                    $Hondaandcardb = $admin->wallet('Honda And Car');
                    $Hondaandcardb->incrementBalance($HondaandCarbonus);
                    $Hondaandcardb->balance;

                    // Land reserve by book
                    $landReserve = $admin->wallet('Land Reserve Cash');
                    $landReserve->incrementBalance($HondaandCarbonus);
                    $landReserve->balance;

                    // Office-Maintaince by book
                    $officemaintaince = $admin->wallet('Office Maintaince Found');
                    $officemaintaince->incrementBalance($OfficeMaintainancecash);
                    $officemaintaince->balance;

                    // Office-demarage by bonus
                    $officedemarage = $admin->wallet('Demarage and Backup Found');
                    $officedemarage->incrementBalance($officedemaragebonus);
                    $officedemarage->balance;

                    // Vat-tax by bonus
                    $vat_tax = $admin->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;

                    // Main cash 
                    $Maincashes = $admin->wallet('Assets Money');
                    $Maincashes->incrementBalance($collectioncash);
                    $Maincashes->balance;
                }
                else
                {
                    // Tour bonus
                    $tourBonus = $officer->wallet('Turism Found');
                    $tourBonus->incrementBalance($tourandbonus);
                    $tourBonus->balance;

                    // Crest and pin Bonus payment
                    $CrestAndPin = $admin->wallet('GoldPinCreastCertificate Found');
                    $CrestAndPin->incrementBalance($CrestPincertificate);
                    $CrestAndPin->balance;

                    // Agent bonus by book
                    $CrestAndPin = $admin->wallet('Agent Money');
                    $CrestAndPin->incrementBalance($agentbonusbybooking);
                    $CrestAndPin->balance;

                    // Club bonus by book
                    $clubAndBonus = $admin->wallet('Club Bonus');
                    $clubAndBonus->incrementBalance($clubBBonus);
                    $clubAndBonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $admin->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Fundershio bonus by book
                    $FundationCash = $admin->wallet('Foundership Bonus');
                    $FundationCash->incrementBalance($FundationCcashmoney);
                    $FundationCash->balance;

                    // Non-sponsor bonus by book
                    $NonSponserCash = $admin->wallet('Non-Sponsor Bonus');
                    $NonSponserCash->incrementBalance($nonsponsorbonus);
                    $NonSponserCash->balance;

                    // Fundation bonus by book
                    $FundationCash = $admin->wallet('Fundation Bonus');
                    $FundationCash->incrementBalance($fundetionBonustaka);
                    $FundationCash->balance;

                    // Honda-car by book
                    $Landreservemoney = $admin->wallet('Honda And Car');
                    $Landreservemoney->incrementBalance($landReservecash);
                    $Landreservemoney->balance;

                    // Land Insurance by book
                    $LandInsuraceCash = $admin->wallet('Land Insurance');
                    $LandInsuraceCash->incrementBalance($LandInusrancetaka);
                    $LandInsuraceCash->balance;

                    // Office-Maintaince by book
                    $officemaintaince = $admin->wallet('Office Maintaince Found');
                    $officemaintaince->incrementBalance($OfficeMaintainancecash);
                    $officemaintaince->balance;

                    // Office-demarage by bonus
                    $officedemarage = $admin->wallet('Demarage and Backup Found');
                    $officedemarage->incrementBalance($officedemaragebonus);
                    $officedemarage->balance;

                    // Vat-tax by bonus
                    $vat_tax = $admin->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;

                    // Main cash 
                    $Maincashes = $admin->wallet('Assets Money');
                    $Maincashes->incrementBalance($collectioncash);
                    $Maincashes->balance;
                }     
            }

            // Sponsor bonus one
            if( !empty($officer) )
            {
               
                // officer payment
                $OfficerWallet = WalletType::find(32); //pending
                $AssedMoney = WalletType::find(7); //Assed money
                $CashMoney = WalletType::find(9); //cash money
                $serviceChargewallet = WalletType::find(13); //Service wallet
                $GenerationWallet = WalletType::find(20); //generation wallet
                $Clubwallet = WalletType::find(19); //club wallet
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus

                if( empty( $officer->wallets()->wallet_type_id )  )
                {
                    $officer->wallets()->create(['wallet_type_id' => $OfficerWallet->id]);
                    $officer->wallets()->create(['wallet_type_id' => $AssedMoney->id]);
                    $officer->wallets()->create(['wallet_type_id' => $CashMoney->id]);
                    $officer->wallets()->create(['wallet_type_id' => $GenerationWallet->id]);
                    $officer->wallets()->create(['wallet_type_id' => $Clubwallet->id]);
                    $officer->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $officer->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $officer->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);

                    //assed money
                    $assedmoney = $officer->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $officer->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $officer->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $officer->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonuscash = $officer->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonuscash->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonuscash->balance; 
                    
                    // Performance bonus by book
                    $BestPerformancecash = $officer->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $officer->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                    
                }
                else
                {

                    //assed money
                    $assedmoney = $officer->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $officer->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $officer->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $officer->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $officer->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $officer->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $officer->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                }     
            }

            // Sponsor bonus two
            if( !empty($subofficer) )
            {
                // officer payment
                $OfficerWallet = WalletType::find(32); //pending
                $AssedMoney = WalletType::find(7); //Assed money
                $CashMoney = WalletType::find(9); //cash money
                $serviceChargewallet = WalletType::find(13); //Service wallet
                $GenerationWallet = WalletType::find(20); //generation wallet
                $Clubwallet = WalletType::find(19); //club wallet
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus

                if( empty( $subofficer->wallets()->wallet_type_id )  )
                {
                    $subofficer->wallets()->create(['wallet_type_id' => $OfficerWallet->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $AssedMoney->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $CashMoney->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $GenerationWallet->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $Clubwallet->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $subofficer->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);
                    
                   
                    //assed money
                    $assedmoney = $subofficer->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $subofficer->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $subofficer->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $subofficer->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonusincrement = $subofficer->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonusincrement->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonusincrement->balance; 
                    
                    // Performance bonus by book
                    $BestPerformancecash = $subofficer->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $subofficer->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                    
                }
                else
                {
                   
                    //assed money
                    $assedmoney = $subofficer->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $subofficer->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $subofficer->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $subofficer->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $subofficer->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $subofficer->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $subofficer->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                }     
            }

            // Sponsor bonus three
            if( !empty($sponsorthree) )
            {
                // officer payment
                $OfficerWallet = WalletType::find(32); //pending
                $AssedMoney = WalletType::find(7); //Assed money
                $CashMoney = WalletType::find(9); //cash money
                $serviceChargewallet = WalletType::find(13); //Service wallet
                $GenerationWallet = WalletType::find(20); //generation wallet
                $Clubwallet = WalletType::find(19); //club wallet
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus

                if( empty( $sponsorthree->wallets()->wallet_type_id )  )
                {
                    $sponsorthree->wallets()->create(['wallet_type_id' => $OfficerWallet->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $AssedMoney->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $CashMoney->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $GenerationWallet->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $Clubwallet->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $sponsorthree->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);
                    
                    //assed money
                    $assedmoney = $sponsorthree->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorthree->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorthree->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorthree->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonusincremet = $sponsorthree->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonusincremet->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonusincremet->balance; 
                    
                    // Performance bonus by book
                    $BestPerformancecash = $sponsorthree->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorthree->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                    
                }
                else
                {
                    
                    //assed money
                    $assedmoney = $sponsorthree->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorthree->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorthree->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorthree->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $sponsorthree->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $sponsorthree->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorthree->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                }
            }

            // Sponsor bonus four
            if( !empty($sponsorfour) )
            {
                // officer payment
                $OfficerWallet = WalletType::find(32); //pending
                $AssedMoney = WalletType::find(7); //Assed money
                $CashMoney = WalletType::find(9); //cash money
                $serviceChargewallet = WalletType::find(13); //Service wallet
                $GenerationWallet = WalletType::find(20); //generation wallet
                $Clubwallet = WalletType::find(19); //club wallet
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus

                if( empty( $sponsorfour->wallets()->wallet_type_id )  )
                {
                    $sponsorfour->wallets()->create(['wallet_type_id' => $OfficerWallet->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $AssedMoney->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $CashMoney->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $GenerationWallet->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $Clubwallet->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $sponsorfour->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);
                    
                    //assed money
                    $assedmoney = $sponsorfour->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorfour->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorfour->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorfour->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $sponsorfour->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance; 
                    
                    // Performance bonus by book
                    $BestPerformancecash = $sponsorfour->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorfour->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                    
                }
                else
                {
                    
                    //assed money
                    $assedmoney = $sponsorfour->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorfour->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorfour->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorfour->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $sponsorfour->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $sponsorfour->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorfour->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                }
            }

            // Sponsor Bonus five 
            if( !empty($sponsorfive) )
            {
                // officer payment
                $OfficerWallet = WalletType::find(32); //pending
                $AssedMoney = WalletType::find(7); //Assed money
                $CashMoney = WalletType::find(9); //cash money
                $serviceChargewallet = WalletType::find(13); //Service wallet
                $GenerationWallet = WalletType::find(20); //generation wallet
                $Clubwallet = WalletType::find(19); //club wallet
                $NonSponsorBuns = WalletType::find(17); //nonsponsor bonus
                $PerformanceBonus = WalletType::find(15); //Perfoamance bonus

                if( empty( $sponsorfive->wallets()->wallet_type_id )  )
                {
                    $sponsorfive->wallets()->create(['wallet_type_id' => $OfficerWallet->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $AssedMoney->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $CashMoney->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $GenerationWallet->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $Clubwallet->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $NonSponsorBuns->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $PerformanceBonus->id]);
                    $sponsorfive->wallets()->create(['wallet_type_id' => $serviceChargewallet->id]);
           

                    //assed money
                    $assedmoney = $sponsorfive->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorfive->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorfive->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorfive->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $sponsorfive->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance; 
                    
                    // Performance bonus by book
                    $BestPerformancecash = $sponsorfive->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorfive->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                    
                }
                else
                {
                   
                    //assed money
                    $assedmoney = $sponsorfive->wallet('Assets Money');
                    $assedmoney->incrementBalance($assettotalcash);
                    $assedmoney->balance;

                    //cash money
                    $cashmoney = $sponsorfive->wallet('Cash Money');
                    $cashmoney->incrementBalance($cashtotalcash-3000);
                    $cashmoney->balance;

                    // Generation bonus
                    $GenerationBonuscash = $sponsorfive->wallet('Generation Bonus');
                    $GenerationBonuscash->incrementBalance($fivegeneratiobonus);
                    $GenerationBonuscash->balance;

                    // Club bonus                    
                    $clubbonus = $sponsorfive->wallet('Club Bonus');
                    $clubbonus->incrementBalance($clubBBonus);
                    $clubbonus->balance;

                    // Non-spnsor bonus 
                    $nonsponsorbonus = $sponsorfive->wallet('Non-Sponsor Bonus');
                    $nonsponsorbonus->incrementBalance($nonsponsorbonus);
                    $nonsponsorbonus->balance;

                    // Performance bonus by book
                    $BestPerformancecash = $sponsorfive->wallet('Best Performance');
                    $BestPerformancecash->incrementBalance($BestPerformance);
                    $BestPerformancecash->balance;

                    // Service charge
                    $vat_tax = $sponsorfive->wallet('Vat And Text');
                    $vat_tax->incrementBalance($serviceCharge);
                    $vat_tax->balance;
                }
            }

        }
        else
        {
            $notification = array(
                'message'       => 'বুকিং পেমেন্ট ডিউ রয়েছে!!!',
                'alert-type'    => 'warning'
            );

            return back()->with($notification);
        }

        $bookings->save();



        $user = User::where('id', auth()->user()->referrer_id)->get();
        Notification::send($user, new BookingApproveNotification($bookings));

        $bookinguser = User::where('id', $bookings->id)->get();
        Notification::send($bookinguser, new BookingApproveNotification($bookings));

        $notification = array(
            'message'       => 'বুকিং এপ্রুভ করা হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);
    }
    /**
     * Notification Function.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifyread(Request $request, $id)
    {
   
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' =>true, 'message'=> 'mark as read!!!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bookings = Booking::find($id);
        return view('Backend.booking.show', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $divisions = Division::all();
        $booking = Booking::find($id);
        
        if( !is_null($booking) )
        {
            return view('Backend.booking.edit', compact('booking', 'divisions'));
        }
        else{
            $notification = array(
                'message'       => 'ডাটা খুজে পাচ্ছি না!!!',
                'alert-type'    => 'warning'
            );

            return back()->with($notification);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $booking = Booking::find($id);

        $booking->bookingid         =   rand(0, 9999999);
        $booking->bookingauthid     =   auth()->user()->id;
        $booking->name              =   $request->name;
        $booking->phonenumber       =   $request->phonenumber;
        $booking->religion          =   $request->religion;
        $booking->nationality       =   $request->nationality;
        $booking->nidnumber         =   $request->nidnumber;
        $booking->dob               =   $request->dob;
        $booking->maritalstatus     =   $request->maritalstatus;
        $booking->fathername        =   $request->fathername;
        $booking->fatherphone       =   $request->fatherphone;
        $booking->mothername        =   $request->mothername;
        $booking->motherphone       =   $request->motherphone;
        $booking->spousename        =   $request->spousename;
        $booking->spousephonenumber =   $request->spousephonenumber;
        $booking->flatorhouse       =   $request->flatorhouse;
        $booking->divisionid        =   $request->division;
        $booking->districtid        =   $request->district;
        $booking->thanaid           =   $request->thana;
        $booking->ppostoffice       =   $request->ppostoffice;
        $booking->ppostcode         =   $request->ppostcode;
        $booking->permanenthouse    =   $request->permanenthouse;
        $booking->permanetdivisionid =   $request->permanetdivision;
        $booking->permanentdistrictid =   $request->permanentdistrict;
        $booking->permanentthanaid  =   $request->permanentthana;
        $booking->permanentpostoffice =   $request->permanentpostoffice;
        $booking->permanentpostcode =   $request->permanentpostcode;
        $booking->nominyname        =   $request->nominyname;
        $booking->nominyphone       =   $request->nominyphone;
        $booking->nominyaddress     =   $request->nominyaddress;
        $booking->nominynid         =   $request->nominynid;
        $booking->nominyrelatoin    =   $request->nominyrelatoin;
        $booking->referelname       =   $request->referelname;
        $booking->referelphone      =   $request->referelphone;
        $booking->referelemail      =   $request->referelemail;
        $booking->flatvalue         =   $request->flatvalue;
        $booking->bookingmoney      =   $request->bookingmoney;
        $booking->bookingmoneymehtod =   $request->bookingmoneymehtod;
        $booking->banktransaction   =   $request->banktransaction;
        $booking->bankreferenceno   =   $request->bankreferenceno;
        $booking->bkashtransiction  =   $request->bkashtransiction;
        $booking->bkashnumber       =   $request->bkashnumber;
        $booking->nagadtransiction  =   $request->nagadtransiction;
        $booking->nagadnumber       =   $request->nagadnumber;
        $booking->rockettransiction =   $request->rockettransiction;
        $booking->rocketnumber      =   $request->rocketnumber;

        $booking->save();

        $notification = array(
            'message'       => 'ডাটা আপডেট সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('bbooking.manage')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $delete = Booking::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "ডিলেট সম্পন্ন হয়েছে!!!";
            
        } else {
            $success = true;
            $message = "ডিলেটে ত্রুটি রয়েছে!!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
