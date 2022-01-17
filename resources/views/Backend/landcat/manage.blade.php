@extends('layouts.master')

@section('title') জমির লিস্ট @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') জমির লিস্ট @endslot
        @slot('title') জমির লিস্ট @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>জমির পরিমাণ</th>
                            <th>জমির মূল্য</th>
                            <th>জমির স্টাটার্স</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>


                    <tbody>
                        @php 
                            $i = 1;
                        @endphp
                        @foreach( $landcat as $value )
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value->landvalue }}</td>
                            <td>{{ $value->landprice }}</td>
                            <td> 
                                @if( $value->status == 1 )
                                <span class="text-success">একটিভ</span>
                                @else
                                <span class="text-danger">ইন-একটিভ</span>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>
                                <a href="{{ route('landcat.edit', $value->id) }}" class="text-info"><i class="mdi mdi-18px mdi-lead-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                <a href="javascript:void(0)" class="text-primary"><i class="mdi mdi-18px mdi-file-pdf"></i></a>
                            </td>
                        </tr>
                        @php 
                            $i++;
                        @endphp
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
                    url:  "{{url('/admin/landcat/delete')}}/" + id,
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