@extends('layouts.master')

@section('title') আমাদের সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') আমাদের সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-128 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                @if( App\Models\Backend\OurDetails::find(1) )
                <form action="{{ route('oursetting.update', $ourdetails->id) }}" method="post" enctype="multipart/form-data">
                @else
                <form action="{{ route('oursetting.store') }}" method="post" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">সেটিং টাইটেল</label>
                        <input type="text" name="title" class="form-control" placeholder="টাইটেল লিখুন!" value="{{ $ourdetails->title }}">
                    </div>
                    <div class="mb-5">
                        <label for="formrow-websiteherotitle-input" class="form-label">সেটিং ছোট বিবরণ</label>
                        <textarea name="desc" id="elm1" cols="5" rows="3" class="form-control">{{ $ourdetails->desc }}</textarea>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('assets/images/'. $ourdetails->image) }}" alt="" width="100" class="img-fluid"> <br>
                        <label for="formrow-websiteherotitle-input" class="form-label">সেটিং ফটো</label>
                        <input type="file" name="image" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
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
    
// $(function(){
//     $.ajaxSetup({
//     headers: {
//             "X-CSRFToken": '{{csrf_token()}}'
//         }
//     });
//     $('#submitdata').submit(function(e){
//         e.preventDefault();
//         var mydata = $(this).serialize();
//         $.ajax({
//             method : 'POST',
//             url : "{{ route('service.storeservice') }}",
//             data:mydata,
//             success: function(response) {
//                 if(response.success){
//                     toastr.success(response.message);
//                 }
//                 setTimeout(function(){
//                     document.getElementById("submitdata").reset();
//                 }, 3000);
                
//         },
//         error:function (response){
//             $('.text-danger').html('');
//             $('.text-danger').delay(5000).fadeOut();
//             $.each(response.responseJSON.errors,function(field_name,error){
//                 $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
//             })
//         }
//         })
//     })

// })
</script>
@endsection
