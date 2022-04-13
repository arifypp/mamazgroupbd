@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','ড্যাশবোর্ড')
@section('body')
{{-- Profile section  --}}
<section class="profile-section">
   <div class="container">
      <div class="main-body">
         <div class="mobiledevice">
            <div class="row">
               <div class="col-md-3">
               </div>
               <div class="col-md-9">
                  <div class="topbar1">
                     <h5>ড্যাশবোর্ড</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-9 "style="background-color: #F8FAFD;">
            <div class="uppderdesign">
               <div class="row">
                  <div class="col-md-12">

@php 
   $booking = App\Models\Frontend\Booking::where('user_id', Auth::user()->id)->first();   
@endphp
@if( !empty( $booking ) )
@php 
$bookingAmount   = $booking->bookingcash;
   $paidamount = $bookingAmount - $booking->dueamount;
   
   $percentageamount = $paidamount / $bookingAmount;
@endphp
<div class="alert alert-danger my-5" role="alert">
   <label for="">আপনার বুকিং টাকা এখনো ডিউ রয়েছে?</label>
<div class="progress col-md-12">
  <div class="progress-bar bg-danger" role="progressbar" style="width: {{\Illuminate\Support\Str::limit($percentageamount, 4, '')}}%;" aria-valuenow="{{\Illuminate\Support\Str::limit($percentageamount, 4, '')}}" aria-valuemin="0" aria-valuemax="100">{{\Illuminate\Support\Str::limit($percentageamount, 4, '')}}%</div>
</div>

<a href="#" data-bs-toggle="modal" data-bs-target="#duepayment{{ $booking->id }}" class="btn btn-danger btn-sm mt-2 py-1 text-light text-right" style="float:right;">পে ডিউ পেমেন্ট</a>
</div>
<!-- Modal -->
<div class="modal fade" id="duepayment{{ $booking->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ $booking->user->name }} এর বুকিং ডিউ আছে</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
           @csrf
           <div class="col-md-12">
              <div class="alert alert-warning">
                 <span>আপনার ডিউ রয়েছে: ৳{{ $booking->dueamount }} BDT</span>
              </div>
              <div class="form-group">
                 <label for="Amount">টাকা পরিমান বসান</label>
                 <input type="number" name="amount" id="amount" class="form-control">
              </div>
              <div class="row">
              <div class="col-md-6 justify-content-center align-self-center text-center">
                  <div class="card card-body">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Directly">
                        <label class="form-check-label" for="inlineRadio1">ডিরেক্টলি</label>
                     </div>                                
                  </div>                     
               </div>
               <div class="col-md-6 justify-content-center align-self-center text-center">
                  <div class="card card-body">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Cashbonus">
                        <label class="form-check-label" for="inlineRadio2">ক্যাশ বোনাস</label>
                     </div>                                
                  </div>                     
               </div>
              </div>
              <div class="form-group cashmoney" style="display:none;">
                  <label for="wallet_type">ওয়ালেট নিবার্চন করুন?</label>
                  <select name="wallet_type" id="wallet_type" class="form-control">
                        <option value="0">নির্বাচন করুন</option>
                        @php
                        $walletTypeID = CoreProc\WalletPlus\Models\WalletType::where('name', 'Cash Money')->get();
                        @endphp
                        @foreach( $walletTypeID as $key => $walletType )
                        <option value="{{ $walletType->id }}"> {{ $walletType->name }} </option>
                        @endforeach
                  </select>
                  <span id="walletamountresult"></span>
               </div>
           </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
        <button type="button" class="btn btn-primary">পে করুন</button>
      </div>
    </div>
  </div>
</div>
@endif
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/1.png') }}" alt="" class="mb-2" width="50"></span><br>
                              {{ App\Models\User::AssetMoney() }}
                           </h3>
                           <b>অ্যাসেড বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <a href="{{ route('send.widthdraw') }}" class="text-dark">
                        <div class="d-flex justify-content-center mt-7 px-7 cash-taka" data-toggle="modal" data-target="#Cashtaka">
                           <div class="stat">
                              <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/2.png') }}" alt="" class="mb-2" width="50"></span><br>
                              {{ App\Models\User::CashMoney() }}                                
                              </h3>
                              <b>ক্যাশ বোনাস</b>
                           </div>
                        </div>
                     </a>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 cash-taka" data-toggle="modal" data-target="#Cashtaka">
                        <div class="stat">
                           <h3 class="mb-0 text-danger"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::PendingAmount() }}                                
                           </h3>
                           <b classt="text-danger" style="color:red;">পেন্ডিং টাকা</b> 
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 myagenttaka">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/3.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::AgentMoney() }}                               
                           </h3>
                           <b>এজেন্ট টাকা</b>
                        </div>
                     </div>
                  </div>
                 
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 charitymoney">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/4.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::CharityMoney() }}
                           </h3>
                           <b>চ্যারিটি দান টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="charitymoney" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">চ্যারিটি দান টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                           আল্লাহ তাআলা বলেন, 'যদি তোমরা দান প্রকাশ্যে করো, তবে তা উত্তম; আর যদি তা গোপনে করো এবং অভাবীদের দাও, তবে তা তোমাদের জন্য শ্রেয়। ... এতে দানের ফজিলত বিনষ্ট হয়। আল্লাহ তাআলা বলেন, 'সদ্ব্যবহার, সুন্দর কথা ওই দান অপেক্ষা উত্তম, যার পেছনে আসে যন্ত্রণা। আল্লাহ তাআলা ঐশ্বর্যশালী ও পরম সহিষ্ণু।

                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/5.png') }}" alt="" class="mb-2" width="50"></span><br>
                              {{ App\Models\User::VatTaxCost() }}
                           </h3>
                           <b>ভ্যাট / ট্যাক্স</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::MamazPoisa() }}
                           </h3>
                           <b>মামাজ পয়সা</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                              {{ App\Models\User::BestPerfomance() }}
                           </h3>
                           <b>পারফোরমেন্স বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                              {{ App\Models\User::LandCoverageBonus() }}
                           </h3>
                           <b>ল্যান্ড কভারেজ বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::NonSponsorbonus() }}
                           </h3>
                           <b>নন স্পনসর বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::ClubBonus() }}
                           </h3>
                           <b>ক্লাব বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::FounderShip() }}
                           
                           </h3>
                           <b>ফাউন্ডারশিপ বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::FollowUpBonus() }}
                           </h3>
                           <b>ফলোআপ বোনাস</b>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::MamazDevelopmentFound() }}
                           
                           </h3>
                           <b>ডেভেলোপমেন্ট বোনাস</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           {{ App\Models\User::GenerationBonus() }}

                           </h3>
                           <b>জেনেরেশন বোনাস</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="card">
                     <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <img src="https://media2.4life.com/images/announcements/DBB_020122_FEB_DB2022_ENG_20220201082652.jpg" class="d-block w-100" alt="...">
                           </div>
                           <div class="carousel-item">
                              <img src="https://media2.4life.com/images/announcements/February_Product_Special_eng_20220131174124.jpg" class="d-block w-100" alt="...">
                           </div>
                           <div class="carousel-item">
                              <img src="https://media2.4life.com/images/announcements/PreZoom-Launch-202201_Dashboard-Ad-Launch_ENG_20220121083020.jpg" class="d-block w-100" alt="...">
                           </div>
                        </div>
                        
                     </div>
                     
                     <div class="col-md-12 my-3 text-center">
                        <a href="javascript:void(0)" class="btn btn-info btn-block "> <i class="fab fa-facebook-f"></i> Join Affiliate Group</a>
                     </div>
                     <div class="col-md-12 my-3 text-center">
                        <a href="javascript:void(0)" class="btn btn-primary btn-block "> <i class="fab fa-facebook-f"></i> Join Our Facebook</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card p-3">
                     <div class="builder-bonus-dashboard text-center">
                        <div class="builder-third-holder row">
                           <div class="col">
                              <div class="builder-third">
                                 <small class="light-gray-text"><span class="doublebb">7 Shares</span></small>
                                 <img src="{{ asset('assets/images/badge/1 star.svg') }}">
                                 <small class="light-gray-text">Not qualified</small>
                              </div>
                           </div>
                           <div class="col">
                              <div class="builder-third">
                                 <small class="light-gray-text"><span class="doublebb">14 Shares</span></small>
                                 <img src="{{ asset('assets/images/badge/2 star.svg') }}">
                                 <small class="light-gray-text">Not qualified</small>
                              </div>
                           </div>
                           <div class="col">
                              <div class="builder-third">
                                 <samll class="light-gray-text"><span class="doublebb">21 Shares</span></samll>
                                 <img src="{{ asset('assets/images/badge/3 star.svg') }}">
                                 <small class="light-gray-text">Not qualified</small>
                              </div>
                           </div>
                           <div class="col">
                              <div class="builder-third">
                                 <small class="light-gray-text"><span class="doublebb">28 Shares</span></small>
                                 <img src="{{ asset('assets/images/badge/4 star.svg') }}">
                                 <small class="light-gray-text">Not qualified</small>
                              </div>
                           </div>
                           <div class="col">
                              <div class="builder-third">
                                 <small class="light-gray-text"><span class="doublebb">35 Shares</span></small>
                                 <img src="{{ asset('assets/images/badge/5 star.svg') }}">
                                 <small class="light-gray-text">Not qualified</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card p-3 text-dark">
                     <div class="card-title">
                        <a href="#">Target Rank &nbsp; <i class="fas fa-link"></i> </a>
                        <select name="level" id="level" style="float:right;">
                           @foreach(App\Models\Backend\PromoteLevel::all() as $levelname)
                           <option value="{{ $levelname->id }}">{{ $levelname->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  <ul class="nav nav-pills" id="pills-tab" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-lastmonth-tab" data-bs-toggle="pill" data-bs-target="#pills-lastmonth" type="button" role="tab" aria-controls="pills-lastmonth" aria-selected="true">
                           @php                            
                              $lastMonth = \Carbon\Carbon::now();
                             $lastmonthname =  $lastMonth->subMonth()->format('F Y');
                              echo $lastmonthname;
                           @endphp
                        </button>
                     </li>
                     <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-currentMonth-tab" data-bs-toggle="pill" data-bs-target="#pills-currentMonth" type="button" role="tab" aria-controls="pills-currentMonth" aria-selected="false">{{ date('F Y') }}</button>
                     </li>
                     
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-lastmonth" role="tabpanel" aria-labelledby="pills-home-tab">
                           <ul id="LevelMsg">
                              <li>
                              <small>রেফারেন্স ইউজার ৭জন তৈরি করা সম্পূর্ণ হয়নি এখনো।</small>
                              <div class="progress" style="height: 2px;">
                                 <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              </li>
                              <li>
                              <small>রেফারেন্স ইউজার বুকিং সম্পূর্ণ হয়নি এখনো, তাদের সাথে যোগাযোগ করুন।</small>
                              <div class="progress" style="height: 2px;">
                                 <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              </li>
                           </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-currentMonth" role="tabpanel" aria-labelledby="pills-currentMonth-tab">
                           <ul id="LevelMsg">
                              <li>
                              <small>রেফারেন্স ইউজার ৭জন তৈরি করা সম্পূর্ণ হয়নি এখনো।</small>
                              <div class="progress" style="height: 2px;">
                                 <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              </li>
                              <li>
                              <small>রেফারেন্স ইউজার বুকিং সম্পূর্ণ হয়নি এখনো, তাদের সাথে যোগাযোগ করুন।</small>
                              <div class="progress" style="height: 2px;">
                                 <div class="progress-bar" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              </li>
                           </ul>
                        </div>
                        </div>
                     </div> 
                  </div>
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-header">
                           <i class="fas fa-cog"></i>  Tools
                        </div>
                        <div class="card-body">
                           <ul class="list-group list-group-flush">
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('booking.manage') }}">বুকিং দিন</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('booking.list') }}">বুকিং লিস্ট</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('report.manage') }}">রিপোট লিস্ট</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('report.create') }}">রিপোট দিন</a> </li>                              
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                  <div class="card">
                        <div class="card-header">
                           <i class="fas fa-swatchbook"></i>  Resource
                        </div>
                        <div class="card-body">
                           <ul class="list-group list-group-flush text-dark">
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('user.referel', Auth::user()->id ) }}">আপনার গ্রাহককে ইনভাইট করুন</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('user.reflist', Auth::user()->username ) }}">রেফারেল ইউজার লিস্ট</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('contact') }}">যোগাযোগ করুন</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="{{ route('services') }}">সার্ভিস সমূহ</a> </li>                              
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</section>
<!-- Level Promotion modal  -->
{!! App\Models\User::PromotionMsg() !!}

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.0/js.cookie.js"></script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

<script>
   // agent users
   $("input[type='radio']").click(function () {
   radioVal = $(this).val();
   if( radioVal == 'Cashbonus' )
   {
      $(".cashmoney").show();
   }
   else{
      $(".cashmoney").hide();
   }

   });
   // A $( document ).ready() block.
   $( document ).ready(function() {
      
      // Charity money 
      
      $(".charitymoney").click(function(){
         $("#charitymoney").scrollTop(0);
         $('#charitymoney').modal('show');
      });
      $("button[data-dismiss=modal]").click(function(){
        $(".modal").modal('hide');
      });

      // Show mamaz poisha
      $(function () {
        $("#sendto").change(function () {
            if ($(this).val() == "Mamaz Money") {
                $("#mamazPoisha").show();
            } else {
                $("#mamazPoisha").hide();
            }
        });

        $("#sendtoag").change(function () {
            if ($(this).val() == "Mamaz Money") {
                $("#mamazPoishaAg").show();
            } else {
                $("#mamazPoishaAg").hide();
            }
        });        
    });
   });

   $(document).ready(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
         localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
         $('#myTab a[href="' + activeTab + '"]').tab('show');
      }
   });

   $(document).ready(function () {
            $('#level').on('change', function () {
                var idCountry = this.value;
               //  console.log(idCountry);
                $("#LevelMsg").html('');
                $.ajax({
                    url: "{{ route('promote.fetchmessage') }}",
                    type: "POST",
                    data: {
                        levels_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        var obj = ( result );
                        console.log(result);
                        // $('#state-dd').html('<option value="">Select State</option>');
                        $.each(obj, function (key, value) {
                           $("#LevelMsg").append('<li>'+'<small>' + value.name + '</small>'
                           + '<div class="progress" style="height: 2px;">'+ '<div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>'+
                           '</div>' +'</li>');
                           console.log(value.name);
                        });
                        // $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
   });

   $(document).ready(function(){
        setTimeout(function(){
            if(!Cookies.get('modalShown')) {
                $("#PromoteLevel").modal('show');
                Cookies.set('modalShown', true);
            } else {
                console.log('Your modal won\'t show again as it\'s shown before.');
            }
        },1000);
    })

    $(document).ready(function() {
        $('#promotelevelupdate').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var token = '{{ Session::token() }}';
            var auth_id = '{{ Auth::user()->id }}';
            $.ajax({
                    type:'POST',
                    url:'/auth/promotion/'+auth_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data : {id:auth_id, _token: token},
                    success:function(data){
                        if(data.success){
                            console.log('Success for read notification');
                            // window.location= href;
                        }
                    }
                });
        })
    });

        // Need to know price
        $(document).ready(function() {
        $("#wallet_type, #amount").change(function(){
            var wallet_id = $("#wallet_type").val();

            var withdrawcharge = "{{ config('bonus_settings.withdrawcharge') }}";

            $.ajaxSetup({
            headers: {
                    "X-CSRFToken": '{{csrf_token()}}'
                }
            });

            $.ajax({
                    method : 'POST',
                    url : "{{ url('/widthdarw/amount/request') }}/"+ wallet_id,
                    data: {"_token": "{{ csrf_token() }}", "id": wallet_id},
                    success: function(response) {
                        var mamazpoisha = $("#amount").val();

                        if( mamazpoisha == '' )
                        {
                            alert("টাকার পরিমান যুক্ত করুন।");
                        }
                        else
                        {
                            var chargeamount = (mamazpoisha) / 100 * withdrawcharge;
                            var totalamount = +(mamazpoisha) + (chargeamount);
                            if(response){
                                $('#walletamountresult').html('<span class="text-info">আপনার বর্তমান এমাউন্ট আছে ৳'+response+'</span>');
                            };

                            $("#resultmpoisha").html("<center><h2 class='text-success'>"+"৳"+totalamount+" টাকা"+"</h2></center>"+"<div class='alert alert-success'>"+"সার্ভিস চার্জ ৳"+chargeamount +" টাকা</div>");
                        }
                        
                                  
                },
                error:function (response){
                    $('.text-danger').html('');
                    $('.text-danger').delay(5000).fadeOut();
                    $.each(response.responseJSON.error,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                    })
                }
            })
        });
    });
</script>
@endsection