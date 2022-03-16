@extends('Backend.Agent.includes.main')

@section('title') রিপোর্টস তথ্য @endsection

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
        @slot('li_1') রিপোর্টস @endslot
        @slot('title') রিপোর্টস এর বিবরণ @endslot
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
                                    <th>রিপোর্ট নম্বর</th>
                                    <td>:</td>
                                    <td>{{ $report->id }}</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-12 mt-4">
                      <center>
                          <h3 class="font-weight-bold"> <strong>রিপোটদান কারীর তথ্য</strong> </h3>
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
                                        <td>রিপোর্ট নং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $report->id }}
                                        </td>
                                        <td>রিপোট তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                        {{ date('d-m-Y', strtotime($report->created_at));}}
                                        </td>
                                    </tr>
                                    <!-- Name Info -->
                                    <tr class="d-flex mb-2">
                                        <td >নাম</td>
                                        <td>- &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333"><strong>{{ $report->name }}</strong> </td>
                                        <td>মোবাইল </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $report->phone }}
                                        </td>
                                    </tr>
                                    <!-- Date of birth info -->
                                    <tr class="d-flex mb-2">
                                        <td>ই-মেইল </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ $report->email}}
                                        </td>
                                        <td>ইনভাইট তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($report->invitedate)); }}
                                        </td>
                                    </tr>
                                    <!-- National ID No Info -->
                                    <tr class="d-flex mb-2">
                                        <td> অফিস ভিজিট তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($report->officevisitdate)); }}
                                        </td>
                                        <td>সাইট ভিজিট তারিখ </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($report->sidevisitdate)); }}
                                        </td>
                                    </tr>
                                    <!-- Mother Info -->
                                    <tr class="d-flex mb-2">
                                        <td>কাউন্সিলিং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-5" style="border-bottom:1px dashed #333">
                                            {{ $report->counsiling}} বার
                                        </td>
                                        <td> টার্গেট সেল বুকিং-ফ্রি </td>
                                        <td> - &nbsp</td>
                                        <td class="col-7" style="border-bottom:1px dashed #333">
                                        ৳ {{ str_replace(',', '', $report->targetfee) }} BDT
                                        </td>
                                    </tr>
                                    <!-- Highly wanted Info  -->
                                    <tr class="d-flex mb-2">
                                        <td> উচ্চকাঙ্খী </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                            {{ $report->hwant }} ।
                                        </td>
                                    </tr>
                                    <!-- Business Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> ব্যবসায়ী মনোভাব </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ $report->bthink }} ।
                                        </td>
                                    </tr>
                                    <!-- Mishuk Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> মিশুক  </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ $report->mishuk }} ।
                                        </td>
                                    </tr>
                                    <!-- Plan Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> প্লান শো  </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ $report->planshow }} ।
                                        </td>
                                    </tr>
                                    <!-- Training Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> ট্রেনিং </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ $report->training }} ।
                                        </td>
                                    </tr>
                                    <!-- Training Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> সমস্যা </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ $report->problem }} ।
                                        </td>
                                    </tr>
                                    <!-- Training Info  -->
                                    <tr class="d-flex mb-3">
                                        <td> মন্তব্য </td>
                                        <td> - &nbsp</td>
                                        <td class="col-12" style="border-bottom:1px dashed #333">
                                        {{ \Str::limit($report->comment, 60) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="text-center">
                            <span class="text-center">ভালবাসা অবিরাম মামাজের সাথে থাকার জন্য।</span>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12">
            <div class="card card-body">
                <div class="user-images text-center">
                     <img src="{{ asset($report->user->avatar) }}" class="img-fluid" alt="User Image" width="100">
                     <hr>
                     <div class="text-center">
                        <p>Name:  {{ $report->user->name }}</p>
                        <p>Username:  {{ $report->user->username }}</p>
                     </div>
                </div>
               <div class="row">
                   <div class="col-md-12 m-auto text-center mb-4 mt-3">
                       <a href="{{ route('agent.report.pending') }}" class="btn btn-danger waves-effect btn-label waves-light">
                       <i class="bx bx-block label-icon"></i>
                           ক্যানসেল
                        </a>
                       @if( $report->status == 0 )
                       <a href="javascript:void(0)" id="approvecash" data-id-app="{{ $report->id }}" data-attr-url="{{ route('agent.report.update', $report->id) }}" class="btn btn-success waves-effect btn-label waves-light">
                        <i class="bx bx-check label-icon"></i>
                           অ্যপ্রুভ করুন
                        </a>
                        @else
                        <a href="javascript:void(0)" class="btn btn-success waves-effect btn-label waves-light disabled">
                        <i class="bx bx-check label-icon"></i>
                           অ্যপ্রুভ হয়েছে
                        </a>
                        @endif
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

          let reporthref = $(this).attr('data-attr-url');
          let post_id = $(this).attr('data-id-app');

        //   console.log(post_id); 
          
          $.ajax({    
              type: 'POST',
              url: reporthref,
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