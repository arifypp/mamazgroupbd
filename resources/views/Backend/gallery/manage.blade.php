@extends('layouts.master')

@section('title') গ্যালারি সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<style>
#text-small {
   width:1rem !important; 
   height:1rem !important;    
   border: 0.20em solid !important;
}
</style>
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') গ্যালারি সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                <form action="{{ route('gallery.update', $cattitle->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">সার্ভিস টাইটেল</label>
                        <input type="text" name="title" class="form-control" id="formrow-websiteherotitle-input" placeholder="টাইটেল লিখুন!" value="{{ $cattitle->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">সার্ভিস বিবরণ</label>
                        <input type="text" name="desc" class="form-control" id="formrow-websiteherotitle-input" placeholder="গ্যালারি বিবরণ!" value="{{ $cattitle->desc }}">
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
                   আমাদের সার্ভিস সমুহ
                   <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">নতুন সার্ভিস যোগ করুন</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="Table_id">
                        <thead>
                            <tr>
                                <th>ক্র. নং.</th>
                                <th>ক্যাটাগরি নাম</th>
                                <th>এ্যাকশন</th>
                            </tr>
                        </thead>


                        <tbody>
                        @php 
                            $i = 1;
                        @endphp
                        @foreach( App\Models\Backend\GalleryCategory::orderBy('id','asc')->get() as $value )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->name }}</td>
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
                            <h5 class="modal-title" id="staticBackdropLabel">নতুন ক্যাটাগরি যোগ করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('gallery.storecat') }}" id="submitdata" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">ক্যাটাগরি নাম</label>
                                    <input type="text" name="name" class="form-control" placeholder="ক্যাটাগরি নাম!">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                            <button type="submit" class="btn btn-primary" id="sendbtn">সেভ করুন</button>
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
                    url:  "{{url('/admin/service/delete')}}/" + id,
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

    $('#sendbtn').click(function(){
        this.form.submit();
        this.disabled=true;
        this.innerHTML='<div class="spinner-border text-dark" id="text-small"></div> প্রসেসিং';
    });
</script>
@endsection
