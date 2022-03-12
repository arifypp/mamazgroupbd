@extends('Backend.Agent.includes.main')

@section('title') অ্যাড মানি  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') অ্যাড মানি  @endslot
        @slot('title') অ্যাড মানি  @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-5 col-lg-5 col-xl-5 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-white">টাকা পাঠান</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('agent.store') }}" method="post" id="sendMoney">
                        @csrf
                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                        <div class="form-group mb-3">
                            <label for="টাকার পরিমান বসান"> টাকার পরিমান বসান </label>
                            <input type="text" name="amount" id="amount" placeholder="৳ টাকার পরিমাণ বসান" class="form-control" value="{{ old('amount') }}" autocomplete="off">
                            <span class="text-danger">@error('amount'){{ $message }} @enderror</span>

                        </div>
                        <div class="form-group mb-3">
                            <label for="টাকা পাঠানোর মাধ্যম নির্বাচন করুন">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</label>
                            <select name="paymentmethod" id="paymentmethod" class="form-control">
                                    <option value="0">টাকা পাঠানোর মাধ্যম নির্বাচন করুন</option>
                                    <option value="bankcash">ব্যাংকিং</option>
                                    <option value="handcash">নগদ প্রদান</option>
                            </select>
                            <span class="text-danger">@error('paymentmethod'){{ $message }} @enderror</span>

                            <br>
                            <div class="form-group mb-3" id="bankcash" style="display: none;">
                                <label for="banktransiction">ব্যাংক ট্রান্সিকশন নাম্বার</label>
                                <input type="text" name="banktransiction" class="form-control" placeholder="নাম্বার বসান" value="{{ old('banktransiction') }}">
                            <span class="text-danger">@error('banktransiction'){{ $message }} @enderror</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="alert alert-info p-1">
                                <p>মামাজ থেকে পয়সা কিনতে প্রতি ১০০ টাকায় ১ পয়সা করে যতখুশি নিতে পারেন।</p>
                            </div>
                            <div id="resultmpoisha"></div>
                            <button class="btn btn-primary btn-block submit w-100" id="submit">সাবমিট করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-7 col-xl-7 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-white">ট্রান্সিকশন লিস্ট</h5>
                </div>
                <div class="card-body">
                    <table class="table-responsive table">
                        <thead>
                            <th>ক্র. নং</th>
                            <th>পেমেন্ট ম্যাথোড</th>
                            <th>টাকার পরিমান</th>
                            <th>স্ট্যাটাস</th>
                        </thead>
                        <tbody>
                            @php 
                                $i = 1;
                            @endphp
                            @foreach( $money as $value )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->bookingmoneymehtod }}</td>
                                <td>৳ {{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</td>
                                <td>
                                    @if( $value->status == 1 )
                                    <span class="text-success">Approved</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script type="text/javascript">
$(document).ready( function () {
    $('.table').DataTable();
} );
$(document).ready(function() {
    $("#amount").change(function(){
        var mamazpoisha = $("#amount").val() / 100;
        $("#resultmpoisha").html("<center><h2 class='text-danger'>"+"৳"+ mamazpoisha+" BDT"+"</h2></center>"+"<div class='alert alert-danger'>"+"উপরের টাকাটি আপনার মামাজ পয়সাতে যুক্ত হবে। রাজি থাকলে সাবমিট করুন।"+"</div>");

    });
});

$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
        $("#submit").attr("disabled", true);
        $("#submit").text("প্রসেসিং ...");
        $('#submit').append('<div class="spinner-border spinner-border-sm"></div>')
    });
});
$(function() {
    $("#paymentmethod").change(function () {
        if ($(this).val() == "bankcash") {
                $("#bankcash").slideToggle("slow");
                $("#bankcash").show();     
            }
        else{
            $("#bankcash").slideToggle("slow");
            $("#bankcash").hide();
        }
    });
});
</script>
@endsection