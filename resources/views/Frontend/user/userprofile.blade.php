@extends ('Frontend.layout.master') 
{{-- title --}} 
@section('title','ইউজার প্রোফাইল') 
@section('body') 
{{-- Profile section --}}
<section class="profile-section">
    <div class="container">
        <div class="main-body">
            <div class="mobiledevice">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="topbar1">
                            <h5>ইউজার প্রোফাইল</h5>
                        </div>
                    </div>
                </div>
            </div>
            @include('Frontend/user/bookingleft')
            <div class="col-md-9" style="background-color: #f8fafd; padding-top: 0px;">
                <div class="mb-6">
                    <div class="card">
                        <h5 style="padding: 10px 20px;">ইউজার প্রোফািইল</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="upper"></div>
                                        <div class="user text-center">
                                            <div class="profile"><img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" width="80" /></div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <h4 style="padding-top: 20px;">{{ Auth::user()->name }}</h4>
                                            <span class="text-muted d-block mb-2">{!! App\Models\User::PromoteLevel() !!}</span>
                                            <div class="social-links mt-2">
                                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                                            </div>
                                            <div class="button-design2">
                                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-9 px-4">
                                                <div class="stats">
                                                    <h6 class="mb-0">Booked</h6>
                                                    <span>
                                                    {{ App\Models\Frontend\Booking::bookcount() }}
                                                    </span>
                                                </div>
                                                <div class="stats">
                                                    <h6 class="mb-0">Reports</h6>
                                                    <span>
                                                    {{ App\Models\Frontend\Report::reportCount() }}
                                                    </span>
                                                </div>
                                                <div class="stats">
                                                    <h6 class="mb-0">Ranks</h6>
                                                    <span>
                                                    {{ App\Models\User::PromoteNumber() }}  
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 style="padding: 10px 20px;">ইউজার প্রোফািইল</h5>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div id="Setting">
                                            <div class="row">
                                                <form action="" method="post" id="updateuserInfo">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="Name">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Username">Username</label>
                                                        <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Address">Address</label>
                                                        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Date of Birth">Date of Birth</label>
                                                        <input type="date" name="dob" id="dob" class="form-control" value="{{ Auth::user()->dob }}">
                                                    </div>
                                                </form>
                                                    
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
   <script>
       
       $(document).ready(function() {
            $.ajaxSetup({
            headers: {
                    "X-CSRFToken": '{{csrf_token()}}'
                }
            });
        $("#updateuserInfo").change(function(){        
            var mydata = $(this).serialize();
            $.ajax({
                    method : 'POST',
                    url : "{{ route('user.updatedata', Auth::user()->id) }}",
                    data:mydata,
                    success: function(response) {
                        if(response.success){
                            toastr.success(response.message);
                        }                      
                        
                },
                error:function (response){
                    $('.text-danger').html('');
                    $('.text-danger').delay(5000).fadeOut();
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                    })
                }
                })
        });
    });
   </script>
@endsection