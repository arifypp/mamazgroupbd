@extends('layouts.master-without-nav')

@section('title')
    ওভারভিউ দেখুন
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Welcome Again! </h5>
                                            <p> {{ $user->name }} Your Account Overview.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <a href="index">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                            @foreach( $site_settings as $value )
                                                <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}" alt=""
                                                    class="rounded-circle" height="34">
                                            @endforeach
                                            </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="bodycontent">
                                    <h4>{{ $user->name }}</h4>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Name </th>
                                                <td>: &nbsp;</td>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>UserID </th>
                                                <td>: &nbsp;</td>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone </th>
                                                <td>: &nbsp;</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email </th>
                                                <td>: &nbsp;</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Account Status</th>
                                                <td>: &nbsp; </td>
                                                <td><span class="text-danger">Unverified</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="p-2">
                                    <div class="text-end">                          
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                        type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ __('পে করুন') }}</button>
                                    </div>                                        
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <!-- <p>Remember It ? <a href="{{ url('login') }}" class="fw-medium text-primary"> Sign In here</a> </p> -->
                            <p>© <script>
                                    document.write(new Date().getFullYear())

                                </script> Mamaz. Crafted with <i class="mdi mdi-heart text-danger"></i> by HappyArif</p>
                        </div>

                        <!-- Modal for payment -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">মামাজ ফাউন্ডেশনে পে করুন</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <center>
                                            <div class="alert alert-light">
                                            <h1>১৭১.00 ৳</h1>
                                            </div>
                                        </center>
                                    <form action="" method="post" id="singlepayment">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{$user->id}}">
                                        <input type="hidden" name="refereluser" value="{{$user->referrer_id}}">
                                        <div class="form-group mb-3">
                                            <label for="bookingmoneymehtod">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</label>
                                            <select name="bookingmoneymehtod" id="bookingmoneymehtod" class="form-control">
                                                <option value="0">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</option>
                                                <option value="bkash">বিকাশ</option>
                                                <option value="Nagad">নগদ</option>
                                                <option value="rocket">রকেট</option>
                                            </select>
                                            <span class="text-danger">@error('bookingmoneymehtod'){{ $message }} @enderror</span>
                                        </div>
                                        <!-- Bkash transictoin -->
                                        <div class="form-group mb-3" id="bkashtransiction" style="display:none;">
                                            <label for="bkashtransiction">বিকাশ ট্রান্জিকশন নাম্বার</label>
                                            <input type="text" name="bkashtransiction" class="form-control" placeholder="7X145F125">
                                        </div>
                                        <div class="form-group mb-3" id="bkashnumber" style="display:none;">
                                            <label for="bkashnumber">বিকাশ নাম্বার</label>
                                            <input type="text" name="bkashnumber" class="form-control" placeholder="নাম্বার বসান">
                                            <p class="alert alert-danger">
                                                উপরিউক্ত ফর্ম পূরণ করার পূর্বে, আপনাকে <strong>01677199625</strong> এই নাম্বারে <strong>১৭১.00/-</strong> টাকা সেন্ড মানি করতে হবে। যে নাম্বার থেকে টাকা পাঠাবেন সেই নাম্বার উপরের ঘরে পূরন করুন এবং ট্রান্সিকশন আইডি দিন, তারপর পেমেন্ট সম্পন্ন বাটনে চাপ দিন। 
                                            </p>
                                        </div>
                                        <!-- Nagad transictoin -->
                                        <div class="form-group mb-3" id="nagadtransiction" style="display:none;">
                                            <label for="nagadtransiction">নগদ ট্রান্জিকশন নাম্বার</label>
                                            <input type="text" name="nagadtransiction" class="form-control" placeholder="7X145F125">
                                        </div>
                                        <div class="form-group mb-3" id="nagadnumber" style="display:none;">
                                            <label for="nagadnumber">নগদ নাম্বার</label>
                                            <input type="text" name="nagadnumber" class="form-control" placeholder="নাম্বার বসান">
                                            <p class="alert alert-danger">
                                                উপরিউক্ত ফর্ম পূরণ করার পূর্বে, আপনাকে <strong>01677199625</strong> এই নাম্বারে <strong>১৭১.00/-</strong> টাকা সেন্ড করতে হবে। যে নাম্বার থেকে টাকা পাঠাবেন সেই নাম্বার উপরের ঘরে পূরন করুন এবং ট্রান্সিকশন আইডি দিন, তারপর পেমেন্ট সম্পন্ন বাটনে চাপ দিন। 
                                            </p>
                                        </div>
                                        <!-- Rocket transictoin -->
                                        <div class="form-group mb-3" id="rockettransiction" style="display:none;">
                                            <label for="rockettransiction">রকেট ট্রান্জিকশন নাম্বার</label>
                                            <input type="text" name="rockettransiction" class="form-control" placeholder="7X145F125">
                                        </div>
                                        <div class="form-group mb-3" id="rocketnumber" style="display:none;">
                                            <label for="rocketnumber">রকেট নাম্বার</label>
                                            <input type="text" name="rocketnumber" class="form-control" placeholder="নাম্বার বসান">
                                            <p class="alert alert-danger">
                                                উপরিউক্ত ফর্ম পূরণ করার পূর্বে, আপনাকে <strong>01677199625</strong> এই নাম্বারে <strong>১৭১.00/-</strong> টাকা সেন্ড করতে হবে। যে নাম্বার থেকে টাকা পাঠাবেন সেই নাম্বার উপরের ঘরে পূরন করুন এবং ট্রান্সিকশন আইডি দিন, তারপর পেমেন্ট সম্পন্ন বাটনে চাপ দিন। 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                                        <button type="submit" id="singlepayment" class="btn btn-primary">পেমেন্ট সম্পন্ন করুন</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
@section('script')
<script>
    // Booking money
    $(function () {
        $("#bookingmoneymehtod").change(function () {
            if ($(this).val() == "bkash") {
                $("#bkashtransiction").show();
                $("#bkashnumber").show();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }else if($(this).val() == "Nagad") {
                $("#nagadnumber").show();
                $("#nagadtransiction").show();
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }else if ($(this).val() == "rocket") {
                $("#rockettransiction").show();
                $("#rocketnumber").show();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
            }else {
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }
        });
    });

    $('#singlepayment').submit(function(e){
        e.preventDefault();
        var mydata = $(this).serialize();
        $.ajax({
            method : 'POST',
            url : "{{ route('paysignupcash.store') }}",
            data:mydata,
            success: function(response) {
                if(response.success){
                    toastr.success(response.message);
                }
                setTimeout(function(){
                    document.getElementById("singlepayment").reset();
                }, 3000);
                
        },
        error:function (response){
            $('.text-danger').html('');
            $('.text-danger').delay(5000).fadeOut();
            $.each(response.responseJSON.errors,function(field_name,error){
                $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
            })
        }
        })
    })




</script>
@endsection