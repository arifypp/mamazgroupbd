@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Register')
@endsection
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('body')

<body>
@endsection

@section('content')

<div class="account-pages my-5 pt-sm-5">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8 col-lg-6 col-xl-8">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">Free Register</h5>
                        <p>Get your free mamaz account now.</p>
                    </div>
                </div>
                <div class="col-5 align-self-end">
                    <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                        class="img-fluid">
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
            <div class="p-2">
                @isset($url)
                <form method="POST" class="form-horizontal" action='{{ url("register/$url") }}' enctype="multipart/form-data">
                @else
                <form method="POST" class="form-horizontal" action="{{ route('register') }}" enctype="multipart/form-data">
                @endisset
                    @csrf
                    <div class="row">
                        <h4>Contact Information</h4><hr>
                        <div class="col-md-6 col-sm-12 col-xl-6">
                            <!-- First Name  -->
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                value="{{ old('firstname') }}" id="firstname" name="firstname" autofocus required
                                    placeholder="First Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- User Name -->
                            @php 
                                $usercount = App\Models\User::orderBy('id', 'desc')->count();
                            @endphp
                                <input id="username" type="hidden" class="form-control @error('username') is-invalid @enderror" name="username" 
                                value="{{ \Carbon\Carbon::now()->format('ymd').'0'.$usercount+1}}"> 
                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                value="{{ old('email') }}" name="email" placeholder="Enter email" autofocus required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="userpassword" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                    placeholder="Enter password" autofocus required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lang" class="form-label">Language</label>
                                <select name="lang" id="lang" class="form-control @error('lang') is-invalid @enderror">
                                    <option value="0">Please Selecte language</option>
                                    <option value="bn">বাংলা</option>
                                    <option value="en">English</option>
                                </select>
                                @error('lang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xl-6">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                value="{{ old('lastname') }}" id="lastname" name="lastname" autofocus required
                                    placeholder="Enter Last Name">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" id="phone" name="phone" autofocus required
                                    placeholder="Enter phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation"
                                name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="userdob">Date of Birth</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control @error('dob') is-invalid @enderror" placeholder="dd-mm-yyyy"
                                        data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-date-end-date="0d" value="{{ old('dob') }}"
                                        data-provide="datepicker" name="dob" autofocus required>
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4>Billing Address</h4><hr>
                        <div class="col-md-6 col-sm-12 col-xl-6">
                            <div class="mb-3">
                                <label for="Address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" id="address" name="address" autofocus required
                                    placeholder="Enter your address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="City" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city') }}" id="city" name="city" autofocus required
                                    placeholder="Enter your city">
                                @error('City')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lpcenterid" class="form-label">Lp Center Id (optional)</label>
                                <input type="text" class="form-control @error('lpcenterid') is-invalid @enderror"
                                value="{{ old('lpcenterid') }}" id="lpcenterid" name="lpcenterid"
                                    placeholder="Enter your Lp Center Id">
                                @error('lpcenterid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xl-6">
                            <div class="mb-3">
                                <label for="Address Line 2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control @error('address2') is-invalid @enderror"
                                value="{{ old('address2') }}" id="address2" name="address2" autofocus required
                                    placeholder="Enter your address2">
                                @error('address2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Postal Code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                value="{{ old('postcode') }}" id="postcode" name="postcode" autofocus required
                                    placeholder="Enter your postcode">
                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Country" class="form-label">Country</label>
                                <select name="country" id="country" class="form-control  @error('country') is-invalid @enderror">
                                    <option value="0">Please select country</option>
                                    @foreach( $country as $ct )
                                    <option value="{{ $ct->code }}">{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <h4>Enroller/Sponsor Information</h4><hr>
                        <div class="col-md-12 col-sm-12 col-xl-12 mb-3">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="affiliatecheck">
                                <label class="form-check-label" for="affiliatecheck">I don't know an Affiliate</label>
                            </div>
                            @php 
                                $referrer = App\Models\User::whereUsername(session()->pull('referrer'))->first();
                            @endphp
                            @if( !is_null($referrer) )
                            <div class="form-group mt-3" id="sponserfield">
                                <label for="Sponsor ID Number">Sponsor ID Number</label>
                                <input type="text" name="referelID" id="userID" value="{{ $referrer->username }}"  class="form-control" readonly>
                                <label for="username"> <span class="text-info">{{ $referrer->name }}</span> </label><br>
                                <input type="checkbox" class="form-check-input" id="check" checked>
                                <label class="form-check-label" for="check">My sponsor is the same as my enroller</label>
                            </div>
                            @else
                            <div class="form-group mt-3" id="sponserfield">
                                <label for="Sponsor ID Number">Sponsor ID Number</label>
                                <input type="text" name="referelID" id="userID"  class="form-control" readonly>
                                <input type="checkbox" class="form-check-input" id="check" checked>
                                <label class="form-check-label" for="check">My sponsor is the same as my enroller</label>
                            </div>
                            @endif
                        </div>
                       
                        <h4>Agreement</h4><hr>
                        <div class="col-md-12 col-sm-12 col-xl-12 mb-3">
                            <div class="form-group form-check">
                                <input type="checkbox" name="agreementone" class="form-check-input  @error('agreementone') is-invalid @enderror" id="agreementone">
                                <label class="form-check-label" for="agreementone">By checking this box, I acknowledge that I have read <a href="javascript:void(0)">Mamaz's Terms and Conditions</a>. I further acknowledge that I have read and understand Mamaz's Consent to Electronic Record.</label>
                                @error('agreementone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-check mt-3">
                                <input type="checkbox" name="agreementtwo" class="form-check-input  @error('agreementtwo') is-invalid @enderror" id="agreementtwo">
                                <label class="form-check-label" for="agreementtwo">By checking this box, I acknowledge that I have read and understand that I give my consent for mamaz to keep an <a href="#">Electronic Record of my personal data.</a></label>
                                @error('agreementtwo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    
                    <!-- <div class="mb-3">
                        <label for="avatar">Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="inputGroupFile02" name="avatar" autofocus required>
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> -->

                    <div class="mt-4 d-grid">
                        <button class="btn btn-primary waves-effect waves-light"
                            type="submit">Register</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="mt-5 text-center">

        <div>
            <p>Already have an account ? <a href="{{ url('login/user') }}" class="fw-medium text-primary">
                    Login</a> </p>
            <p>© <script>
                    document.write(new Date().getFullYear())

                </script> Mamaz Group BD. Crafted with <i class="mdi mdi-heart text-danger"></i> by HappyArif
            </p>
        </div>
    </div>

</div>
</div>
</div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script>
  $(function () {
        $("#affiliatecheck").change(function () {
            if ($(this).is(':checked')) {
                $("#sponserfield").hide();
            } else {
                $("#sponserfield").show();
            }
        });
    });
</script>



@endsection
