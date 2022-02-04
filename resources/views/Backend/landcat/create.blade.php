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
                                <label for="মূল জমি">মূল জমি</label>
                                <input type="text" name="mainland" value="{{ old('mainland') }}" class="form-control" placeholder="মূল জমি">
                                <span class="text-danger">@error('mainland'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ইউটিলিটি জমি"> ইউটিলিটি জমি </label>
                                <input type="text" name="utility" value="{{ old('utility') }}" class="form-control" placeholder="ইউটিলিটি জমি">
                                <span class="text-danger">@error('utility'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ব্যাবহৃত জমি"> ব্যাবহৃত জমি / শতাংশ </label>
                                <input type="text" name="usedland" value="{{ old('usedland') }}" class="form-control" placeholder="ব্যাবহৃত জমি / শতাংশ">
                                <span class="text-danger">@error('usedland'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="প্লট সংখ্যা"> প্লট সংখ্যা (৫ শতাংশ) </label>
                                <input type="text" name="plotnumber" value="{{ old('plotnumber') }}" class="form-control" placeholder="প্লট সংখ্যা">
                                <span class="text-danger">@error('plotnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ফ্লোর সংখ্যা"> ফ্লোর সংখ্যা </label>
                                <input type="text" name="floornumber" value="{{ old('floornumber') }}" class="form-control" placeholder="ফ্লোর সংখ্যা">
                                <span class="text-danger">@error('floornumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ইউনিট সংখ্যা"> ইউনিট সংখ্যা </label>
                                <input type="text" name="unitnumber" value="{{ old('unitnumber') }}" class="form-control" placeholder="ইউনিট সংখ্যা">
                                <span class="text-danger">@error('unitnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="মোট স্কয়ারফিট"> মোট স্কয়ারফিট </label>
                                <input type="text" name="totalsquarefit" value="{{ old('totalsquarefit') }}" class="form-control" placeholder="মোট স্কয়ারফিট">
                                <span class="text-danger">@error('totalsquarefit'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="প্লট রেশিও"> প্লট রেশিও </label>
                                <input type="text" name="floatratio" value="{{ old('floatratio') }}" class="form-control" placeholder="প্লট রেশিও">
                                <span class="text-danger">@error('floatratio'){{ $message }} @enderror</span>
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
                               <h4>জমির বিবরণ</h4><hr>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="সিএস নং"> সিএস নং </label>
                                <input type="text" name="csnumber" value="{{ old('csnumber') }}" class="form-control" placeholder="সি এস নং">
                                <span class="text-danger">@error('csnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="এস এ নং"> এস এ নং </label>
                                <input type="text" name="sanumber" value="{{ old('sanumber') }}" class="form-control" placeholder="এস এ নং">
                                <span class="text-danger">@error('sanumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="আর এস নং"> আর এস নং </label>
                                <input type="text" name="rsnumber" value="{{ old('rsnumber') }}" class="form-control" placeholder="আর এস নং">
                                <span class="text-danger">@error('rsnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="বি এস নং"> বি এস নং </label>
                                <input type="text" name="bsnumber" value="{{ old('bsnumber') }}" class="form-control" placeholder="বি এস নং">
                                <span class="text-danger">@error('bsnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="জে এল নং"> জে এল নং </label>
                                <input type="text" name="jlnumber" value="{{ old('jlnumber') }}" class="form-control" placeholder="জে এল নং">
                                <span class="text-danger">@error('jlnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ডি সি আর নং"> ডি সি আর নং </label>
                                <input type="text" name="dcrnumber" value="{{ old('dcrnumber') }}" class="form-control" placeholder="ডি সি আর নং">
                                <span class="text-danger">@error('dcrnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="খারিস কেস নং"> খারিস কেস নং </label>
                                <input type="text" name="kharicaseno" value="{{ old('kharicaseno') }}" class="form-control" placeholder="খারিস কেস নং">
                                <span class="text-danger">@error('kharicaseno'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="খাজনার সাল"> খাজনার সাল </label>
                                <input type="text" name="khajnayear" value="{{ old('khajnayear') }}" class="form-control" placeholder="খাজনার সাল">
                                <span class="text-danger">@error('khajnayear'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="মেইন দলিল নাম্বার"> মেইন দলিল নাম্বার </label>
                                <input type="text" name="maindolilnumber" value="{{ old('maindolilnumber') }}" class="form-control" placeholder="মেইন দলিল নাম্বার">
                                <span class="text-danger">@error('maindolilnumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="ভায়া দলিল নাম্বার"> ভায়া দলিল নাম্বার </label>
                                <input type="text" name="vayanumber" value="{{ old('vayanumber') }}" class="form-control" placeholder="ভায়া দলিল নাম্বার">
                                <span class="text-danger">@error('vayanumber'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="জমির বিবরণ"> জমির বিবরণ </label>
                                <input type="text" name="lanbdescription" value="{{ old('lanbdescription') }}" class="form-control" placeholder="জমির বিবরণ">
                                <span class="text-danger">@error('lanbdescription'){{ $message }} @enderror</span>
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