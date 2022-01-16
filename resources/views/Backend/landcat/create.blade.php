@extends('layouts.master')

@section('title') জমি যুক্ত করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') জমি যুক্ত করুন @endslot
        @slot('title') জমি তৈরি করুন @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <form action="{{ route('landcat.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="জমির পরিমাণ">জমির পরিমাণ</label>
                                <input type="text" name="landvalue" id="" class="form-control" placeholder="জমির পরিমাণ">
                                <span class="text-danger">@error('landvalue'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  mb-3">
                                <label for="জমির মুল্য">জমির মুল্য</label>
                                <input type="text" name="landprice" id="" class="form-control" placeholder="জমির মূল্য">
                                <span class="text-danger">@error('landprice'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="স্টাটার্স">স্টাটার্স</label>
                                <select name="status" id="" class="form-control">
                                    <option value="0">নির্বাচন করুন</option>
                                    <option value="1">একটিভ</option>
                                    <option value="2">ইন-একটিভ</option>
                                </select>
                                <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="মন্তব্য লিখুন">মন্তব্য লিখুন</label>
                                <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
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