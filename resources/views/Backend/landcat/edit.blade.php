@extends('layouts.master')

@section('title') জমি এডিট করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') জমি িএডিট করুন @endslot
        @slot('title') জমি িএডিট করুন @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <form action="{{ route('landcat.update', $landcat->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="জমির পরিমাণ">জমির পরিমাণ</label>
                                <input type="text" name="landvalue" value="{{ $landcat->landvalue }}" class="form-control" placeholder="জমির পরিমাণ">
                                <span class="text-danger">@error('landvalue'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="জমির মুল্য">জমির মুল্য</label>
                                <input type="text" name="landprice" value="{{ $landcat->landprice }}" class="form-control" placeholder="জমির মূল্য">
                                <span class="text-danger">@error('landprice'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="স্টাটার্স">স্টাটার্স</label>
                                <select name="status" id="" class="form-control">
                                    <option value="0" @if($landcat->status == 0)  selected @endif>নির্বাচন করুন</option>
                                    <option value="1" @if($landcat->status == 1)  selected @endif>একটিভ</option>
                                    <option value="2" @if($landcat->status == 2)  selected @endif>ইন-একটিভ</option>
                                </select>
                                <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="মন্তব্য লিখুন">মন্তব্য লিখুন</label>
                                <textarea name="comment" id="" cols="30" rows="10" class="form-control">{{ $landcat->comment }}</textarea>
                                <span class="text-danger">@error('comment'){{ $message }} @enderror</span>

                            </div>
                        </div>
                        <div class="col-md-12 float-right">
                            <button type="submit" class="btn btn-primary btn-block" style="float:right;">সাবমিট করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection