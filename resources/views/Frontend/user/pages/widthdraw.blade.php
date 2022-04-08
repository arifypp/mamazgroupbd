@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','উইথড্র করুন')
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
                     <h5>টাকা উইথড্র করুন</h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Frontend/user/bookingleft')
      <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
         <form action="{{ route('send.store') }}" method="post" enctype="multipart/form-data" id="submitform">
         @csrf
         <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
         <div class="row">             
            <!-- Personal Info -->
            <div class="col-md-12">
               <div class="card p-2 border-0">
                  <div class="card-header text-left">
                     কার মাধ্যমে টাকা উইথড্র করতে ইচ্ছুক?
                  </div>
                  <div class="card-body">
                      <!-- widthdarw option selection  -->
                      <div class="row align-self-center text-center justify-content-center">
                        <div class="col-md-3 justify-content-center align-self-center text-center">
                            <div class="card card-body">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="AdminPayment">
                                    <label class="form-check-label" for="inlineRadio1">অ্যাডমিন</label>
                                </div>                                
                            </div>
                            
                        </div>
                        <div class="col-md-3 justify-content-center align-self-center text-center">
                            <div class="card card-body">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="agentPayment">
                                    <label class="form-check-label" for="inlineRadio2">এজেন্ট</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-6 agent justify-content-center align-self-center text-center" style="display:none;">
                            <div class="card card-body">
                                <div class="form-group m-0" style="margin-bottom: 0px !important;">
                                    <select name="agent_id" id="agent_id" class="form-control select2">
                                        <option value="0">এজেন্ট নিবার্চন করুন</option>
                                        @foreach( App\Models\User::where('auth_role', 1)->get() as $agent )
                                        <option value="{{ $agent->id }}">{{ $agent->name }} - {{ $agent->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">এমাউন্ট লিখুন?</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="এমাউন্ট বসান" value="{{ old('amount') }}">
                        <span class="text-danger">@error('amount'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="wallet_type">ওয়ালেট নিবার্চন করুন?</label>
                        <select name="wallet_type" id="wallet_type" class="form-control">
                            <option value="0">নির্বাচন করুন</option>
                            @php
                            $walletTypeID = CoreProc\WalletPlus\Models\WalletType::where('name', 'Cash Money')->get();
                            @endphp
                            @foreach( $walletTypeID as $key => $walletType )
                            <option value="{{ $walletType->id }}"> {{ $walletType->name }} </option>
                            @endforeach
                        </select>
                        <span id="walletamountresult"></span>
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
    // agent users
    $("input[type='radio']").click(function () {
        radioVal = $(this).val();
        if( radioVal == 'agentPayment' )
        {
            $(".agent").show();
        }
        else{
            $(".agent").hide();
        }

        });
    
    // Search agent user
    $(document).ready(function () {
        $('#city').select2();
        $('#city').select2({ width: '100%', placeholder: "Select an Option" });
    })

    // Need to know price
    $(document).ready(function() {
        $("#wallet_type, #amount").change(function(){
            var wallet_id = $("#wallet_type").val();

            var withdrawcharge = "{{ config('bonus_settings.withdrawcharge') }}";

            $.ajaxSetup({
            headers: {
                    "X-CSRFToken": '{{csrf_token()}}'
                }
            });

            $.ajax({
                    method : 'POST',
                    url : "{{ url('/widthdarw/amount/request') }}/"+ wallet_id,
                    data: {"_token": "{{ csrf_token() }}", "id": wallet_id},
                    success: function(response) {
                        var mamazpoisha = $("#amount").val();

                        if( mamazpoisha == '' )
                        {
                            alert("টাকার পরিমান যুক্ত করুন।");
                        }
                        else
                        {
                            var chargeamount = (mamazpoisha) / 100 * withdrawcharge;
                            var totalamount = +(mamazpoisha) + (chargeamount);
                            if(response){
                                $('#walletamountresult').html('<span class="text-info">আপনার বর্তমান এমাউন্ট আছে ৳'+response+'</span>');
                            };

                            $("#resultmpoisha").html("<center><h2 class='text-success'>"+"৳"+totalamount+" টাকা"+"</h2></center>"+"<div class='alert alert-success'>"+"সার্ভিস চার্জ ৳"+chargeamount +" টাকা</div>");
                        }
                        
                                  
                },
                error:function (response){
                    $('.text-danger').html('');
                    $('.text-danger').delay(5000).fadeOut();
                    $.each(response.responseJSON.error,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                    })
                }
            })
        });
    });
</script>
@endsection