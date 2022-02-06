@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','টাকা যুক্ত করুন')
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
                     <h5>টাকা অ্যাড করুন</h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Frontend/user/bookingleft')
      <div class="col-md-10"style="background-color: #F8FAFD; padding-top: 0px;">
         <form action="{{ route('addmoney.store') }}" method="post" enctype="multipart/form-data" id="submitform">
         @csrf
         <div class="row">             
            <!-- Personal Info -->
            <div class="col-md-12">
               <div class="card p-2 border-0">
                  <div class="card-header text-left">
                     টাকা অ্যাড করুন
                  </div>
                  <div class="card-body">
                      <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">এমাউন্ট</label>
                        <input type="text" name="amount" class="form-control" placeholder="এমাউন্ট বসান">
                    </div>
                     <div class="form-group">
                        <label for="bookingmoneymehtod">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</label>
                        <select name="bookingmoneymehtod" id="bookingmoneymehtod" class="form-control">
                            <option value="0">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</option>
                            <option value="bank">ব্যাংক</option>
                            <option value="bkash">বিকাশ</option>
                            <option value="Nagad">নগদ</option>
                            <option value="rocket">রকেট</option>
                            <option value="handcash">নগদ প্রদান</option>
                        </select>
                        <span class="text-danger">@error('bookingmoneymehtod'){{ $message }} @enderror</span>
                    </div>
                    <!-- Bank transictoin -->
                    <div class="form-group" id="banktransaction" style="display:none;">
                        <label for="banktransaction">ব্যাংক স্লিপ নাম্বার</label>
                        <input type="text" name="banktransaction" class="form-control" placeholder="স্লিপ নাম্বার বসান">
                    </div>
                    <div class="form-group" id="bankreferenceno" style="display:none;">
                        <label for="bankreferenceno">ব্যাংক রেফারেন্স নাম্বার</label>
                        <input type="text" name="bankreferenceno" class="form-control" placeholder="রেফারেন্স নাম্বার বসান">
                    </div>
                    <!-- Bkash transictoin -->
                    <div class="form-group" id="bkashtransiction" style="display:none;">
                        <label for="bkashtransiction">বিকাশ ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="bkashtransiction" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                    <div class="form-group" id="bkashnumber" style="display:none;">
                        <label for="bkashnumber">বিকাশ নাম্বার</label>
                        <input type="text" name="bkashnumber" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                    <!-- Nagad transictoin -->
                    <div class="form-group" id="nagadtransiction" style="display:none;">
                        <label for="nagadtransiction">নগদ ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="nagadtransiction" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                    <div class="form-group" id="nagadnumber" style="display:none;">
                        <label for="nagadnumber">নগদ নাম্বার</label>
                        <input type="text" name="nagadnumber" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                    <!-- Rocket transictoin -->
                    <div class="form-group" id="rockettransiction" style="display:none;">
                        <label for="rockettransiction">রকেট ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="rockettransiction" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                    <div class="form-group" id="rocketnumber" style="display:none;">
                        <label for="rocketnumber">রকেট নাম্বার</label>
                        <input type="text" name="rocketnumber" class="form-control" placeholder="নাম্বার বসান">
                    </div>
                     <div class="form-group text-right col-md-12">
                         <button type="submit" class="btn btn-primary">সাবমিট করুন</button>
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
    // Booking money
    $(function () {
        $("#bookingmoneymehtod").change(function () {
            if ($(this).val() == "bank") {
                $("#banktransaction").show();
                $("#bankreferenceno").show();
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#bkashnumber").hide();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();              

            } else if ($(this).val() == "bkash") {
                $("#bkashtransiction").show();
                $("#bkashnumber").show();
                $("#banktransaction").hide();
                $("#bankreferenceno").hide();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }else if($(this).val() == "Nagad") {
                $("#nagadnumber").show();
                $("#nagadtransiction").show();
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#banktransaction").hide();
                $("#bankreferenceno").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }else if ($(this).val() == "rocket") {
                $("#rockettransiction").show();
                $("#rocketnumber").show();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#banktransaction").hide();
                $("#bankreferenceno").hide();
            }else {
                $("#bkashtransiction").hide();
                $("#bkashnumber").hide();
                $("#banktransaction").hide();
                $("#bankreferenceno").hide();
                $("#nagadnumber").hide();
                $("#nagadtransiction").hide();
                $("#rockettransiction").hide();
                $("#rocketnumber").hide();
            }
        });
    });

</script>
@endsection