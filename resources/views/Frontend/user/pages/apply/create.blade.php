@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','কাজের জন্য আবেদন করুন')
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
                     <h5>আবেদন করুন</h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Frontend/user/bookingleft')
      <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
         <form action="{{ route('apply.store') }}" method="post" enctype="multipart/form-data" id="submitform">
         @csrf
         <div class="row">
             <div class="col-md-12">
                 <div class="alert alert-danger">
                     <p>প্রিয় গ্রাহক, আমরা প্রথমেই আপনাকে মনে করিয়ে দিতে চাইছি যে, কাজের জন্য আবেদন করার আগে অবশ্যই আপনাকে একটি বুকিং দিতে হবে। যদি বুকিং দিতে ব্যর্থ হন অথবা বুকিং এর জন্য পর্যাপ্ত টাকা না তাহলে অবশ্যই মামাজ কর্তৃপক্ষের সাথে যোগাযোগ করতে হবে।</p>
                 </div>
             </div>
             
            <!-- Personal Info -->
            <div class="col-md-6">
               <div class="card p-2 border-0">
                  <div class="card-header text-left">
                     ব্যাক্তিগত তথ্য
                  </div>
                  <div class="card-body">
                     <div class="form-group">
                        <label for="name">আপনার নাম লিখুন</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="নাম লিখুন" value="{{ old('name', optional(Auth::user())->name) }}">
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="phonenumber">মোবাইল নাম্বার লিখুন</label>
                        <input type="text" name="phonenumber" value="{{ old('phonenumber') }}" id="phonenumber" class="form-control" placeholder="নাম্বার লিখুন">
                        <span class="text-danger">@error('phonenumber'){{ $message }} @enderror</span>

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
                        <input type="text" name="nidnumber" id="nidnumber" class="form-control" placeholder="নাম্বার লিখুন" value="{{ old('nidnumber') }}">
                        <span class="text-danger">@error('nidnumber'){{ $message }} @enderror</span>

                     </div>
                     <div class="form-group">
                        <label for="dob">জন্ম তারিখ</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                        <span class="text-danger">@error('dob'){{ $message }} @enderror</span>

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
            <div class="col-md-6">
               <div class="card p-2 border-0">
                  <div class="card-header text-left">
                     পারিবারিক তথ্য
                  </div>
                  <div class="card-body">
                     <div class="form-group">
                        <label for="fathername">আপনার পিতার নাম লিখুন</label>
                        <input type="text" name="fathername" id="fathername" class="form-control" placeholder="নাম লিখুন">
                        <span class="text-danger">@error('fathername'){{ $message }} @enderror</span>

                     </div>
                     <div class="form-group">
                        <label for="mothername">আপনার মাতার নাম লিখুন</label>
                        <input type="text" name="mothername" id="mothername" class="form-control" placeholder="নাম লিখুন">
                        <span class="text-danger">@error('mothername'){{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="permanentaddress">স্থায়ী ঠিকানা</label>
                        <input type="text" name="permanentaddress" id="permanentaddress" class="form-control" placeholder="ঠিকানা লিখুন">
                        <span class="text-danger">@error('permanentaddress'){{ $message }} @enderror</span>

                     </div>
                     <div class="form-group">
                        <label for="presentaddress">বর্তমান ঠিকানা</label>
                        <input type="text" name="presentaddress" id="presentaddress" class="form-control" placeholder="ঠিকানা লিখুন">
                        <span class="text-danger">@error('presentaddress'){{ $message }} @enderror</span>

                     </div>                     
                  </div>
               </div>
               <div class="card p-2 border-0">
                  <div class="card-header text-left">
                     শিক্ষাগত যোগ্যতা
                  </div>
                  <div class="card-body">
                        <label for="ব্যবসায়ী মনোভাব"> <strong>আপনার সর্বশেষ শিক্ষাগত যোগ্যতা পছন্দ করুন ? </strong> </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="অস্টম" value="8">
                            <label class="form-check-label" for="অস্টম">অস্টম</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="দশম" value="10">
                            <label class="form-check-label" for="দশম">দশম</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="এসএসসি" value="ssc">
                            <label class="form-check-label" for="এসএসসি">এসএসসি</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="একাদশ" value="11">
                            <label class="form-check-label" for="একাদশ">একাদশ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="এইচএসসি" value="hsc">
                            <label class="form-check-label" for="এইচএসসি">এইচএসসি</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="অনার্স" value="honurs">
                            <label class="form-check-label" for="অনার্স">অনার্স</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="মাস্টার্স" value="masters">
                            <label class="form-check-label" for="মাস্টার্স">মাস্টার্স</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bthink" id="অন্যান্য" value="0">
                            <label class="form-check-label" for="অন্যান্য">অন্যান্য</label>
                        </div>                             
                  </div>
                  <span class="text-danger">@error('bthink'){{ $message }} @enderror</span>
               </div>

               <div class="card p-2 border-0">
                  <div class="card-body">
                    <div class="form-group text-right mr-auto d-block">
                        <button type="submit" id="submit" class="btn btn-primary float-right" style="float:right;">আবেদন করুন</button>
                    </div>                            
                  </div>
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
   // Notification 
   @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

   $(document).ready(function() {
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
            $("#submit").attr("disabled", true);
            $("#submit").text("প্রসেসিং ...");
            $('#submit').append('<div class="spinner-border spinner-border-sm"></div>')
        });
    });
</script>
@endsection