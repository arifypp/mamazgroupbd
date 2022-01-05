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
        
        <div class="col-md-2">
          
        </div>
  
        <div class="col-md-10">
          <div class="topbar1">
            <h5>বুকিং করুন</h5>
            
          </div>
        </div>
        </div>
      </div>
      
          
      
            <div class="row gutters-sm">
              <div class="col-md-2 mb-3">
            
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('user.dashboard') || Route::currentRouteNamed('user.dashboard') || Route::currentRouteNamed('user.dashboard') ) active @endif">
                      <a href="{{ route('user.dashboard') }}"><h6><i class="fas fa-tachometer-alt"></i>ড্যাশবোর্ড</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('booking.manage') || Route::currentRouteNamed('booking.edit') || Route::currentRouteNamed('booking.create') ) active @endif">
                      <a href="{{ route('booking.manage') }}"><h6><i class="fas fa-sticky-note"></i>বুকিং দিন</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <a href="report.html"><h6><i class="fas fa-sticky-note"></i>রিপোট</h6></a>
                     
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                      <a href="profile.html"><h6><i class="fas fa-user-cog"></i>প্রোফাইল সেটিং</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                          <h6><i class="fas fa-power-off"></i>লগ আউট</h6>
                      </a>    
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>                     
                    </li>
                  </ul>
                </div>
              </div>
  
  
               <div class="col-md-10"style="background-color: #F8FAFD; padding-top: 0px;">
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
                                        <option selected>নির্বাচন করুন</option>
                                        <option value="ইসলাম">ইসলাম</option>
                                        <option value="হিন্দু">হিন্দু</option>
                                        <option value="খ্রিস্টান">খ্রিস্টান</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">জাতীয়তা</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option selected>নির্বাচন করুন</option>
                                        <option value="বাংলাদেশ">বাংলাদেশ</option>
                                        <option value="অন্যান্য">অন্যান্য</option>
                                    </select>
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
                                        <option>বৈবাহিক অবস্থা নিবার্চন করুন</option>
                                        <option value="অবিবাহিত">অবিবাহিত</option>
                                        <option value="বিবাহিত">বিবাহিত</option>
                                        <option value="ডিভোর্সড">ডিভোর্সড</option>
                                        <option value="বিধবা">বিধবা</option>
                                        <option value="বিপত্নীক">বিপত্নীক</option>
                                    </select>
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
                                    <label for="fatherphone">পিতার মোবাইল নাম্বার</label>
                                    <input type="text" name="fatherphone" id="fatherphone" class="form-control" placeholder="পিতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="mothername">মাতার নাম</label>
                                    <input type="text" name="mothername" id="mothername" class="form-control" placeholder="মাতার নাম লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">মাতার মোবাইল নাম্বার</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group" id="spousename" style="display:none;">
                                    <label for="spousename">স্বামী/স্ত্রীর নাম</label>
                                    <input type="text" name="spousename" id="" class="form-control" placeholder="স্বামী/স্ত্রীর নাম লিখুন">
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
                                      <label for="flat">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="flat" id="" cols="3" rows="3" class="form-control"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="fatherphone">বিভাগ</label>
                                    <select class="form-control" id="division" name="division" required>
                                        <option value="">--বিভাগ নিবার্চন করুন--</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fatherphone">জেলা</label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option value="">--জেলা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mothername">থানা/উপজেলা</label>
                                    <select class="form-control" id="thana" name="thana" required>
                                        <option value="">--থানা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট অফিস</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট কোড</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
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
                                      <label for="flat">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="flat" id="" cols="3" rows="3" class="form-control"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="fatherphone">বিভাগ</label>
                                    <select class="form-control" id="division" name="division" required>
                                        <option value="">--বিভাগ নিবার্চন করুন--</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fatherphone">জেলা</label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option value="">--জেলা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mothername">থানা/উপজেলা</label>
                                    <select class="form-control" id="thana" name="thana" required>
                                        <option value="">--থানা নিবার্চন করুন--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট অফিস</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট কোড</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
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
                                    <div class="form-group">
                                      <label for="flat">গ্রাম/শহর/রাস্তা/বাড়ি/ফ্ল্যাট</label>
                                      <textarea name="flat" id="" cols="3" rows="3" class="form-control"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট অফিস</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                                <div class="form-group">
                                    <label for="motherphone">পোস্ট কোড</label>
                                    <input type="text" name="motherphone" id="motherphone" class="form-control" placeholder="মাতার মোবাইল নাম্বার লিখুন">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
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