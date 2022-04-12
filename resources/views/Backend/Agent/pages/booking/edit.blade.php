@extends('Backend.Agent.includes.main')

@section('title') এডিট বুকিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') বুকিং @endslot
        @slot('title') এডিট বুকিং @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <form action="{{ route('bbooking.update', $booking->id) }}" method="post" enctype="multipart/formdata">
                    @csrf
                    <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">ব্যাক্তিগত তথ্য</h4>
                                <hr>
                                <div class="form-group mb-3">
                                    <label for="name">নিজের নাম লিখুন</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $booking->name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phonenumber">মোবাইল নাম্বার লিখুন</label>
                                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="{{ $booking->phonenumber }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="religion">ধর্ম </label>
                                    <select name="religion" id="religion" class="form-control">
                                        <option value="ইসলাম" @if( $booking->religion == 'ইসলাম' ) selected @endif>ইসলাম</option>
                                        <option value="হিন্দু" @if( $booking->religion == 'হিন্দু' ) selected @endif>হিন্দু</option>
                                        <option value="খ্রিস্টান" @if( $booking->religion ==  'খ্রিস্টান') selected @endif>খ্রিস্টান</option>
                                        <option value="অন্যান্য" @if( $booking->religion ==  'অন্যান্য') selected @endif>অন্যান্য</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nationality">জাতীয়তা</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="বাংলাদেশ" @if( $booking->nationality == 'বাংলাদেশী' ) selected @endif >বাংলাদেশী</option>
                                        <option value="অন্যান্য" @if( $booking->nationality == 'অন্যান্য' ) selected @endif >অন্যান্য</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nidnumber">ভোটার আইডি নং</label>
                                    <input type="text" name="nidnumber" id="nidnumber" class="form-control" value="{{ $booking->nidnumber }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dob">জন্ম তারিখ</label>
                                    <input type="date" name="dob" id="dob" value="{{ $booking->dob }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="maritalstatus">বৈবাহিক অবস্থা</label>
                                    <select name="maritalstatus" id="maritalstatus" class="form-control">
                                        <option value="অবিবাহিত" @if( $booking->maritalstatus == 'অবিবাহিত' ) selected @endif>অবিবাহিত</option>
                                        <option value="বিবাহিত" @if( $booking->maritalstatus == 'বিবাহিত' ) selected @endif>বিবাহিত</option>
                                        <option value="ডিভোর্সড" @if( $booking->maritalstatus == 'ডিভোর্সড' ) selected @endif>ডিভোর্সড</option>
                                        <option value="বিধবা" @if( $booking->maritalstatus == 'বিধবা' ) selected @endif>বিধবা</option>
                                        <option value="বিপত্নীক" @if( $booking->maritalstatus == 'বিপত্নীক' ) selected @endif>বিপত্নীক</option>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <h4 class="card-title">পারিবারিক তথ্য</h4><hr>
                            <div class="form-group mb-3">
                                <label for="fathername">পিতার নাম</label>
                                <input type="text" name="fathername" id="fathername" class="form-control" value="{{ $booking->fathername }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fatherphone">পিতার মোবাইল নাম্বার (যদি থাকে)</label>
                                <input type="text" name="fatherphone" id="fatherphone" class="form-control" value="{{ $booking->fatherphone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="mothername">মাতার নাম</label>
                                <input type="text" name="mothername" id="mothername" class="form-control" value="{{ $booking->mothername }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="motherphone">মাতার মোবাইল নাম্বার (যদি থাকে)</label>
                                <input type="text" name="motherphone" id="motherphone" class="form-control" value="{{ $booking->motherphone }}">
                            </div>
                            <div class="form-group mb-3" id="spousename" style="display:none;">
                                <label for="spousename">স্বামী/স্ত্রীর নাম</label>
                                <input type="text" name="spousename" id="" class="form-control" value="{{ $booking->spousename }}">
                                <span id="error"></span>
                            </div>
                            <div class="form-group mb-3" id="spousephonenumber" style="display:none;">
                                <label for="spousephonenumber">স্বামী/স্ত্রীর মোবাইল নাম্বার</label>
                                <input type="text" name="spousephonenumber" class="form-control" value="{{ $booking->spousephonenumber }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">বর্তমান ঠিকানা</h4><hr>
                                <div class="form-group mb-3">
                                      <label for="flatorhouse">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="flatorhouse" id="" cols="3" rows="3" class="form-control">{{ $booking->flatorhouse }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="division">বিভাগ</label>
                                    <select class="form-control" id="division" name="division" required>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" @if( $division->id == $booking->divisionid ) selected @endif>{{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="district">জেলা</label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option @if( $booking->district->id == $booking->districtid ) selected @endif> {{ $booking->district->bn_name }} </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="thana">থানা/উপজেলা</label>
                                    <select class="form-control" id="thana" name="thana" required>
                                        <option @if( $booking->thana->id == $booking->thanaid ) selected @endif> {{ $booking->thana->bn_name }} </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ppostoffice">পোস্ট অফিস</label>
                                    <input type="text" name="ppostoffice" id="ppostoffice" class="form-control" value="{{ $booking->ppostoffice }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ppostcode">পোস্ট কোড</label>
                                    <input type="text" name="ppostcode" id="ppostcode" class="form-control" value="{{ $booking->ppostcode }}">
                                </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">স্থায়ী ঠিকানা</h4><hr>
                            <div class="form-group mb-3">
                                    <label for="permanenthouse">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                    <textarea name="permanenthouse" id="permanenthouse" cols="3" rows="3" class="form-control">{{ $booking->permanenthouse }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="permanetdivision">বিভাগ</label>
                                <select class="form-control" id="permanetdivision" name="permanetdivision">
                                    @foreach ($divisions as $division)
                                    <option @if( $division->id == $booking->pdivision->id ) selected @endif>{{ $division->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="permanentdistrict">জেলা</label>
                                <select class="form-control" id="permanentdistrict" name="permanentdistrict">
                                    <option @if( $booking->pdistrict->id == $booking->permanentdistrictid ) selected @endif> {{ $booking->pdistrict->bn_name }} </option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mothername">থানা/উপজেলা</label>
                                <select class="form-control" id="permanentthana" name="permanentthana">
                                <option @if( $booking->pthana->id == $booking->permanentthanaid ) selected @endif> {{ $booking->pthana->bn_name }} </option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="permanentpostoffice">পোস্ট অফিস</label>
                                <input type="text" name="permanentpostoffice" id="permanentpostoffice" class="form-control" value="{{ $booking->permanentpostoffice }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="permanentpostcode">পোস্ট কোড</label>
                                <input type="text" name="permanentpostcode" id="permanentpostcode" class="form-control" value="{{ $booking->permanentpostcode }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">নমিনীর তথ্য</h4><hr>
                            <div class="form-group mb-3">
                                <label for="nominyname"> নমিনীর নাম</label>
                                <input type="text" name="nominyname" id="nominyname" class="form-control" value="{{ $booking->nominyname }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nominyphone"> নমিনীর মোবাইল নাম্বার</label>
                                <input type="text" name="nominyphone" id="nominyphone" class="form-control" value="{{ $booking->nominyphone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nominyaddress">নমীনির ঠিকানা</label>
                                <textarea name="nominyaddress" id="nominyaddress" cols="3" rows="3" class="form-control">{{ $booking->nominyaddress }} </textarea>                                    
                            </div>
                            <div class="form-group mb-3">
                                <label for="nominynid">ভোটার আইডি নং / জন্ম নিবন্ধন / পাসপোর্ট</label>
                                <input type="text" name="nominynid" id="nominynid" class="form-control" value="{{ $booking->nominynid }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nominyrelatoin">নমীনির সাথে সম্পর্ক</label>
                                <select name="nominyrelatoin" id="nominyrelatoin" class="form-control">
                                    <option value="পিতা" @if($booking->nominyrelatoin == 'পিতা') selected @endif>পিতা</option>
                                    <option value="মাতা" @if($booking->nominyrelatoin == 'মাতা') selected @endif>মাতা</option>
                                    <option value="ভাই" @if($booking->nominyrelatoin == 'ভাই') selected @endif>ভাই</option>
                                    <option value="বোন" @if($booking->nominyrelatoin == 'বোন') selected @endif>বোন</option>
                                    <option value="স্ত্রী" @if($booking->nominyrelatoin == 'স্ত্রী') selected @endif>স্ত্রী</option>
                                    <option value="চাচা" @if($booking->nominyrelatoin == 'চাচা') selected @endif>চাচা</option>
                                    <option value="খালু" @if($booking->nominyrelatoin == 'খালু') selected @endif>খালু</option>
                                    <option value="মামা" @if($booking->nominyrelatoin == 'মামা') selected @endif>মামা</option>
                                    <option value="ফুফা" @if($booking->nominyrelatoin == 'ফুফা') selected @endif>ফুফা</option>
                                    <option value="সন্তান" @if($booking->nominyrelatoin == 'সন্তান') selected @endif>সন্তান</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">যার মাধ্যমে মামাজের সঙ্গে পরিচয়</h4><hr>
                            <div class="form-group mb-3">
                                <label for="referelname">রেফারেল নাম</label>
                                <input type="text" name="referelname" id="referelname" class="form-control" value="{{ $booking->referelname }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="referelphone">রেফারেল মোবাইল নং</label>
                                <input type="text" name="referelphone" id="referelphone" class="form-control" value="{{ $booking->referelphone }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="referelemail">রেফারেল ইমেইল</label>
                                <input type="text" name="referelemail" id="referelemail" class="form-control" value="{{ $booking->referelemail }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">ফ্ল্যাট বা জমির পরিমান</h4><hr>
                            <div class="form-group mb-3">
                                <label for="flatvalue">প্লট বা জমির পরিমান</label>
                                <select name="flatvalue" id="flatvalue" class="form-control">
                                    <option value="0">ফ্ল্যাটের ধরুন নির্বাচন করুন</option>
                                    <option value="৫০০" @if($booking->flatvalue == '৫০০') selected @endif >৫০০ SFT</option>
                                    <option value="১০০০" @if($booking->flatvalue == '১০০০') selected @endif >১০০০ SFT</option>
                                    <option value="১৫০০" @if($booking->flatvalue == '১৫০০') selected @endif >১৫০০ SFT</option>
                                    <option value="২০০০" @if($booking->flatvalue == '২০০০') selected @endif >২০০০ SFT</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="bookingmoney">বুকিং টাকার পরিমাণ</label>
                                <input type="text" name="bookingmoney" id="bookingmoney" class="form-control" value="{{ $booking->bookingmoney }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="bookingmoneymehtod">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</label>
                                <select name="bookingmoneymehtod" id="bookingmoneymehtod" class="form-control">
                                    <option value="bank" @if( $booking->bookingmoneymehtod == 'bank' ) selected @endif>ব্যাংক</option>
                                    <option value="bkash" @if( $booking->bookingmoneymehtod == 'bkash' ) selected @endif>বিকাশ</option>
                                    <option value="Nagad" @if( $booking->bookingmoneymehtod == 'Nagad' ) selected @endif>নগদ</option>
                                    <option value="rocket" @if( $booking->bookingmoneymehtod == 'rocket' ) selected @endif>রকেট</option>
                                    <option value="handcash" @if( $booking->bookingmoneymehtod == 'handcash' ) selected @endif>নগদ প্রদান</option>
                                </select>
                                <span class="text-danger">@error('bookingmoneymehtod'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">প্লটের / জমির ঠিকানা</h4><hr>
                            <div class="alert alert-primary">
                                সম্মানিত গ্রাহক ও ক্রেতাগন। আপনার জমির ঠিকানা আমাদের নির্ধারিত ক্রয় করা প্লট/জমির এলাকা থেকে দেওয়া হইবে। উল্লেখিত জায়গা বা স্থান গুলো আমাদের কোম্পানির ম্যানেজার অথবা এমডি নিজে নির্বাচন করবে। সেক্ষেত্রে প্রত্যেক গ্রাহককে তার জায়গার বা ফ্ল্যাটের টিকানা মোবাইল ফোনের মাধ্যমে জানানো হইবে। 
                            </div>
                            <a href="{{ route('bbooking.manage') }}" class="btn btn-danger waves-effect btn-label waves-light">
                            <i class="bx bx-block label-icon"></i>
                                ব্যাক করুন
                            </a>
                            <button type="submit" class="btn btn-success waves-effect btn-label waves-light">
                                <i class="bx bx-check label-icon"></i>
                                আপডেট করুন
                                </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
      $(function () {
        $("#maritalstatus").change(function () {
            if ($(this).val() == "বিবাহিত") {
                $("#spousename").show();
                $("#spousephonenumber").show();
            } else {
                $("#spousename").hide();
                $("#spousephonenumber").hide();
            }
        });
    });
</script>
@endsection