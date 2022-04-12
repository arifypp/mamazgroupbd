@extends('Backend.Agent.includes.main')

@section('title') বুকিং তথ্য @endsection

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
        @slot('li_1') বুকিং @endslot
        @slot('title') বুকিং এর বিবরণ @endslot
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
                                    <th>বুকিং আইডি:</th>
                                    <td>:</td>
                                    <td>{{ $bookings->bookingid }}</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-12 mt-4">
                      <center>
                          <h3 class="font-weight-bold"> <strong>মামাজ বুকিং তথ্য</strong> </h3>
                          <h5>সাভার, ঢাকা ।</h5>
                      </center>
                      <hr>
                  </div>
                  <div class="col-md-12 booking_info">
                      <div class="row">
                        <div class="col-md-12 mb-2">
                            <table class="table-responsive align-middle w-100 text-nowrap overflow-hidden">
                                <tbody>
                                    <!-- Registration Info -->
                                    <tr class="d-flex mb-2">
                                        <td>রেজিস্ট্রেশন নং</td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333"> {{ $bookings->bookingid }} </td>
                                        <td>তারিখ</td>
                                        <td>- &nbsp</td>
                                        <td class="col-3" style="border-bottom:1px dashed #333">{{ date('d-m-Y', strtotime($bookings->created_at));}} </td>
                                    </tr>
                                    <!-- Name Info -->
                                    <tr class="d-flex mb-2">
                                        <td >নাম</td>
                                        <td>- &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333"><strong>{{ $bookings->name }}</strong> </td>
                                    </tr>
                                    <!-- Date of birth info -->
                                    <tr class="d-flex mb-2">
                                        <td>জন্ম তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($bookings->dob));}}
                                        </td>
                                        <td>ধর্ম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->religion }}
                                        </td>
                                    </tr>
                                    <!-- National ID No Info -->
                                    <tr class="d-flex mb-2">
                                        <td>জাতীয় পরিচয় পত্র নম্বর </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nidnumber}}
                                        </td>
                                        <td>জাতীয়তা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nationality }}
                                        </td>
                                    </tr>
                                    <!-- Mother Info -->
                                    <tr class="d-flex mb-2">
                                        <td>মাতার নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->mothername}}
                                        </td>
                                        <td>মাতার মোবাইল নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->motherphone }}
                                        </td>
                                    </tr>
                                    <!-- Father Info -->
                                    <tr class="d-flex mb-2">
                                        <td>পিতার নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->fathername}}
                                        </td>
                                        <td>পিতার মোবাইল নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->fatherphone }}
                                        </td>
                                    </tr>
                                    <!-- Spouse Info  -->
                                    <tr class="d-flex mb-2">
                                        <td>স্বামী/স্ত্রীর নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->spousename}}
                                        </td>
                                        <td>স্বামী/স্ত্রীর মোবাইল নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->spousephonenumber }}
                                        </td>
                                    </tr>
                                    <!-- Present Address Info  -->
                                    <tr class="d-flex mb-2">
                                        <td>বর্তমান ঠিকানা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            {{ $bookings->flatorhouse }}, {{ $bookings->ppostoffice }}, {{ $bookings->ppostcode }}, {{ $bookings->thana->bn_name }}, {{ $bookings->district->bn_name }}, {{ $bookings->division->bn_name }} ।
                                        </td>
                                    </tr>
                                    <!-- Permanent Address Info  -->
                                    <tr class="d-flex mb-3">
                                        <td>স্থায়ী ঠিকানা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            {{ $bookings->permanenthouse }}, {{ $bookings->permanentpostoffice }}, {{ $bookings->permanentpostcode }}, {{ $bookings->pthana->bn_name }}, {{ $bookings->pdistrict->bn_name }}, {{ $bookings->pdivision->bn_name }} ।
                                        </td>
                                    </tr>
                                    <!-- Nominy Details -->
                                    <tr class="mb-0">
                                        <td class="col-12 m-0 p-0">
                                            <center>
                                                <h5 class="m-0">নমিনীর তথ্য</h5>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr class="d-flex mb-2">
                                        <td>নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            <strong>{{ $bookings->nominyname }}</strong> 
                                        </td>
                                    </tr>
                                    <tr class="d-flex mb-2">
                                        <td>নমীনির ঠিকানা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nominyaddress }}
                                        </td>
                                        <td>নমিনীর মোবাইল নাম্বার </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nominyphone}}
                                        </td>
                                    </tr>
                                    <tr class="d-flex mb-3">
                                        <td>ভোটার আইডি নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nominynid }}
                                        </td>
                                        <td>নমীনির সাথে সম্পর্ক </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $bookings->nominyrelatoin}}
                                        </td>
                                    </tr>
                                    <!-- Referel User -->
                                    <tr class="mb-0">
                                        <td class="col-12 m-0 p-0">
                                            <center>
                                                <h5 class="m-0">রেফারেল ইউজার তথ্য</h5>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr class="d-flex mb-2">
                                        <td>নাম </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            <strong>{{ $bookings->referelname }}</strong> 
                                        </td>
                                    </tr>
                                    <tr class="d-flex mb-3">
                                        <td>রেফারেল মোবাইল নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-4" style="border-bottom:1px dashed #333">
                                            {{ $bookings->referelphone }}
                                        </td>
                                        <td>রেফারেল ইমেইল </td>
                                        <td> - &nbsp</td>
                                        <td class="col-8" style="border-bottom:1px dashed #333">
                                            {{ $bookings->referelemail}}
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
                     <img src="{{ asset($bookings->user->avatar) }}" class="img-fluid" alt="User Image" width="100">
                     <hr>
                </div>
               <table class="table table-responsive w-100 align-middle text-nowrap overflow-hidden">
                    <tbody>
                        <tr>
                            <td class="col-8">প্লট বা জমির পরিমান -</td>
                            <td class="col-4">{{ $bookings->landvalue }} SFT</td>
                        </tr>
                        <tr>
                            <td class="col-7">বুকিং টাকার পরিমাণ -</td>
                            <td class="col-5">{{ $bookings->total_flat_price }} BDT</td>
                        </tr>
                        <tr>
                            <td class="col-7">কিস্তি টাকার পরিমাণ -</td>
                            <td class="col-5">{{ $bookings->kistypayment }} BDT</td>
                        </tr>
                        <tr>
                            <td class="col-7">মোট টাকার পরিমাণ -</td>
                            <td class="col-5">{{ $bookings->total_flat_price }} BDT</td>
                        </tr>
                    </tbody>
               </table>
               
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