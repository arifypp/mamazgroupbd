@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Login') {{ isset($url) ? ucwords($url) : " " }}
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
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>Signin {{ isset($url) ? ucwords($url) : " " }} to continue Mamaz.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="auth-logo">
                        <a href="index" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                @foreach( $site_settings as $value )
                                    <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}" alt=""
                                        class="rounded-circle" height="34">
                                @endforeach
                                </span>
                            </div>
                        </a>

                        <a href="{{ route('homepage') }}" class="auth-logo-dark">
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
                    @if (session()->has('notification'))
                        <div class="notification">
                            {!! session('notification') !!}
                        </div>
                    @endif
                        @isset($url)
                        <form class="form-horizontal" method="POST" action='{{ url("login/$url") }}'>
                        @else
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @endisset
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Email / User ID</label>
                                <input name="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="username"
                                    placeholder="Enter Email / User ID" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div
                                    class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                    <input type="password" name="password"
                                        class="form-control  @error('password') is-invalid @enderror"
                                        id="userpassword" placeholder="Enter password"
                                        aria-label="Password" aria-describedby="password-addon">
                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                            class="mdi mdi-eye-outline"></i></button>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if(session('AuthroleErrors'))
                                <span class="text-danger">
                                    <strong>{{ session('AuthroleErrors') }}</strong>
                                </span>
                            @enderror

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                    In</button>
                            </div>
                            <div class="row mt-2 text-center justify-content-center align-items-center align-self-center">
                                <div class="col-md-4">
                                <a href="{{ route('Agentlogin') }}" class="text-muted"><i
                                            class="mdi mdi-power me-1"></i> Login Agent?</a>
                                </div>
                                <div class="col-md-4">
                                <a href="{{ route('Adminlogin') }}" class="text-muted"><i
                                            class="mdi mdi-power me-1"></i> Login Admin?</a>
                                </div>
                                <div class="col-md-4">
                                <a href="{{ route('userlogin') }}" class="text-muted"><i
                                            class="mdi mdi-power me-1"></i> Login User?</a>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-muted"><i
                                            class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                @endif

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">

                <div>
                    <p>Don't have an account ? <a href="{{ url('register/user') }}" class="fw-medium text-primary">
                            Signup now </a> </p>
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
<!-- end account-pages -->

@endsection
@section('script')
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endsection