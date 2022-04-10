@extends('layouts.master')

@section('title') ডিপোজিট লিস্ট  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ডিপোজিট @endslot
        @slot('title') ডিপোজিট লিস্ট  @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <table class="table data-table table-responsive align-middle">
                    <thead>
                        <th> ডিপোজিটর নাম </th>
                        <th>ওয়ালেট নাম</th>
                        <th>ট্রান্জিকশন আইডি </th>
                        <th> বিবরণ </th>
                        <th> মোট টাকা </th>
                        <th> তারিখ </th>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach( $deposit as $key => $value )
                           <tr>
                              <td>{{ $value->user->name }}</td>
                              <td>{{ $value->wallettype->name }}</td>
                              <td> {{ $value->txn_id }} </td>
                              <td> {{ $value->purpose }} </td>
                              <td>৳{{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</td>
                              <td>{{ date('d M, Y h:i:s a', strtotime($value->created_at)) }}</td>
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
    $(document).ready( function () {
        $('.data-table').DataTable();
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
                    url:  "{{url('/admin/withdraw/delete')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            window.setTimeout(function(){location.reload()},2000)
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            // $('.table').load(document.URL + ' .table');     Using .reload() method.
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