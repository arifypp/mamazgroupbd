@extends('Backend.Agent.includes.main')

@section('title') রিকুয়েস্ট মানি  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') রিকুয়েস্ট মানি  @endslot
        @slot('title') রিকুয়েস্ট মানি  @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive table">
                        <thead>
                            <th>ক্র. নং</th>
                            <th>সেন্ডার নাম</th>
                            <th>সেন্ডার আইডি</th>
                            <th>টাকার পরিমান</th>
                            <th>পেমেন্ট ম্যাথোড</th>
                            <th>স্ট্যাটাস</th>
                            <th>অ্যাকশন</th>
                        </thead>
                        <tbody>
                            @php 
                                $i = 1;
                            @endphp
                            @foreach( $money as $value )
                            @if( $value->user->referrer_id == Auth::user()->id )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->user->username }}</td>
                                <td>৳ {{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</td>
                                <td>{{ $value->bookingmoneymehtod }}</td>
                                <td>
                                    @if( $value->status == 1 )
                                    <span class="text-success">Approved</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-success" data-bs-toggle="modal" data-bs-target="#requestview{{ $value->id }}"><i class="mdi mdi-18px mdi-eye"></i></a>
                                    <!-- Model open  -->
                                <div class="modal fade" id="requestview{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ $value->user->name }} Sent Payment Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table-responsive table w-100 align-middle">
                                                <tbody>
                                                    <tr>
                                                        <th>Sender Name</th>
                                                        <td>:</td>
                                                        <td>{{ $value->user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sender ID</th>
                                                        <td>:</td>
                                                        <td>{{ $value->user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amount</th>
                                                        <td>:</td>
                                                        <td><h4 class="text-danger">৳ {{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mamaz Poisha Amount</th>
                                                        <td>:</td>
                                                        <td><h4 class="text-success">৳ {{ number_format( $value->amount / 100 , 0 , '.' , ',' ) }} Poisha</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Method</th>
                                                        <td>:</td>
                                                        <td>
                                                        @if( $value->bookingmoneymehtod == 'bkash' )
                                                        <span class="text-info">Bkash</span>
                                                        @elseif( $value->bookingmoneymehtod == 'Nagad' )
                                                        <span class="text-info">Nagad</span>
                                                        @elseif( $value->bookingmoneymehtod == 'bankcash' )
                                                        <span class="text-info">Ibanking</span>
                                                        @elseif( $value->bookingmoneymehtod == 'handcash' )
                                                        <span class="text-info">HandCash</span>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    @if($value->bookingmoneymehtod == 'bankcash')
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <td>:</td>
                                                        <td><h6 class="text-warning">{{ $value->banktransaction }}</h6></td>
                                                    </tr>
                                                    @else
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('agent.userrequestaccept', $value->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="auth_user" value="{{ $value->user->id }}">
                                            @if( $value->status == 0)
                                            <button type="submit" class="btn btn-primary" id="submit">Accept Request</button>
                                            @else
                                            <button type="button" class="btn btn-primary disabled" id="submit">Accepted</button>
                                            @endif
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                </td>
                            </tr>
                            @endif
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
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
        $("#submit").attr("disabled", true);
        $("#submit").text("প্রসেসিং ...");
        $('#submit').append('<div class="spinner-border spinner-border-sm"></div>')
    });
});

function deleteConfirmation(id) {
        swal.fire({
            title: "ডিলেট?",
            icon: 'question',
            text: "দয়া করে কনর্ফাম করুন!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "হ্যা, ডিলেট করুন!",
            cancelButtonText: "না, বাতিল করুন!",
            dangerMode: true,
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': '{{csrf_token()}}'
	                }
	            });
                
                $.ajax({
                    type: 'POST',
                    url:  "{{url('/admin/payment/delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            window.setTimeout(function(){location.reload()},2000)
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            // $('.table').load(document.URL + ' .table');     Using .reload() method.
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    }
</script>
@endsection