@extends('layouts.master')

@section('title') আমাদের সম্পর্কে সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') আমাদের সম্পর্কে সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                @if(empty( $about ))
                <form action="{{ route('about.storepagetitle') }}" method="post">
                @else
                <form action="{{ route('about.updatepagetitle', $about->id) }}" method="post">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">পেইজ টাইটেল</label>
                        <input type="text" name="title" class="form-control" id="formrow-websiteherotitle-input" value="{{ $about->title }}" placeholder="টাইটেল লিখুন!">
                    </div>
                    <div class="mb-5">
                        <label for="formrow-websiteherotitle-input" class="form-label">পেইজ ছোট বিবরণ</label>
                        <textarea name="desc" id="" cols="5" rows="3" class="form-control">{{ $about->desc }}</textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-8">

            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                   পেইজ কনটেন্ট সমুহ
                   <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">নতুন কনটেন্ট যোগ করুন</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="Table_id">
                        <thead>
                            <tr>
                                <th>নাম</th>
                                <th>বিবরণ</th>
                                <th>এ্যাকশন</th>
                            </tr>
                        </thead>


                        <tbody>
                        @php 
                            $i = 0;
                        @endphp
                        @foreach( App\Models\Frontend\AboutContent::orderBy('id','asc')->get() as $value )
                            <tr>
                                <td>{{ $value->title }}</td>
                                <td>{!! $value->desc !!}</td>
                                <td>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#aboutpage{{ $value->id }}" class="text-success"><i class="mdi mdi-18px mdi-pen"></i></a>
            
            <div class="modal fade" id="aboutpage{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">এডিট কনটেন্ট করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('about.update', $value->id) }}" id="submitdata" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">কনটেন্ট টাইটেল</label>
                                    <input type="text" name="name" value="{{ $value->title }}" class="form-control" placeholder="সার্ভিস টাইটেল!">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">কনটেন্ট বিবরণ (বিস্তারিত)</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control" id="elm1">{!! $value->desc !!}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">কনটেন্ট লেআউট</label>
                                    <select name="layout" id="" class="form-control">
                                        <option value="0">নির্বাচন করুন</option>
                                        <option value="1">ডানদিক</option>
                                        <option value="2">বামদিক</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                </td>
                                
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">নতুন কনটেন্ট যোগ করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('about.store') }}" id="submitdata" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">কনটেন্ট টাইটেল</label>
                                    <input type="text" name="name" class="form-control" placeholder="সার্ভিস টাইটেল!">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">কনটেন্ট বিবরণ (বিস্তারিত)</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control" id="elm1"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">কনটেন্ট লেআউট</label>
                                    <select name="layout" id="" class="form-control">
                                        <option value="0">নির্বাচন করুন</option>
                                        <option value="1">ডানদিক</option>
                                        <option value="2">বামদিক</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                            </form>
                        </div>
                    </div>
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
                    url:  "{{url('/admin/about-setting/delete')}}/" + id,
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
