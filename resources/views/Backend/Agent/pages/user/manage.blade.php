@extends('Backend.Agent.includes.main')

@section('title') মোট ব্যবহারকারী  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') মোট ব্যবহারকারী  @endslot
        @slot('title') মোট ব্যবহারকারী  @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive table align-middle">
                        <thead>
                            <th>ক্র. নং</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>আইডি</th>
                            <th>লেভেল</th>
                            <th>স্ট্যাটাস</th>
                        </thead>
                        <tbody>
                            @php 
                                $i = 1;
                            @endphp
                            @foreach( $user as $value )
                            @if( $value->referrer_id == Auth::user()->id )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> <img src="{{ asset($value->avatar) }}" alt="{{$value->name}}" class="img-fluid img-rounded" width="20"> </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->username }}</td>
                                <td>
                                    @if( $value->auth_promote == 0 )
                                    <span class="text-success">Project Co-Ordinator</span>
                                    @elseif( $value->auth_promote == 1 )
                                        <span class="text-success">Marketing Executive</span>
                                    @elseif( $value->auth_promote == 2 )
                                        <span class="text-success">Assitant General Manager</span>
                                    @elseif( $value->auth_promote == 3 )
                                    <span class="text-success">General Manager</span>
                                    @elseif( $value->auth_promote == 4 )
                                    <span class="text-success">Project Director</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $value->status == 0 )
                                    <span class="text-success">active</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
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
        $('#transferporcess').modal('show');
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