@extends('layouts.master')

@section('title') উইখড্র রিকুয়েস্ট লিস্ট @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') উইখড্র রিকুয়েস্ট লিস্ট @endslot
        @slot('title') উইখড্র রিকুয়েস্ট লিস্ট @endslot
    @endcomponent


    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <table class="table data-table table-responsive align-middle">
                    <thead>
                        <th> নাম </th>
                        <th>পে: আইডি </th>
                        <th>ট্রান: আইডি </th>
                        <th> স্ট্যাটাস </th>
                        <th> টাকা </th>
                        <th> ওয়ালেট নাম </th>
                        <th> তারিখ </th>
                        <th>অ্যাকশন</th>
                    </thead>
                    <tbody>
                        @foreach( $withdrawaccept as $value )
                        <tr>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->payment_id }}</td>
                            <td>{{ $value->txn_id }}</td>
                            <td>
                                @if( $value->status == 1 )
                                <span class="text-success">Accepted</span>
                                @else
                                <span class="text-danger">Pending</span>
                                @endif
                            </td>
                            <td>৳{{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</td>
                            <td>{{ $value->wallettype->name }}</td>
                            <td>{{ date('d M, Y h:i:s a', strtotime($value->created_at)) }}</td>
                            <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#requestview{{ $value->id }}"> <i class="fa fa-eye"></i> </a>  &nbsp;

                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="fa fa-trash"></i></a>

                                <div class="modal fade" id="requestview{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ $value->user->name }} Sent withdraw Request</h5>
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
                                                        <th>Txn ID</th>
                                                        <td>:</td>
                                                        <td>{{ $value->txn_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Amount</th>
                                                        <td>:</td>
                                                        <td><h4 class="text-danger">৳ {{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Wallet Name</th>
                                                        <td>:</td>
                                                        <td><h4 class="text-success"> {{  $value->wallettype->name}}</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('withdraw.request', $value->id) }}" method="post">
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
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(document).ready( function () {
        $('.data-table').DataTable();
    } );

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
                    url:  "{{url('/admin/withdraw/delete')}}/" + id,
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