@extends('layouts.master')

@section('title') যোগাযোগ সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') যোগাযোগ সম্পর্কে সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                @if(empty( $contactinfo ))
                <form action="{{ route('contact.store') }}" method="post">
                @else
                <form action="{{ route('contact.update', $contactinfo->id) }}" method="post">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label"> যোগাযোগের ঠিকানা </label>
                        <input type="text" name="addressinfo" class="form-control" id="formrow-websiteherotitle-input" value="{{ $contactinfo->address}}" placeholder="ঠিকানা লিখুন!">
                    </div>
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label"> যোগাযোগের ই-মেইল </label>
                        <input type="text" name="email" class="form-control" id="formrow-websiteherotitle-input" value="{{ $contactinfo->email }}" placeholder="ই-মেইল লিখুন!">
                    </div>
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label"> যোগাযোগের মোবাইল নাম্বার </label>
                        <input type="text" name="phone" class="form-control" id="formrow-websiteherotitle-input" value="{{ $contactinfo->phone }}" placeholder="মোবাইল নং লিখুন!">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitinfo">সেভ করুন</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-8">

            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                  যোগাযোগ তথ্য লিস্ট
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="Table_id">
                        <thead>
                            <tr>
                                <th>নাম</th>
                                <th> ইমেইল </th>
                                <th>তারিখ</th>
                                <th>এ্যাকশন</th>
                            </tr>
                        </thead>


                        <tbody>
                        @php 
                            $i = 0;
                        @endphp
                        @foreach( App\Models\Frontend\ContactPage::orderBy('id','desc')->get() as $value )
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>{!! $value->email !!}</td>
                                <td>{{ $value->created_at->format('d-M-Y') }}</td>
                                <td>
                                <a href="javascript:void(0)" class="text-info" data-bs-toggle="modal" data-bs-target="#viewcfmessage{{ $value->id }}"><i class="mdi mdi-18px mdi-eye"></i></a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                </td>
                                
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="viewcfmessage{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ $value->name }} এর ম্যাসেজ সমূহ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="responsive border w-100">
                                <tr>
                                    <th>নাম</th>
                                    <td>:</td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                                <tr>
                                    <th> ই-মেইল </th>
                                    <td>:</td>
                                    <td>{{ $value->email }}</td>
                                </tr>
                                <tr>
                                    <th> ম্যাসেজ </th>
                                    <td>:</td>
                                    <td>{{ $value->message }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">দেখা হয়েছে</button>
                        </div>
                    </div>
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
    $(document).ready(function() {
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
            $("#submitinfo").attr("disabled", true);
            $("#submitinfo").text("প্রসেসিং ...");
            $('#submitinfo').append('<div class="spinner-border spinner-border-sm"></div>')
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
                    url:  "{{url('/admin/contact/delete')}}/" + id,
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
