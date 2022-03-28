@extends('layouts.master')

@section('title') জমির রিজার্ভ লিস্ট @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') জমির রিজার্ভ লিস্ট @endslot
        @slot('title') জমির রিজার্ভ লিস্ট @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 mb-3 align-self-end text-right align-items-end justify-content-end">
        <a href="{{ route('landreserve.create') }}" class="btn btn-danger" rel="noopener noreferrer"> জমি রিজার্ভ করুন </a>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#LandCatAdd" class="btn btn-success" rel="noopener noreferrer"> ক্যাটাগরি লিস্ট </a>

            <div class="modal fade" id="LandCatAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ক্যাটাগড়ি তৈরি করুন</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('landreserve.catstore') }}" method="post" id="landCat">
                                @csrf 
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="ক্যাটাগরির নাম">ক্যাটাগরির নাম</label>
                                        <input type="text" name="lcname" id="lcname" class="form-control" placeholder="ক্যাটাগরির নাম লিখুন">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ক্যাটাগরির নাম">ক্যাটাগরির মূল্য</label>
                                        <input type="text" name="lcprise" id="lcprise" class="form-control" placeholder="ক্যাটাগরির মূল্য লিখুন">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ক্যাটাগরির নাম">ক্যাটাগরির স্ট্যাটাস</label>
                                        <select name="lcstatus" id="" class="form-control">
                                            <option value="0">নির্বাচন করুন</option>
                                            <option value="1">একটিভ</option>
                                            <option value="1">ইন একটিভ</option>
                                        </select>
                                    </div>
                                </div>

                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>ক্যাটাগরি নাম</th>
                                            <th>মূল্য</th>
                                        </tr>
                                        <tbody>
                                            @foreach( App\Models\Backend\LandReserveCat::all() as $key => $catname )
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td> {{ $catname->name }} </td>
                                                    <td>৳ {{ number_format( $catname->price, 0 , '.' , ',' ) }} BDT </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বন্ধ করুন</button>
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <table id="land_table" class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>এস এফ টি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>


                    <tbody>
                        @php 
                            $i = 1;
                        @endphp
                        @foreach( $landreserve as $value )
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value->sft }} SFT</td>
                            <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Landdetailsview{{ $value->id }}" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>

                                <div class="modal fade" id="Landdetailsview{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">জমি রিজার্ভলিস্ট ভিউ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>এস এফ টি</th>
                                                            <td>:</td>
                                                            <td> {{ $value->sft }} </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>                                        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">বন্ধ করুন</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('landreserve.edit', $value->id) }}" class="text-info"><i class="mdi mdi-18px mdi-lead-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
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
 
    $(document).ready( function () {
        $('#land_table').DataTable();
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
                    url:  "{{url('/admin/landreserve/delete')}}/" + id,
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