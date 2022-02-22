@extends('layouts.master')

@section('title') গ্যালারি সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">

            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                   আমাদের ফটো সমুহ
                   <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">নতুন ফটো যোগ করুন</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="Table_id">
                        <thead>
                            <tr>
                                <th>ক্র. নং.</th>
                                <th>ক্যাটাগরি নাম</th>
                                <th>গ্যালারি ফটো</th>
                                <th>এ্যাকশন</th>
                            </tr>
                        </thead>


                        <tbody>
                        @php 
                            $i = 1;
                        @endphp
                        @foreach( App\Models\Backend\Gallery::orderBy('id','asc')->get() as $value )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->gallaryscatid }}</td>
                                <td> <img src="{{ asset(''.$value->image) }}" alt="" class="img-fluid" width="40"> </td>
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
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">নতুন ক্যাটাগরি যোগ করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('gallery.store') }}" id="submitdata" method="post" enctype="multipart/form-data" class="dropzone"> 
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">ক্যাটাগরি নাম</label>
                                    <select name="catID" id="" class="form-control">
                                        <option value="0">ক্যাটাগরি নির্বাচন করুন</option>
                                        @foreach( App\Models\Backend\GalleryCategory::orderBy('id','asc')->get() as $value )
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">ফটো আপলোড করুন</label>
                                    <div class="fallback">
                                        <input type="file" name="file[]" multiple="multiple">
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                            <!-- <button type="submit" class="btn btn-primary" id="sendbtn">সেভ করুন</button> -->
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
$(function() {
    Dropzone.options.fileDropzone = {
    url: '{{ route('gallery.store') }}',
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: false,
    maxFilesize: 8,
    headers: {
    'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    removedfile: function(file)
    {
      var name = file.upload.filename;
      $.ajax({
        type: 'POST',
        url: '{{ route('gallery.remove') }}',
        data: { "_token": "{{ csrf_token() }}", name: name},
        success: function (data){
            console.log("File has been successfully removed!!");
        },
        error: function(e) {
            console.log(e);
        }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function (file, response) {
        console.log(file);
        
    },
  }

  Dropzone.options.uploadWidget = {
        init: function() {
            this.on('success', function( file, resp ){
            alert("Success");
            toastr.success(response.message);
            });
        },
    };
});
    
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
