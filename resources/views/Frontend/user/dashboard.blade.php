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
         <div class="col-md-9 "style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="uppderdesign">
               <div class="row">
                  <div class="col-md-3 offset-md-1">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           @php 
                           $user = auth()->user()->id; 
                           $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
                           @endphp
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/1.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>অ্যাসেট টাকা</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 cash-taka" data-toggle="modal" data-target="#Cashtaka">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/2.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 9)->get();
                              @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>ক্যাশ টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="Cashtaka" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">ক্যাশ টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <center>
                                 <h1>@if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif <sup class="text-success" style="font-size:10px;">Available Balance</sup></h1>
                              </center>
                              <form action="{{ route('addmoney.transfer') }}" method="post">
                                 @csrf
                                 <input type="hidden" name="amount" value="@if(!empty($wallet['0']) ){{$wallet['0']->raw_balance}}@else{{'0'}}@endif">
                                 <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                 <div class="form-group">
                                    <label for="Send To">Send To</label>
                                    <select name="sendto" id="sendto" class="form-control">
                                       <option value="0">Please Select Box </option>
                                       @php $wtype = CoreProc\WalletPlus\Models\WalletType::find([7, 11, 14]); @endphp
                                       
                                       @foreach( $wtype  as $key => $wallettypename )
                                       <option value="{{ $wallettypename->name }}">{{ $wallettypename->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="text-danger">@error('sendto'){{ $message }} @enderror</span><br>
                                    <div class="alert alert-danger" id="mamazPoisha" style="display:none">
                                       <span>
                                          মামাজ পয়সাতে ১০০ টাকা সমান ১ পয়সা, এভাবে হিসাব করে আপনার মামাজ পয়সাতে যোগ হয়।
                                       </span>
                                    </div>
                                 </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Transfer Now</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 myagenttaka">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/3.png') }}" alt="" class="mb-2" width="50"></span><br>
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 11)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           
                           </h3>
                           <b>এজেন্ট টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="AgentTaka" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">এজেন্ট টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <center>
                                 <h1>@if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif <sup class="text-success" style="font-size:10px;">Available Balance</sup></h1>
                              </center>
                              <form action="{{ route('addmoney.transferagentmoney') }}" method="post">
                                 @csrf
                                 <input type="hidden" name="amount" value="@if(!empty($wallet['0']) ){{$wallet['0']->raw_balance}}@else{{'0'}}@endif">
                                 <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                 <div class="form-group">
                                    <label for="Send To">Send To</label>
                                    <select name="sendtoag" id="sendtoag" class="form-control">
                                       <option value="0">Please Select Box </option>
                                       @php $wtype = CoreProc\WalletPlus\Models\WalletType::find([7, 9, 14]); @endphp
                                       
                                       @foreach( $wtype  as $key => $wallettypename )
                                       <option value="{{ $wallettypename->name }}">{{ $wallettypename->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="text-danger">@error('sendto'){{ $message }} @enderror</span><br>
                                    <div class="alert alert-danger" id="mamazPoishaAg" style="display:none;">
                                       <span>
                                          মামাজ পয়সাতে ১০০ টাকা সমান ১ পয়সা, এভাবে হিসাব করে আপনার মামাজ পয়সাতে যোগ হয়।
                                       </span>
                                    </div>
                                 </div>
                                 
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Transfer Now</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-3 offset-md-1">
                     <div class="d-flex justify-content-center mt-7 px-7 charitymoney">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/4.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @php 
                                 $user = auth()->user()->id; 
                                 $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 12)->get();
                              @endphp
                                 @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
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
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 13)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>ভ্যাট / ট্যাক্স</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 14)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>মামাজ পয়সা</b>
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
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">বুকিং দিন</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">বুকিং লিস্ট</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">রিপোট লিস্ট</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">রিপোট দিন</a> </li>                              
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
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">যোগাযোগ করুন</a> </li>
                              <li class="list-group-item"> <i class="fas fa-arrow-right"></i> <a href="#">সার্ভিস সমূহ</a> </li>                              
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>





<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="{{ asset('/admin/assets/images/cg.svg') }}" class="img-fluid" alt="Congrasulation" width="150"><br><br>
        <h1>স্বাগতম!!!</h1>
        <p>আপনি এখন মার্কেটিং এক্সিউটিভ পদে পদান্নিত হয়েছেন।</p>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">ধন্যবাদ!!!</button>
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
@endsection

@section('script')
<script>
   // A $( document ).ready() block.
   $( document ).ready(function() {
      // Cash taka 
      $(".cash-taka").click(function(){
         $("#Cashtaka").scrollTop(0);
         $('#Cashtaka').modal('show');
      });
      // Agent Taka 
      $(".myagenttaka").click(function(){
         $("#AgentTaka").scrollTop(0);
         $('#AgentTaka').modal('show');
      });
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
</script>
@endsection