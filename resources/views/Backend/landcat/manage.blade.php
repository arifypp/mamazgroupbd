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
                <table id="land_table" class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>শতাংশ</th>
                            <th>ফ্ল্যাট সংখ্যা</th>
                            <th>স্কয়ার ফিট</th>
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
                            <td>{{ $value->mainland }}</td>
                            <td>{{ $value->floornumber }}</td>
                            <td> {{ $value->totalsquarefit }} </td>
                            <td>
                            <a href="javascript:void(0)" class="text-success" data-bs-toggle="modal" data-bs-target="#landcost{{ $value->id }}"><i class="mdi mdi-18px mdi-plus"></i></a>
                                <a href="javascript:void(0)" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>
                                <a href="{{ route('landcat.edit', $value->id) }}" class="text-info"><i class="mdi mdi-18px mdi-lead-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                <a href="javascript:void(0)" class="text-primary"><i class="mdi mdi-18px mdi-printer"></i></a>
                            </td>
                        </tr>
                        @php 
                            $i++;
                        @endphp
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>মোট ইউনিট</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="landcost{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Landing Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="" method="post" id="itemcost">
                        @csrf
                        <table class="table table-responsive" id="dynamicAddRemove">
                            <tr>
                                <th>Item Name</th>
                                <th>Item Cost</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="addMoreInputFields[0][itemname]" placeholder="Enter Description" class="form-control" />
                                <span class="text-danger">@error('itemname[0]'){{ $message }} @enderror</span>
                                @error('addMoreInputFields.'.$key.'.itemname')
                                </td>
                                <td><input type="text" name="addMoreInputFields[0][cost]" placeholder="Enter cost" class="form-control" />
                                </td>
                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add More</button></td>
                            </tr>
                        </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="itemcost" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript">
    // Dynamic multiple field
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][itemname]" placeholder="Enter item name" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][cost]" placeholder="Enter item name" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });




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

    // Submit form
$(function(){
    $.ajaxSetup({
    headers: {
            "X-CSRFToken": '{{csrf_token()}}'
        }
    });
    $('#itemcost').submit(function(e){
        e.preventDefault();
        var mydata = $(this).serialize();
        $.ajax({
            method : 'POST',
            url : "{{ route('landcost.store') }}",
            data:mydata,
            success: function(response) {
                if(response.success){
                    toastr.success(response.message);
                }
                setTimeout(function(){
                    document.getElementById("itemcost").reset();
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