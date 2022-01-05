@extends('layouts.master-without-nav')

@section('title')
    Verify Password
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
                                            <h5 class="text-primary"> ইমেইল ভেরিফাই করুন</h5>
                                            <p> {{ auth()->user()->name }} আপনার ইমেইল সত্যতা যাচাইয়ের জন্য ভেরিফাই করুন.</p>
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

                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('একটি ফ্রেশ ইমেইল আপনাকে প্রেরণ করা হয়েছে, ধন্যবাদ!') }}
                                    </div>
                                @endif

                                {{ __('সামনেে এগিয়ে যাওয়ার আগে আপনার ইমেইল চেক করুন।.') }}
                                {{ __('যদি কোনো ইমেইল না পেয়ে থাকেন, তাহলে নিচের বাটনে ক্লিক করুন।') }}
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf

                                        <div class="text-end">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="btn btn-danger w-md waves-effect waves-light"
                                                >{{ __('লগ আউট করুন') }}</a>
                                            
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">{{ __('নতুন ইমেইল প্রেরণ করুন') }}</button>
                                        </div>
                                        
                                    </form>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <!-- <p>Remember It ? <a href="{{ url('login') }}" class="fw-medium text-primary"> Sign In here</a> </p> -->
                            <p>© <script>
                                    document.write(new Date().getFullYear())

                                </script> Mamaz. Crafted with <i class="mdi mdi-heart text-danger"></i> by HappyArif</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
