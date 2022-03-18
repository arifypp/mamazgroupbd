@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','টাকা যুক্ত করুন')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
@endsection
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
                     <h5>টাকা অ্যাড করুন</h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Frontend/user/bookingleft')
      <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
         <form action="{{ route('addmoney.store') }}" method="post" enctype="multipart/form-data" id="submitform">
         @csrf
         <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
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
                        <label for="amount">এমাউন্ট লিখুন?</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="এমাউন্ট বসান" value="{{ old('amount') }}">
                        <span class="text-danger">@error('amount'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="এজেন্ট নির্বাচন করুন">এজেন্ট নির্বাচন করুন?</label>
                        <select name="agent_id" id="city" class="form-control select2">
                            <option value="0">Select Agent</option>
                            @foreach( App\Models\User::where('auth_role', 1)->get() as $agent )
                            <option value="{{ $agent->id }}">{{ $agent->name }} - {{ $agent->username }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('agent_id'){{ $message }} @enderror</span>


                        <span class="text-danger">@error('agentuser'){{ $message }} @enderror</span>
                    </div>
                     <div class="form-group">
                        <label for="bookingmoneymehtod">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</label>
                        <select name="bookingmoneymehtod" id="bookingmoneymehtod" class="form-control">
                            <option value="0">টাকা পাঠানোর মাধ্যম নির্বাচন করুন?</option>
                            <option value="bkash">বিকাশ</option>
                            <option value="Nagad">নগদ</option>
                            <option value="rocket">রকেট</option>
                            <option value="handcash">নগদ প্রদান</option>
                        </select>
                        <span class="text-danger">@error('bookingmoneymehtod'){{ $message }} @enderror</span>
                    </div>
                    <!-- Bkash transictoin -->
                    <div class="form-group" id="bkashtransiction" style="display:none;">
                        <label for="bkashtransiction">বিকাশ ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="bkashtransiction" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('bkashtransiction'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group" id="bkashnumber" style="display:none;">
                        <label for="bkashnumber">বিকাশ নাম্বার</label>
                        <input type="text" name="bkashnumber" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('bkashnumber'){{ $message }} @enderror</span>
                    </div>
                    <!-- Nagad transictoin -->
                    <div class="form-group" id="nagadtransiction" style="display:none;">
                        <label for="nagadtransiction">নগদ ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="nagadtransiction" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('nagadtransiction'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group" id="nagadnumber" style="display:none;">
                        <label for="nagadnumber">নগদ নাম্বার</label>
                        <input type="text" name="nagadnumber" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('nagadnumber'){{ $message }} @enderror</span>
                    </div>
                    <!-- Rocket transictoin -->
                    <div class="form-group" id="rockettransiction" style="display:none;">
                        <label for="rockettransiction">রকেট ট্রান্জিকশন নাম্বার</label>
                        <input type="text" name="rockettransiction" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('rockettransiction'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group" id="rocketnumber" style="display:none;">
                        <label for="rocketnumber">রকেট নাম্বার</label>
                        <input type="text" name="rocketnumber" class="form-control" placeholder="নাম্বার বসান">
                        <span class="text-danger">@error('rocketnumber'){{ $message }} @enderror</span>
                    </div>
                     <div class="form-group text-right col-md-12">
                     <div id="resultmpoisha"></div><br>

                         <button type="submit" id="submit" class="btn btn-primary">সাবমিট করুন</button>
                     </div>
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</section>
<div class="modal fade" id="transferporcess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('/assets/images/payment_process.gif') }}" class="img-fluid" alt="Congrasulation"><br><br>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script>
    $(document).ready(function() {
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
            $('#transferporcess').modal('show');
            $("#submit").attr("disabled", true);
            $("#submit").text("প্রসেসিং ...");
            $('#submit').append('<div class="spinner-border spinner-border-sm"></div>')
        });
    });
    $(document).ready(function() {
        $("#amount").change(function(){
            var mamazpoisha = $("#amount").val() / 100;
            $("#resultmpoisha").html("<center><h2 class='text-danger'>"+"৳"+ mamazpoisha+" পয়সা"+"</h2></center>"+"<div class='alert alert-danger'>"+"উপরের টাকাটি আপনার মামাজ পয়সাতে যুক্ত হবে। রাজি থাকলে সাবমিট করুন।"+"</div>");

        });
    });
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
    // Search agent user
    $(document).ready(function () {
        $('#city').select2();
        $('#city').select2({ width: '100%', placeholder: "Select an Option" });
    })
</script>
@endsection