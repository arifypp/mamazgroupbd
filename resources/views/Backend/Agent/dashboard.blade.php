@extends('Backend.Agent.includes.main')

@section('title') @lang('translation.Dashboards') @endsection
@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') ড্যাশবোর্ড @endslot
@slot('title') ড্যাশবোর্ড @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">স্বাগতম আবারও !</h5>
                            <p> এজেন্ট ড্যাশবোর্ড</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Str::ucfirst(Auth::user()->name) }}</h5>
                        <p class="text-muted mb-0 text-truncate">{{ Str::ucfirst(Auth::user()->username) }}</p>
                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target=".update-profile">পরিবর্তন</a>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">
                                    @php 
                                    $TotalBook = App\Models\Frontend\Booking::where('bookingauthid', Auth::user()->id)->count();
                                    $num = $TotalBook;
                                    $units = ['', 'K', 'M', 'B', 'T'];
                                        for ($i = 0; $num >= 1000; $i++) {
                                            $num /= 1000;
                                        }
                                        echo round($num, 1) . $units[$i];
                                    @endphp
                                    </h5>
                                    <p class="text-muted mb-0">বুকিং</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">
                                    @php 
                                        $user = auth()->user()->id; 
                                        $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
                                    @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                    </h5>
                                    <p class="text-muted mb-0">বর্তমান টাকা</p>
                                </div>
                                <div class="col-6"><br>
                                    <h5 class="font-size-15">
                                    @php 
                                        $user = auth()->user()->id; 
                                        $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 14)->get();
                                    @endphp
                                        @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                    </h5>
                                    <p class="text-muted mb-0">মামাজ পয়সা</p>
                                </div>
                                <div class="col-6"><br>
                                    <h5 class="font-size-15">
                                    @php 
                                        $user = auth()->user()->id; 
                                        $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
                                    @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                    </h5>
                                    <p class="text-muted mb-0">অ্যাসেট টাকা</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">মাসিক ইনকাম</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-muted">গত মাস</p>
                        <h3>৳34,252</h3>
                        <p class="text-muted"><span class="text-success me-2"> 12% <i class="mdi mdi-arrow-up"></i>
                            </span> এগিয়ে আগের মাস থেকে।</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="mt-4 mt-sm-0">
                            <div id="radialBar-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
                <p class="text-muted mb-0">এটা একটি ডিজিটাল প্লাটফর্ম যেখানে প্রতি মাসের একটা ফুল পেমেন্ট এর ডায়াগ্রাম তৈরি করা হয়েছে। যার মাধ্যমে এডমিন এবং কর্তৃপক্ষ খুব সহজে বুঝতে পারবে মাসিক ইনকাম।</p>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">অ্যাসেট টাকা</p>
                                <h4 class="mb-0">
                                    @php 
                                        $user = auth()->user()->id; 
                                        $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
                                    @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-money font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ক্যাশ টাকা</p>
                                <h4 class="mb-0">
                                @php 
                                    $user = auth()->user()->id; 
                                    $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 9)->get();
                                    @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-book-content font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">এজেন্ট টাকা</p>
                                <h4 class="mb-0">
                                @php 
                                    $user = auth()->user()->id; 
                                    $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 11)->get();
                                @endphp
                                        @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-user font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">চ্যারিটি দান টাকা</p>
                                <h4 class="mb-0">
                                @php 
                                    $user = auth()->user()->id; 
                                    $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 12)->get();
                                @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-run font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">ভ্যাট / ট্যাক্স</p>
                                <h4 class="mb-0">
                                @php 
                                    $user = auth()->user()->id; 
                                    $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 13)->get();
                                @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-user-rectangle font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">মামাজ পয়সা</p>
                                <h4 class="mb-0">
                                @php 
                                    $user = auth()->user()->id; 
                                    $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 14)->get();
                                @endphp
                                    @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                                </h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-landmark font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Revenue</h4>
                        <div id="revenue-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->

<!-- Transaction Modal -->
<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="{{ URL::asset('/assets/images/product/img-7.png') }}" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                    </div>
                                </td>
                                <td>$ 255</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="{{ URL::asset('/assets/images/product/img-4.png') }}" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                        <p class="text-muted mb-0">$ 145 x 1</p>
                                    </div>
                                </td>
                                <td>$ 145</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Shipping:</h6>
                                </td>
                                <td>
                                    Free
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!--  Update Profile example -->
<div class="modal fade update-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="update-profile">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" value="{{ Auth::user()->email }}" name="email" placeholder="Enter email" autofocus>
                        <div class="text-danger" id="emailError" data-ajax-feedback="email"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" id="username" name="name" autofocus placeholder="Enter username">
                        <div class="text-danger" id="nameError" data-ajax-feedback="name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userdob">Date of Birth</label>
                        <div class="input-group" id="datepicker1">
                            <input type="text" class="form-control @error('dob') is-invalid @enderror" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-date-end-date="0d" value="{{ date('d-m-Y', strtotime(Auth::user()->dob)) }}" data-provide="datepicker" name="dob" autofocus id="dob">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                        <div class="text-danger" id="dobError" data-ajax-feedback="dob"></div>
                    </div>

                    <div class="mb-3">
                        <label for="avatar">Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus>
                            <label class="input-group-text" for="avatar">Upload</label>
                        </div>
                        <div class="text-start mt-2">
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="" class="rounded-circle avatar-lg">
                        </div>
                        <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdateProfile" data-id="{{ Auth::user()->id }}" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- profile init -->
<script src="{{ URL::asset('/assets/js/pages/profile.init.js') }}"></script>
<!-- Chartradial -->
<script type="text/javascript">
var options = {
  chart: {
    height: 360,
    type: "bar",
    stacked: !0,
    toolbar: {
      show: !1
    },
    zoom: {
      enabled: !0
    }
  },
  plotOptions: {
    bar: {
      horizontal: !1,
      columnWidth: "15%",
      endingShape: "rounded"
    }
  },
  dataLabels: {
    enabled: !1
  },
  series: [{
    name: "Series A",
    data: [44, 55, 41, 67, 22, 43, 36, 52, 24, 18, 36, 48]
  }, {
    name: "Series B",
    data: [13, 23, 20, 8, 13, 27, 18, 22, 10, 16, 24, 22]
  }, {
    name: "Series C",
    data: [11, 17, 15, 15, 21, 14, 11, 18, 17, 12, 20, 18]
  }],
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
  },
  colors: ["#556ee6", "#f1b44c", "#34c38f"],
  legend: {
    position: "bottom"
  },
  fill: {
    opacity: 1
  }
},
chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
chart.render();
options = {
  chart: {
    height: 200,
    type: "radialBar",
    offsetY: -10
  },
  plotOptions: {
    radialBar: {
      startAngle: -135,
      endAngle: 135,
      dataLabels: {
        name: {
          fontSize: "13px",
          color: void 0,
          offsetY: 60
        },
        value: {
          offsetY: 22,
          fontSize: "16px",
          color: void 0,
          formatter: function formatter(e) {
            return e + "%";
          }
        }
      }
    }
  },
  colors: ["#38a3a5"],
  fill: {
    type: "gradient",
    gradient: {
      shade: "dark",
      shadeIntensity: .15,
      inverseColors: !1,
      opacityFrom: 1,
      opacityTo: 1,
      stops: [0, 50, 65, 91]
    }
  },
  stroke: {
    dashArray: 4
  },
  series: [60],
  labels: ["Series A"]
};
(chart = new ApexCharts(document.querySelector("#radialBar-chart"), options)).render();
</script>
<script>
    $('#update-profile').on('submit', function(event) {
        event.preventDefault();
        var Id = $('#data_id').val();
        let formData = new FormData(this);
        $('#emailError').text('');
        $('#nameError').text('');
        $('#dobError').text('');
        $('#avatarError').text('');
        $.ajax({
            url: "{{ url('update-profile') }}" + "/" + Id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#emailError').text('');
                $('#nameError').text('');
                $('#dobError').text('');
                $('#avatarError').text('');
                if (response.isSuccess == false) {
                    alert(response.Message);
                } else if (response.isSuccess == true) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            },
            error: function(response) {
                $('#emailError').text(response.responseJSON.errors.email);
                $('#nameError').text(response.responseJSON.errors.name);
                $('#dobError').text(response.responseJSON.errors.dob);
                $('#avatarError').text(response.responseJSON.errors.avatar);
            }
        });
    });
</script>
@endsection