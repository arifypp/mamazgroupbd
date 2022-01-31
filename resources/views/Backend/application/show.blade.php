@extends('layouts.master')

@section('title') আবেদনকারীর তথ্য @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        
    .booking_info::before {
        background: url('/assets/images/settings/242798957.png');
        width: 100%;
        content: "";
        height: 100px;
        position: absolute;
        left: 0;
        right: 0;
        top: 30%;
        text-align: center;
        align-self: center;
        justify-content: center;
        background-repeat: no-repeat;
        background-position: center;
        opacity: 0.1;
        transform: scale(6);
        background-color: white;
    }
    </style>
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') আবেদনকারীর @endslot
        @slot('title') আবেদনকারীর এর বিবরণ @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-12">
            <div class="card card-body">
              <div class="row">
                  <div class="col-md-6">
                        <table class="table-responsive align-middle">
                            <tbody>
                                <tr>
                                @foreach( $site_settings as $value )
                                    <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="Mamaz" class="img-fluid" width="100">
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-6">
                        <table  class="table-responsive align-middle text-right float-md-right" style="float:right;">
                            <tbody>
                                <tr>
                                    <th>আবেদন পত্র নম্বর</th>
                                    <td>:</td>
                                    <td>{{ $application->id }}</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-12 mt-4">
                      <center>
                          <h3 class="font-weight-bold"> <strong>আবেদনকারীর তথ্য</strong> </h3>
                          <h5>সাভার, ঢাকা ।</h5>
                      </center>
                      <hr>
                  </div>
                  <div class="col-md-12 booking_info">
                      <div class="row">
                        <div class="col-md-12 mb-2">
                            <table class="table-responsive align-middle w-100 text-nowrap overflow-hidden">
                                <tbody>
                                    @php 
                                        $booking = App\Models\Frontend\Booking::where('bookingauthid', $application->auth_id)->get();
                                    @endphp
                                    <tr class="d-flex mb-2">
                                        বরাবর,<br>
                                        ব্যবস্থাপনা পরিচালক (আবেদনকারী-ছবি-৩)(নোমেনি-ছবি ৩)(পরিচয় দানকারী ছবি -৩)কপি<br>
                                        মামাজ প্রপার্টি ডেভেলোপমেন্ট প্রাইভেট লিঃ<br>
                                        হাউজ-৩১/১, ফ্ল্যাট-৪/এ, আনন্দপুর, সাভার, ঢাকা - ১৩৪০।<br>
                                        <br>
                                        <strong>বিষয়ঃ কাজে যোগদান প্রসঙ্গে ।</strong> <br><br>
                                        জনাব, <br>
                                        সবিনয় নিবেদন এই যে, আমি গত ‍<span style="border-bottom:1px dashed #333"> {{ date('d-m-Y', strtotime($booking[0]->created_at));}} </span> তারিখে একটি {{ $booking[0]->flatvalue }} স্কয়ারফিট ফুল ফার্নিসড স্টুডিও এপার্টমেন্ট কোম্পানি কর্তৃক বহুতল ভিত্তিক ভবনের নির্মানানুসারে নিদিষ্ট জমির জন্যে আবেদন বাবত অফেরতযোগ্য বুকিং মানি দিয়েছি। আমি কোম্পানির বিশ্বস্ত সূত্রে পরিচয় প্রদানকারী হতে জানতে পারলাম যারা রেগুলার কিস্তি দিতে অক্ষম, তাদের জন্যে কাজের মাধ্যমে যোগ্যতানুযায়ী বেতন ও অতিরিক্ত কাজের জন্য বোনাস দিয়ে কিস্তি পরিশোধ করার সুযোগ আছে। আমর প্রয়োজনে জীবণকে সহজকরণ করার জন্যে উক্ত সুযোগ পাওয়ার নিমিত্তে আগ্রহী প্রার্থী হিসেবে ‍নিম্নে আমার জীবন বৃত্তান্ত যোগ্যতা ও অভিজ্ঞতা আপনার সদয় বিবেচনার জন্য উপস্থাপন করলাম।
                                    </tr>
                                    <!-- Registration Info -->
                                    <tr class="d-flex mb-2 justify-content-center text-justify">
                                        <td> আবেদন নং</td>
                                        <td> - &nbsp; </td>
                                        <td class="col-7" style="border-bottom:1px dashed #333"> {{ $application->id }} </td>
                                        <td>তারিখ</td>
                                        <td>- &nbsp</td>
                                        <td class="col-3" style="border-bottom:1px dashed #333">{{ date('d-m-Y', strtotime($application->created_at));}} </td>
                                    </tr>
                                    <!-- Name Info -->
                                    <tr class="d-flex mb-2">
                                        <td >নাম</td>
                                        <td>- &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333"><strong>{{ $application->name }}</strong> </td>
                                    </tr>
                                    <!-- Date of birth info -->
                                    <tr class="d-flex mb-2">
                                        <td>জন্ম তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($application->dob));}}
                                        </td>
                                        <td>ধর্ম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $application->religion }}
                                        </td>
                                    </tr>
                                    <!-- National ID No Info -->
                                    <tr class="d-flex mb-2">
                                        <td>জাতীয় পরিচয় পত্র নম্বর </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $application->nidnumber}}
                                        </td>
                                        <td>জাতীয়তা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $application->nationality }}
                                        </td>
                                    </tr>
                                    <!-- Mother Info -->
                                    <tr class="d-flex mb-2">
                                        <td>মাতার নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $application->mothername}}
                                        </td>
                                        <td>পিতার নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                        {{ $application->fathername}} 
                                        </td>
                                    </tr>
                                    <!-- Present Address Info  -->
                                    <tr class="d-flex mb-2">
                                        <td>বর্তমান ঠিকানা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            {{ $application->presentaddress }} ।
                                        </td>
                                    </tr>
                                    <!-- Permanent Address Info  -->
                                    <tr class="d-flex mb-3">
                                        <td>স্থায়ী ঠিকানা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            {{ $application->permanentaddress }} ।
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12">
            <div class="card card-body">
                <div class="user-images text-center">
                     <img src="{{ asset($application->user->avatar) }}" class="img-fluid" alt="User Image" width="100">
                     <hr>
                </div>
               <table class="table table-responsive w-100 align-middle text-nowrap overflow-hidden">
                    <tbody>
                        <tr>
                            <td class="col-8">প্লট বা জমির পরিমান -</td>
                            <td class="col-4">{{ $booking[0]->flatvalue }} SFT</td>
                        </tr>
                        <tr>
                            <td class="col-7">বুকিং টাকার পরিমাণ -</td>
                            <td class="col-5">{{ $booking[0]->bookingmoney }} BDT</td>
                        </tr>
                    </tbody>
               </table>
               <div class="row">
                   <div class="col-md-12 m-auto text-center mb-4 mt-3">
                       <a href="{{ route('application.manage') }}" class="btn btn-danger waves-effect btn-label waves-light">
                       <i class="bx bx-block label-icon"></i>
                           ক্যানসেল
                        </a>
                       <a href="javascript:void(0)" id="approvecash" data-id="{{ $application->id }}" data-attr="{{ route('application.update', $application->id) }}" class="btn btn-success waves-effect btn-label waves-light">
                        <i class="bx bx-check label-icon"></i>
                           অ্যপ্রুভ করুন
                        </a>
                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-md-12 text-center">
                       <p>আমরা গ্রহণ করি</p>
                       <img src="{{ asset('assets/images/payment/all.png') }}" alt="logo" class="img-fluid">
                   </div>
               </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
      $(document).ready(function(){
      $(document).on("click", '#approvecash', function(e){
        e.preventDefault();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });

          var token = '{{ Session::token() }}';

          let href = $(this).attr('data-attr');
          let post_id = $(this).attr('data-id');

        //   console.log(post_id); 
          
          $.ajax({    
              type: 'POST',
              url: href,
              data : {id:post_id, _token: token},
              success:function(res){
                if(res.success){
                        toastr.success(res.message);
                        setTimeout(function(){location.reload();},5000);
                  }
              },
              error:function (res){
                    console.log("error");
                }
          });

          return false;
      })
    });
</script>

@endsection