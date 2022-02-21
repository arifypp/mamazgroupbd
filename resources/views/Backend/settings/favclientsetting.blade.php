@extends('layouts.master')

@section('title') প্রিয় ক্লাইন্ট সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') প্রিয় ক্লাইন্ট সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                <form action="{{ route('homesetting.favclientupdate', $favclient->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">প্রিয় ক্লাইন্ট টাইটেল</label>
                        <input type="text" name="title" class="form-control" id="formrow-websiteherotitle-input" placeholder="টাইটেল লিখুন!" value="{{ $favclient->title }}">
                    </div>
                    <div class="mb-5">
                        <label for="formrow-websiteherotitle-input" class="form-label">প্রিয় ক্লাইন্ট ছোট বিবরণ</label>
                        <textarea name="desc" id="" cols="5" rows="3" class="form-control">{{ $favclient->desc }}</textarea>
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
                   প্রিয় ক্লাইন্ট লোগো
                   <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">নতুন লোগো যোগ করুন</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ক্র.নং</th>
                                <th>লোগো</th>
                                <th>নাম</th>
                                <th>এ্যাকশন</th>
                            </tr>
                        </thead>


                        <tbody>
                        @php 
                            $i = 0;
                        @endphp
                        @foreach( App\Models\Backend\FavclientLogo::orderBy('id','asc')->get() as $value )
                            <tr>
                                <td><img src="{{ asset('assets/images/clients/'. $value->image) }}" class="img-fluid" width="50"></td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->url }}</td>
                                <td>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">নতুন লোগো যোগ করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('homesetting.favclientlogo') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="formrow-websiteherotitle-input" class="form-label">ক্লাইন্টের কোম্পানির নাম</label>
                                    <input type="text" name="name" class="form-control" id="formrow-websiteherotitle-input" placeholder="কোম্পানির নাম লিখুন!">
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-websiteherotitle-input" class="form-label">ক্লাইন্টের কোম্পানির ওয়েবসাইট</label>
                                    <input type="text" name="url" class="form-control" id="formrow-websiteherotitle-input" placeholder="কোম্পানির ওয়েবসাইট লিখুন!">
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="image" class="form-control" id="inputGroupFile02">
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
                    url:  "{{url('/homesettings/homesettings/')}}/" + id,
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