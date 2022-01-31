@extends('layouts.master')

@section('title') কাস্টমার তৈরি করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') কাস্টমার তৈরি করুন @endslot
        @slot('title') কাস্টমার তৈরি করুন @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ইউজারনাম">ইউজারনাম</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="ইউজারনাম">
                                <span class="text-danger">@error('username'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="ইমেইল">ই-মেইল</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="ই-মেইল">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="আপনার পুরো নাম">আপনার পুরো নাম</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="আপনার পুরো নাম">
                                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="আপনার মোবাইল নাম্বার">আপনার মোবাইল নাম্বার</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="আপনার মোবাইল নাম্বার">
                                <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="আপনার বয়স">আপনার বয়স</label>
                                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
                                <span class="text-danger">@error('dob'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="পাসওয়ার্ড দিন">পাসওয়ার্ড দিন</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="পাসওয়ার্ড দিন">
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group  mb-3">
                                <label for="প্রোফাইল ছবি দিন">প্রোফাইল ছবি দিন</label>
                                <input type="file" name="avatar" value="{{ old('avatar') }}" class="form-control">
                                <span class="text-danger">@error('avatar'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12 float-right">
                            <button type="submit" class="btn btn-primary btn-block" style="float:right;">রেজিস্ট্রেশন করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection