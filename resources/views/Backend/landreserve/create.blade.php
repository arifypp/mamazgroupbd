@extends('layouts.master')

@section('title') জমির রিজার্ভ তৈরি করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') জমির রিজার্ভ তৈরি করুন @endslot
    @slot('title') জমির রিজার্ভ তৈরি করুন @endslot
@endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <form action="{{ route('landreserve.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="এস এফ টি">এস এফ টি</label>
                                <input type="number" class="form-control" name="sft" placeholder="Enter SFT number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="ক্যাটাগরি">ক্যাটাগরি</label>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#LandCatAdd" class="bg-primary text-white" style="float:right">Add Category</a>
                                <select name="lcat" id="" class="form-control">
                                    <option value="0">নির্বাচন করুন</option>
                                    @foreach(App\Models\Backend\LandReserveCat::orderby('id', 'desc')->get() as $lcat )
                                    <option value="{{ $lcat->id }}">{{ $lcat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block w-100">
                                সাবমিট করুন
                            </button>
                        </div>
                    </div>
                </form>

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
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বন্ধ করুন</button>
                            <button type="submit" class="btn btn-primary">সেভ করুন</button>
                        </div>
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
    // Submit form
$(function(){
    $.ajaxSetup({
    headers: {
            "X-CSRFToken": '{{csrf_token()}}'
        }
    });
        $('#landCat').submit(function(e){
            e.preventDefault();
            var mydata = $(this).serialize();
            $.ajax({
                method : 'POST',
                url : "{{ route('landreserve.catstore') }}",
                data:mydata,
                success: function(response) {
                    if(response.success){
                        toastr.success(response.message);
                    }
                    setTimeout(function(){
                        document.getElementById("landCat").reset();
                    }, 3000);
                    
            },
            error:function (response){
                $('.text-danger').html('');
                $('.text-danger').delay(5000).fadeOut();
                // $.each(response.responseJSON.errors,function(field_name,error){
                //     $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                // })
            }
            })
        })

    })
</script>
@endsection