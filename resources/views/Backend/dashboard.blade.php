@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') ড্যাশবোর্ড @endslot
@slot('title') ড্যাশবোর্ড @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">স্বাগতম আবারও !</h5>
                            <p>অ্যাডমিন ড্যাশবোর্ড</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Str::ucfirst(Auth::user()->name) }}</h5>
                        <!-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> -->
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ App\Models\Frontend\Booking::Adminbookcount() }}</h5>
                                    <p class="text-muted mb-0">বুকিং</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ App\Models\User::AssetMoney() }}</h5>
                                    <p class="text-muted mb-0">বর্তমান টাকা</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">মাসিক ইনকাম</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-muted">গত মাস</p>
                        <h3>
                           ৳{{ App\Models\User::RedialChart() }}
                        </h3>
                        <p class="text-muted"><span class="text-success me-2"> 
                        {{ App\Models\User::RedialChart() / App\Models\User::RedialChart() * config('bonus_settings.mamazpoisha')}}%
                        <i class="mdi mdi-arrow-up"></i>
                            </span> 
                            @if( App\Models\User::RedialChart() /  App\Models\User::RedialChart() * 100  <= 50 )
                                কমিয়ে আগের মাস থেকে 
                            @elseif( App\Models\User::RedialChart() / App\Models\User::RedialChart() * 100  <= 51 && App\Models\User::RedialChart() / 100 >= 100)
                                এগিয়ে আগের মাস থেকে।
                            @endif
                            
                        
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <div class="mt-4 mt-sm-0">
                            <div id="radialBar-charts" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
                <p class="text-muted mb-0">এটা একটি ডিজিটাল প্লাটফর্ম যেখানে প্রতি মাসের একটা ফুল পেমেন্ট এর ডায়াগ্রাম তৈরি করা হয়েছে। যার মাধ্যমে এডমিন এবং কর্তৃপক্ষ খুব সহজে বুঝতে পারবে মাসিক ইনকাম।</p>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
        <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">মূল একাউন্ট টাকা</p>
                                <h2 class="mb-0 text-success">
                                   {{ App\Models\User::AssetMoney() }}
                                </h2>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">পেন্ডিং টাকা</p>
                                <h2 class="mb-0 text-danger">
                                    {{ App\Models\User::PendingAmount() }}
                                </h2>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-user font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">এজেন্ট টাকা</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::AgentMoney() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">চ্যারিটি দান টাকা</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::CharityMoney() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ভ্যাট / ট্যাক্স</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::VatTaxCost() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">মামাজ পয়সা</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::MamazPoisa() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">পারফর. বোনাস</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::BestPerfomance() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ফাউন্ডার. বোনাস</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::FounderShip() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#foundationcash">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ফাউন্ডেশন বোনাস</p>
                                <h4 class="mb-0">
                                    {{ App\Models\User::FundationBonus() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

                <!-- Model work -->
<div class="modal fade" id="foundationcash" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">পেমেন্ড সেন্ড করুন</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.fundation') }}" method="post">
            @csrf
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <span>আপনার বর্তমান টাকা: {{ App\Models\User::FundationBonus() }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="Amount">টাকা পরিমান বসান</label>
                    <input type="number" name="amount" id="amount" class="form-control">
                </div>
                
                <div class="form-group mb-3">
                    <label for="wallet_type">রিসিভার ওয়ালেট নিবার্চন করুন?</label>
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

                <div class="form-group cashmoney">
                    <label for="wallet_type">রিসিভার নির্বাচন করুন?</label>
                    <select name="receiver_id" id="receiver_id" class="form-control">
                            <option value="0">নির্বাচন করুন</option>
                            @php
                            $users = App\Models\User::where('auth_role', 0)->get();
                            @endphp
                            @foreach( $users as $key => $user )
                            <option value="{{ $user->id }}"> {{ $user->name }} - {{ $user->username }} </option>
                            @endforeach
                    </select>
                    <span id="walletamountresult"></span>
                </div>
            </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
            <button type="submit" class="btn btn-primary">পেমেন্ট সেন্ড করুন</button>
            </form>
        </div>
        </div>
    </div>
    </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ননস্পনসর বোনাস</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::NonSponsorbonus() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ল্যান্ড কভারেজ</p>
                                <h4 class="mb-0">
                                
                                {{ App\Models\User::LandCoverageBonus() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ক্লাব বোনাস</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::ClubBonus() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">অ্যা. অ্যাসিভমেন্ট</p>
                                <h4 class="mb-0">
                                    0
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">জেনেরেশন বোনাস</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::GenerationBonus() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">মানি রিকুয়েস্ট</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::MoneyRequestAgent() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">মোট বুকিং</p>
                                <h4 class="mb-0">
                                {{ App\Models\Frontend\Booking::Adminbookcount() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ল্যান্ড রিজার্ভ মানি</p>
                                <h4 class="mb-0">
                                {{ App\Models\User::LandReserveCash() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> গিফ্‌ট এবং ট্যুর </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::GiftandTour() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> হোন্ডা এবং কার </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::HondCar() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> ল্যান্ড ইন্সুরেন্স </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::LandInsurance() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> ট্যুরিজম ফাউন্ড </p>
                                <h4 class="mb-0">                                
                                {{ App\Models\User::TurismFound() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> গোল্ড পিন+সার্টিফিকেট+ক্রেস্ট ফান্ড, ফাউন্ড </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::GoldPinCreastCertficate() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> অফিস মেইনটানেন্স ফান্ড </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::OfficeMaintainceFound() }}
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> ডেমারেজ এন্ড ব্যাকআপ ফান্ড </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::DemarageAndBackupFound() }}
                                
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"> মামাজ ডেভেলোপমেন্ট ফান্ড </p>
                                <h4 class="mb-0">
                                {{ App\Models\User::MamazDevelopmentFound() }}
                                
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

<script type="text/javascript">
var options = {
  chart: {
    height: 360,
    type: "bar",
    stacked: !0,
    toolbar: {
      show: !1
    },
    zoom: {
      enabled: !0
    }
  },
  plotOptions: {
    bar: {
      horizontal: !1,
      columnWidth: "15%",
      endingShape: "rounded"
    }
  },
  dataLabels: {
    enabled: !1
  },
  series: [{
    name: "Series A",
    data: [44, 55, 41, 67, 22, 43, 36, 52, 24, 18, 36, 48]
  }, {
    name: "Series B",
    data: [13, 23, 20, 8, 13, 27, 18, 22, 10, 16, 24, 22]
  }, {
    name: "Series C",
    data: [11, 17, 15, 15, 21, 14, 11, 18, 17, 12, 20, 18]
  }],
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
  },
  colors: ["#556ee6", "#f1b44c", "#34c38f"],
  legend: {
    position: "bottom"
  },
  fill: {
    opacity: 1
  }
},
chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
chart.render();
options = {
  chart: {
    height: 200,
    type: "radialBar",
    offsetY: -10
  },
  plotOptions: {
    radialBar: {
      startAngle: -135,
      endAngle: 135,
      dataLabels: {
        name: {
          fontSize: "13px",
          color: void 0,
          offsetY: 60
        },
        value: {
          offsetY: 22,
          fontSize: "16px",
          color: void 0,
          formatter: function formatter(e) {
            return e + "%";
          }
        }
      }
    }
  },
  colors: ["#38a3a5"],
  fill: {
    type: "gradient",
    gradient: {
      shade: "dark",
      shadeIntensity: .15,
      inverseColors: !1,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 50, 65, 91]
    }
  },
  stroke: {
    dashArray: 4
  },
  series: ['{{ App\Models\User::RedialChart() / App\Models\User::RedialChart() * 100 }}'],
  labels: ["মাসিক ইনকাম"]
};
(chart = new ApexCharts(document.querySelector("#radialBar-charts"), options)).render();
</script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endsection