@extends('Backend.Agent.includes.main')

@section('title') এ্যাপ্রুভ রিপোর্টস  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') এ্যাপ্রুভ রিপোর্টস  @endslot
        @slot('title') এ্যাপ্রুভ রিপোর্টস  @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive table align-middle">
                        <thead>
                            <th>ক্র. নং</th>
                            <th>রিপোট তারিখ</th>
                            <th>রিপোর্টকারীর নাম</th>
                            <th>ফোন নাম্বার</th>
                            <th>স্টাটার্স</th>
                            <th>অ্যাকশন</th>
                        </thead>
                        <tbody>
                            @php 
                                $i = 1;
                            @endphp
                            @foreach( $report as $value )
                            @if( $value->refereluserid == Auth::user()->id && $value->status == 1)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->phone }}</td>
                                <td> 
                                    @if( $value->status == 0 )
                                    <span class="text-danger">
                                        Pending
                                    </span>
                                    @elseif( $value->status == 1 )
                                    <span class="text-success">
                                        Approved
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('agent.report.show', $value->id) }}" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>
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
<script type="text/javascript">
$(document).ready( function () {
    $('.table').DataTable();
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
                    url:  "{{url('/agent/request/delete')}}/" + id,
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