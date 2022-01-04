@extends('layouts.master')

@section('title') ওয়েবসাইট হিরো সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') হিরো সেটিং @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
            @if( empty($herosetting) )
                <form action="" method="post">
                    <div class="mb-3">
                            <label for="formrow-websiteherotitle-input" class="form-label">ওয়েবসাইট হিরো টাইটেল</label>
                            <input type="text" class="form-control" id="formrow-websiteherotitle-input" placeholder="ওয়েবসাইটের হিরো টাইটেল লিখুন!">
                    </div>
                    <div class="mb-3">
                            <label for="formrow-websiteherodesc-input" class="form-label">ওয়েবসাইট হিরো বিবরণ</label>
                            <textarea name="" id="formrow-websiteherodesc-input" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-5">
                        <div class="input-group">
                            <input type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">আপলোড</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
            @else
                <form action="{{ route('homesetting.update', $herosetting->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                            <label for="formrow-websiteherotitle-input" class="form-label">ওয়েবসাইট হিরো টাইটেল</label>
                            <input type="text" name="title" class="form-control" id="formrow-websiteherotitle-input" placeholder="ওয়েবসাইটের হিরো টাইটেল লিখুন!" value="{{ $herosetting->title }}">
                            <span class="text-danger">@error('title'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                            <label for="formrow-websiteherodesc-input" class="form-label">ওয়েবসাইট হিরো বিবরণ</label>
                            <textarea name="desc" id="formrow-websiteherodesc-input" cols="10" rows="5" class="form-control">{{ $herosetting->description }}</textarea>
                            <span class="text-danger">@error('desc'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-5">
                    <img src="{{ asset('/assets/images/settings/'. $herosetting->image) }}" alt="" width="20%">
                        <div class="input-group">
                            <input type="file" name="image" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">আপলোড</labe>
                            
                            <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
            @endif
            </div>
        </div>
    </div>

@endsection