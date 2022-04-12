@extends('Backend.Agent.includes.main')

@section('title') টোটল বুকিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') বুকিং @endslot
        @slot('title') টোটাল বুকিং @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>বুকিং আইডি</th>
                            <th>গ্রাহকের নাম</th>
                            <th>প্লট / জমির পরিমান</th>
                            <th>টাকার পরিমান</th>
                            <th>মোবাইল</th>
                            <th>স্টাটার্স</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach( $bookings as $booking )
                        <tr>
                            <td>{{ $booking->bookingid }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->flatvalue }}</td>
                            <td>{{ $booking->bookingmoney }}</td>
                            <td>{{ $booking->phonenumber }}</td>
                            <td>
                                <a href="{{ route('bbooking.show', $booking->id) }}" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$booking->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
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
<script type="text/javascript">
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
                    url:  "{{url('/admin/booking/delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            $('.table').load(document.URL + ' .table');     // Using .reload() method.
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