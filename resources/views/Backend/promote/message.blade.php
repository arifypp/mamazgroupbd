@extends('layouts.master')

@section('title') প্রমোট লেভেল মেসেজ @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') প্রমোট লেভেল মেসেজ @endslot
        @slot('title') প্রমোট লেভেল মেসেজ @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                <form action="{{ route('promote.message.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">মেসেজেস</label>
                        <textarea name="promotemessage" id="promotemessage" class="form-control" cols="10" rows="3"></textarea>
                        <span class="text-danger">@error('promotemessage'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-5">
                        <label for="formrow-websiteherotitle-input" class="form-label">পদবি নাম</label>
                        <select name="levelname" id="" class="form-control">
                            @foreach( $promoteLevel as $value )
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('levelname'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
            </div>
            
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-8">
            <div class="card card-body">
                <table class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>ক্র.নং</th>
                            <th>মেসেজ নাম</th>
                            <th>পদবি নাম</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>


                    <tbody>
                        @php $i = 1;  @endphp
                        @foreach( $Promotemessage as $value )
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->name }}</td>
                            <td>
                                <span class="badge-success">{{ $value->promote->name }}</span>                              

                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{$value->id}}')" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                <!-- <a href="{{ route('promote.edit', $value->id) }}" class="text-primary"><i class="mdi mdi-18px mdi-pen"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
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
                    url:  "{{url('/admin/promote/delete/message')}}/" + id,
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