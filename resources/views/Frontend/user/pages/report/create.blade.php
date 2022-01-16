@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','রিপোর্ট পাঠান')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
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
                     <h5>রিপোর্ট করুন</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-10"style="background-color: #F8FAFD; padding-top: 0px;">
            <form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data" id="submitform">
               @csrf
               <div class="row">
                  <!-- Personal Info -->
                  <div class="col-md-12">
                     <div class="card p-2 border-0">
                        <div class="card-body">
                            <table class="table table-bordered table-responsive" id="dynamicAddRemove">
                                <tr>
                                    <th>তারিখ ?</th>
                                    <th>নাম ?</th>
                                    <th>ফোন ?</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="date" class="form-control" id="datepicker" value="{{ old('date') }}"/>
                                        <span class="text-danger">@error('date'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <input type="text" name="name" placeholder="নাম লিখুন" class="form-control" value="{{ old('name') }}" />
                                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <input type="text" name="phone" placeholder="মোবাইল নাম্বার লিখুন" class="form-control" value="{{ old('phone') }}"/>
                                        <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ই-মেইল (যদি থাকে) ?</th>
                                    <th>ইনভাইট তারিখ ?</th>
                                    <th>অফিস ভিজিটিং তারিখ ?</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="email" placeholder="আপনার ই-মেইল লিখুন" class="form-control" value="{{ old('email') }}" />
                                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <input type="text" name="invitedate" class="form-control" id="datepickerone" value="{{ old('invitedate') }}"/>
                                        <span class="text-danger">@error('invitedate'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <input type="text" name="officevisitdate" class="form-control" id="datepickertwo" value="{{ old('officevisitdate') }}"/>
                                        <span class="text-danger">@error('officevisitdate'){{ $message }} @enderror</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>সাইড ভিজিটিং তারিখ ?</th>
                                    <th>তারিখ(কাউন্সিলিং  করা-১/২/৩/৪ বার ?</th>
                                    <th>টার্গেট সেল বুকিং-ফ্রি ?</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="sidevisitdate" class="form-control" id="datepickerthree" value="{{ old('sidevisitdate') }}"/>
                                        <span class="text-danger">@error('sidevisitdate'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <input type="text" name="counsiling" placeholder="১/২/৩/৪ বার" class="form-control" value="{{ old('counsiling') }}"/>
                                        <span class="text-danger">@error('counsiling'){{ $message }} @enderror</span>
                                    </td>
                                    <td>
                                        <select name="targetfee" id="" class="form-control">
                                            <option value="0">নির্বাচন করুন</option>
                                            <option value="৩০০০০">৩০০০০৳</option>
                                            <option value="৫০০০০">৫০০০০৳</option>
                                            <option value="১৫০০০০">১৫০০০০৳</option>
                                        </select>
                                        <span class="text-danger">@error('targetfee'){{ $message }} @enderror</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="উচ্চকাঙ্খী"> <strong>উচ্চকাঙ্খী ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hwant" id="hwantyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="hwantyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hwant" id="hwantno" value="না">
                                            <label class="form-check-label" for="hwantno">না</label>
                                        </div>
                                        <span class="text-danger">@error('hwant'){{ $message }} @enderror</span>   
                                    </td>
                                    <td>
                                        <label for="ব্যবসায়ী মনোভাব"> <strong>ব্যবসায়ী মনোভাব ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bthink" id="bthinkyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="bthinkyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bthink" id="bthinkno" value="না">
                                            <label class="form-check-label" for="bthinkno">না</label>
                                        </div>    
                                        <span class="text-danger">@error('bthink'){{ $message }} @enderror</span>  
                                    </td>
                                    <td>
                                        <label for="মিশুক"> <strong>মিশুক ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mishuk" id="mishukyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="mishukyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mishuk" id="mishukno" value="না">
                                            <label class="form-check-label" for="mishukno">না</label>
                                        </div>
                                        <span class="text-danger">@error('mishuk'){{ $message }} @enderror</span>   
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="প্লান শো"> <strong>প্লান শো ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="planshow" id="planyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="planyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="planshow" id="planno" value="না">
                                            <label class="form-check-label" for="planno">না</label>
                                        </div>
                                        <span class="text-danger">@error('planshow'){{ $message }} @enderror</span>      
                                    </td>
                                    <td>
                                        <label for="ট্রেনিং"> <strong>ট্রেনিং ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="training" id="trainingyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="trainingyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="training" id="trainingno" value="না">
                                            <label class="form-check-label" for="trainingno">না</label>
                                        </div>
                                        <span class="text-danger">@error('training'){{ $message }} @enderror</span>     
                                    </td>
                                    <td>
                                        <label for="সমস্যা"> <strong>সমস্যা ? </strong> </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="problem" id="problemyes" value="হ্যাঁ">
                                            <label class="form-check-label" for="problemyes">হ্যাঁ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="problem" id="problemno" value="না">
                                            <label class="form-check-label" for="problemno">না</label>
                                        </div>
                                        <span class="text-danger">@error('problem'){{ $message }} @enderror</span>   
                                    </td>
                                </tr>
                                <tr>
                                    <th  colspan="3">মন্তব্য</th>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <textarea name="comment" class="form-control" id="" cols="30" rows="10">
                                            {{ old('comment') }}
                                        </textarea>
                                        <span class="text-danger">@error('comment'){{ $message }} @enderror</span>   
                                    </td>
                                </tr>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block text-right" style="float:right;">সাবমিট করুন</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append(
        '<tr><th>তারিখ ?</th><th>নাম ?</th><th>ফোন ?</th></tr><tr><td><input type="date" name="addMoreInputFields['+ i +'][date]" class="form-control" /></td><td><input type="text" name="addMoreInputFields['+ i +'][name]" placeholder="নাম লিখুন" class="form-control" /></td><td><input type="text" name="addMoreInputFields['+ i +'][phone]" placeholder="মোবাইল নাম্বার লিখুন" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
    $(document).ready(function() {
        $('#datepicker').datepicker();
        $('#datepickerone').datepicker();
        $('#datepickertwo').datepicker();
        $('#datepickerthree').datepicker();
    });
</script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@endsection