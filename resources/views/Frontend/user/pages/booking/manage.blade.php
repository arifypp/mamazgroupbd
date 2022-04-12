@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','আমাদের সম্পর্কে')
  @section('body')

  {{-- Profile section  --}}
  <section class="profile-section">
    <div class="container">
      <div class="main-body">
          <div class="mobiledevice">
      <div class="row">
        
        <div class="col-md-3">
          
        </div>
  
        <div class="col-md-9">
          <div class="topbar1">
            <h5>বুকিং করুন</h5>
            
          </div>
        </div>
        </div>
      </div>
       @include('Frontend/user/bookingleft')
  
  
               <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
               <form action="" method="post" enctype="multipart/form-data" id="submitform">
                        @csrf
                <div class="row">
                    <!-- Personal Info -->
                    <div class="col-md-6">
                        <div class="card p-2 border-0">
                            <div class="card-header text-left">
                                ব্যাক্তিগত তথ্য
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">নিজের নাম লিখুন</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">মোবাইল নাম্বার লিখুন</label>
                                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="religion">ধর্ম </label>
                                    <select name="religion" id="religion" class="form-control">
                                        <option value="0">নির্বাচন করুন</option>
                                        <option value="ইসলাম">ইসলাম</option>
                                        <option value="হিন্দু">হিন্দু</option>
                                        <option value="খ্রিস্টান">খ্রিস্টান</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                    <span class="text-danger">@error('religion'){{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">জাতীয়তা</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="0">নির্বাচন করুন</option>
                                        <option value="বাংলাদেশ">বাংলাদেশী</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                    <span class="text-danger">@error('nationality'){{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="nidnumber">ভোটার আইডি নং</label>
                                    <input type="text" name="nidnumber" id="nidnumber" class="form-control" placeholder="নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="dob">জন্ম তারিখ</label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="maritalstatus">বৈবাহিক অবস্থা</label>
                                    <select name="maritalstatus" id="maritalstatus" class="form-control">
                                        <option value="0">বৈবাহিক অবস্থা নিবার্চন করুন</option>
                                        <option value="অবিবাহিত">অবিবাহিত</option>
                                        <option value="বিবাহিত">বিবাহিত</option>
                                        <option value="ডিভোর্সড">ডিভোর্সড</option>
                                        <option value="বিধবা">বিধবা</option>
                                        <option value="বিপত্নীক">বিপত্নীক</option>
                                    </select>
                                    <span class="text-danger">@error('maritalstatus'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Family Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               পারিবারিক তথ্য
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fathername">পিতার নাম</label>
                                    <input type="text" name="fathername" id="fathername" class="form-control" placeholder="পিতার নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="fatherphone">পিতার মোবাইল নাম্বার (যদি থাকে)</label>
                                    <input type="text" name="fatherphone" id="fatherphone" class="form-control" placeholder="পিতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="mothername">মাতার নাম</label>
                                    <input type="text" name="mothername" id="mothername" class="form-control" placeholder="মাতার নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">মাতার মোবাইল নাম্বার (যদি থাকে)</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group" id="spousename" style="display:none;">
                                    <label for="spousename">স্বামী/স্ত্রীর নাম</label>
                                    <input type="text" name="spousename" id="" class="form-control" placeholder="স্বামী/স্ত্রীর নাম লিখুন">
                                    <span id="error"></span>
                                </div>
                                <div class="form-group" id="spousephonenumber" style="display:none;">
                                    <label for="spousephonenumber">স্বামী/স্ত্রীর মোবাইল নাম্বার</label>
                                    <input type="text" name="spousephonenumber" class="form-control" placeholder="স্বামী/স্ত্রীর মোবাইল নাম্বার লিখুন">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Address Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               বর্তমান ঠিকানা
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                      <label for="flatorhouse">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="flatorhouse" id="" cols="3" rows="3" class="form-control"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="division">বিভাগ</label>
                                    <select class="form-control" id="division" name="division" required>
                                        <option value="0">--বিভাগ নিবার্চন করুন--</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('division'){{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="district">জেলা</label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option value="">--জেলা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thana">থানা/উপজেলা</label>
                                    <select class="form-control" id="thana" name="thana" required>
                                        <option value="">--থানা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ppostoffice">পোস্ট অফিস</label>
                                    <input type="text" name="ppostoffice" id="ppostoffice" class="form-control" placeholder="আপনার পোস্ট অফিসের নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="ppostcode">পোস্ট কোড</label>
                                    <input type="text" name="ppostcode" id="ppostcode" class="form-control" placeholder="আপনার পোস্ট অফিসের কোড লিখুন">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Address Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               স্থায়ী ঠিকানা
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                      <label for="permanenthouse">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="permanenthouse" id="permanenthouse" cols="3" rows="3" class="form-control"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="permanetdivision">বিভাগ</label>
                                    <select class="form-control" id="permanetdivision" name="permanetdivision" required>
                                        <option value="">--বিভাগ নিবার্চন করুন--</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permanentdistrict">জেলা</label>
                                    <select class="form-control" id="permanentdistrict" name="permanentdistrict" required>
                                        <option value="">--জেলা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-permanentthana">
                                    <label for="mothername">থানা/উপজেলা</label>
                                    <select class="form-control" id="permanentthana" name="permanentthana" required>
                                        <option value="">--থানা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permanentpostoffice">পোস্ট অফিস</label>
                                    <input type="text" name="permanentpostoffice" id="permanentpostoffice" class="form-control" placeholder="আপনার পোস্ট অফিসের নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="permanentpostcode">পোস্ট কোড</label>
                                    <input type="text" name="permanentpostcode" id="permanentpostcode" class="form-control" placeholder="আপনার পোস্ট অফিসের কোড লিখুন">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nominy Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               নমিনীর তথ্য
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nominyname"> নমিনীর নাম</label>
                                    <input type="text" name="nominyname" id="nominyname" class="form-control" placeholder="নমীনির নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="nominyphone"> নমিনীর মোবাইল নাম্বার</label>
                                    <input type="text" name="nominyphone" id="nominyphone" class="form-control" placeholder="নমীনির নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="nominyaddress">নমীনির ঠিকানা</label>
                                    <textarea name="nominyaddress" id="nominyaddress" cols="3" rows="3" class="form-control"></textarea>                                    
                                </div>
                                <div class="form-group">
                                    <label for="nominynid">ভোটার আইডি নং / জন্ম নিবন্ধন / পাসপোর্ট</label>
                                    <input type="text" name="nominynid" id="nominynid" class="form-control" placeholder="নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="nominyrelatoin">নমীনির সাথে সম্পর্ক</label>
                                    <select name="nominyrelatoin" id="nominyrelatoin" class="form-control">
                                        <option value="0">-সম্পর্ক নির্বাচন করুন-</option>
                                        <option value="পিতা">পিতা</option>
                                        <option value="মাতা">মাতা</option>
                                        <option value="ভাই">ভাই</option>
                                        <option value="বোন">বোন</option>
                                        <option value="স্ত্রী">স্ত্রী</option>
                                        <option value="চাচা">চাচা</option>
                                        <option value="খালু">খালু</option>
                                        <option value="মামা">মামা</option>
                                        <option value="ফুফা">ফুফা</option>
                                        <option value="সন্তান">সন্তান</option>
                                    </select>
                                    <span class="text-danger">@error('nominyrelatoin'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Referel Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               যার মাধ্যমে মামাজের সঙ্গে পরিচয়
                            </div>
                            <div class="card-body">
                                @php 
                                    $user  = auth()->user()->referrer_id;
                                    $userid = App\Models\User::where('id', $user)->get();
                                @endphp
                                @if( !empty($user) )
                                <div class="form-group">
                                    <label for="referelname">রেফারেল নাম</label>
                                    <input type="text" name="referelname" id="referelname" class="form-control" value="{{ $userid['0']->name }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="referelphone">রেফারেল মোবাইল নং</label>
                                    <input type="text" name="referelphone" id="referelphone" class="form-control" value="{{ $userid['0']->phone }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="referelemail">রেফারেল ইমেইল</label>
                                    <input type="text" name="referelemail" id="referelemail" class="form-control" value="{{ $userid['0']->email }}" readonly>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="referelname">রেফারেল নাম</label>
                                    <input type="text" name="referelname" id="referelname" class="form-control" value="Mamaz Group BD" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="referelphone">রেফারেল মোবাইল নং</label>
                                    <input type="text" name="referelphone" id="referelphone" class="form-control" value="01677199625" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="referelemail">রেফারেল ইমেইল</label>
                                    <input type="text" name="referelemail" id="referelemail" class="form-control" value="mamaz.info@gmail.com" readonly>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                                প্লটের / জমির ঠিকানা
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary">
                                    সম্মানিত গ্রাহক ও ক্রেতাগন। আপনার জমির ঠিকানা আমাদের নির্ধারিত ক্রয় করা প্লট/জমির এলাকা থেকে দেওয়া হইবে। উল্লেখিত জায়গা বা স্থান গুলো আমাদের কোম্পানির ম্যানেজার অথবা এমডি নিজে নির্বাচন করবে।
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Flat/Land Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                               ফ্ল্যাট বা জমির পরিমান
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="flatvalue">প্লট বা জমির পরিমান</label>
                                    <select name="flatvalue" id="flatvalue" class="form-control">
                                        <option value="0">ফ্ল্যাটের ধরুন নির্বাচন করুন</option>
                                        @foreach( App\Models\Backend\LandReserve::all() as $landcat )
                                        <option value="{{ $landcat->sft }}"> {{ $landcat->sft }} SFT</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('flatvalue'){{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="">জমির কোয়ালিটি</label>
                                    <select name="landquality" id="landquality" class="form-control">
                                        <option value="0">নির্বাচন করুন</option>
                                        @foreach( App\Models\Backend\LandReserveCat::all() as $key => $cname )
                                            <option value="{{ $cname->price }}"> {{ $cname->name }} </option>
                                        @endforeach
                                    </select>
                                    <div id="landqualiyprice"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">পেমেন্ট সিস্টেম</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="fullpayment">
                                        <label class="form-check-label" for="inlineRadio1">ফুল পেমেন্ট</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="kistypayment">
                                        <label class="form-check-label" for="inlineRadio2">কিস্তি পেমেন্ট</label>
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <select name="kistyoption" class="form-control" id="kistyoption" style="display:none;">
                                        <option value="0">নির্বাচন করুন</option>
                                        <option value="1">১ বছর</option>
                                        <option value="2">২ বছর</option>
                                        <option value="3">৩ বছর</option>
                                        <option value="4">৪ বছর</option>
                                        <option value="5">৫ বছর</option>
                                        <option value="6">৬ বছর</option>
                                        <option value="7">৭ বছর</option>
                                        <option value="8">৮ বছর</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Primary Notice Info -->
                    <div class="col-md-6">
                        <div class="card mb-6 p-2">
                            <div class="card-header text-left">
                                টোটাল টাকার পরিমাণ
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <th>মোট বুকিং টাকা</th>
                                            <td>:</td>
                                            <td>৳1,65,0000 BDT</td>
                                        </tr>
                                        <tr>
                                            <th>টোটাল ফ্ল্যাটের মূল্যে</th>
                                            <td>:</td>
                                            <td><span id="flatprice"></span></td>
                                        </tr>
                                        <tr>
                                            <th>মাসিক কিস্তি</th>
                                            <td>:</td>
                                            <td> <span id="monthkisty"></span> </td>
                                        </tr>
                                        <tr>
                                            <th>পয়সা প্রয়োজন</th>
                                            <td>:</td>
                                            <td> <span  id="poishaproyojon"></span> </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-right">
                                           <td colspan="4">
                                               <div class="" id="TotalPrice"></div>
                                           </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="form-group text-right float-right" style="float:right;">
                            <button type="submit" id="submitform" class="btn btn-primary text-right">সাবমিট করুন</button>
                        </div>
                    </div>
                    <!-- End -->
                </div>
              </div>
              </form>
            </div>
          </div>
      </div>
    </section>

 @endsection

 @section('script')
 <script>
  $("#division").on('change',function(e){
    e.preventDefault();
    var ddlDistrict=$("#district");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url: "{{ route('divisions') }}",
      data:{_token:$('input[name=_token]').val(),division:$(this).val()},
      success:function(response){
          // var jsonData=JSON.parse(response);
          $('option', ddlDistrict).remove();
          $('#district').append('<option value="">--বিভাগ নিবার্চন করুন--</option>');
          $.each(response, function(){
            $('<option/>', {
              'value': this.id,
              'text': this.bn_name
            }).appendTo('#district');
          });
        }

    });
  });

  $("#district").on('change',function(e){
    e.preventDefault();
    var ddlthana=$("#thana");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url: "{{ route('district') }}",
      data:{_token:$('input[name=_token]').val(),districts:$(this).val()},
      success:function(response){
          // var jsonData=JSON.parse(response);
          $('option', ddlthana).remove();
          $('#thana').append('<option value="">--থানা নিবার্চন করুন--</option>');
          $.each(response, function(){
            $('<option/>', {
              'value': this.id,
              'text': this.bn_name
            }).appendTo('#thana');
          });
        }
      });
  });
  

//   parmanent address
$("#permanetdivision").on('change',function(e){
    e.preventDefault();
    var ddlDistrict=$("#permanentdistrict");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url: "{{ route('divisions') }}",
      data:{_token:$('input[name=_token]').val(),division:$(this).val()},
      success:function(response){
          // var jsonData=JSON.parse(response);
          $('option', ddlDistrict).remove();
          $('#permanentdistrict').append('<option value="">--বিভাগ নিবার্চন করুন--</option>');
          $.each(response, function(){
            $('<option/>', {
              'value': this.id,
              'text': this.bn_name
            }).appendTo('#permanentdistrict');
          });
        }

    });
  });

  $("#permanentdistrict").on('change',function(e){
    e.preventDefault();
    var ddlthana=$("#permanentthana");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url: "{{ route('district') }}",
      data:{_token:$('input[name=_token]').val(),districts:$(this).val()},
      success:function(response){
          // var jsonData=JSON.parse(response);
          $('option', ddlthana).remove();
          $('#permanentthana').append('<option value="">--থানা নিবার্চন করুন--</option>');
          $.each(response, function(){
            $('<option/>', {
              'value': this.id,
              'text': this.bn_name
            }).appendTo('#permanentthana');
          });
        }
      });
  });

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
    // Total Amount Calculating
    $(document).ready(function() {
        $("#flatvalue").change(function(){
            var mamazpoisha = $("#flatvalue").val() * 2650;
            var poisha = mamazpoisha / 100;
            $("#TotalPrice").html("<center><h2 class='text-danger'>"+"৳"+ mamazpoisha +" টাকা"+"</h2></center>");

            $('#flatprice').html("৳ "+mamazpoisha + " BDT");

            $('#poishaproyojon').html("৳"+poisha+" মামাজ পয়সা");

            $('<input>').attr({
                type: 'hidden',
                id: 'total_flat_price',
                name: 'total_flat_price',
                value: mamazpoisha,
            }).appendTo('form#submitform');
    
        });

        $("#landquality").change(function(){
            var qualityPrice = $('#landquality').val();
            var mamazpoisha = $("#flatvalue").val() * 2650;
            var totalprice = (+qualityPrice) + (+mamazpoisha);

            // Poisha projon
            var poisha = totalprice / 100;

            $('#landqualiyprice').html("৳ "+ qualityPrice +" BDT");

            $("#TotalPrice").html("<center><h2 class='text-danger'>"+"৳"+ totalprice +" টাকা"+"</h2></center>");

            $('#poishaproyojon').html("৳"+poisha+" মামাজ পয়সা");
        });

        $("input[type='radio']").click(function () {

            radioVal = $(this).val();
            if( radioVal == 'kistypayment' )
            {
                $("#kistyoption").show();
            }
            else{
                $("#kistyoption").hide();
            }
            
        });

        $("#kistyoption").change(function(){
            var qualityPrice = $('#landquality').val();
            var mamazpoisha = $("#flatvalue").val() * 2650;
            var totalprice = (+qualityPrice) + (+mamazpoisha);
            // Poisha projon
            var poisha = totalprice / 100;
            // Monthly payment
            var kistyoption = $('#kistyoption').val();

            var monthPay = (totalprice) / (kistyoption);

            $('#monthkisty').text("৳ "+Math.round(monthPay)+" BDT");

            $('<input>').attr({
                type: 'hidden',
                id: 'kistypayment',
                name: 'kistypayment',
                value: Math.round(monthPay),
            }).appendTo('form#submitform');
        });


    });

// Submit form
$(function(){
            $.ajaxSetup({
            headers: {
                    "X-CSRFToken": '{{csrf_token()}}'
                }
            });
            $('#submitform').submit(function(e){
                e.preventDefault();
                var mydata = $(this).serialize();
                $.ajax({
                    method : 'POST',
                    url : "{{ route('booking.store') }}",
                    data:mydata,
                    success: function(response) {
                        if(response.success){
                            toastr.success(response.message);
                        }
                        setTimeout(function(){
                            document.getElementById("submitform").reset();
                        }, 3000);
                        
                },
                error:function (response){
                    $('.text-danger').html('');
                    $('.text-danger').delay(5000).fadeOut();
                    $.each(response.responseJSON.error,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                    })
                }
                })
            })

        })


</script>
 @endsection