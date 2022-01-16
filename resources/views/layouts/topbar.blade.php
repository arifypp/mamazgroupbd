<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                    @foreach( $site_settings as $value )
                        <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="" height="22">
                    @endforeach
                    </span>
                    <span class="logo-lg">
                    @foreach( $site_settings as $value )
                        <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="" height="17">
                    @endforeach
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                    @foreach( $site_settings as $value )
                        <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitefaviconwhite) }}" alt="" height="40">
                    @endforeach
                    </span>
                    <span class="logo-lg">
                    @foreach( $site_settings as $value )
                        <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogowhite) }}" alt="" height="40">
                      @endforeach
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
    </div>

    <div class="d-flex">

        <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-magnify"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">
                
                <form class="p-3">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="@lang('translation.Search')" aria-label="Search input">
                            
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>s
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Language -->


        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                <i class="bx bx-fullscreen"></i>
            </button>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-bell bx-tada"></i>
                <span class="badge bg-danger rounded-pill">
                {{ count( auth()->user()->unreadNotifications ) }}
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0" key="t-notifications"> @lang('translation.Notifications') </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small" key="t-view-all"> @lang('translation.View_All')</a>
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 230px;">
                @forelse (auth()->user()->unreadNotifications as $notification)
                    @if(Str::snake(class_basename($notification->type)) == 'booking_notification')
                    <a href="{{ route('bbooking.show', $notification->data['id']) }}" class="text-reset notification-item" id="MarkasRead" data-id="{{ $notification->id }}" data-attr="{{ route('bbooking.notifyread', $notification->id) }}">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                    <i class="mdi mdi-bell-outline"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mt-0 mb-1" key="t-your-order">
                                    {{ $notification->data['bookingauthid'] }} নতুন বুকিং তৈরি করেছে। 
                                </h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{ $notification->created_at->format('M d, H:i A') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @elseif(Str::snake(class_basename($notification->type)) == 'booking_approve_notification')
                    <a href="{{ route('bbooking.show', $notification->data['id']) }}" class="text-reset notification-item" id="MarkasRead" data-id="{{ $notification->id }}" data-attr="{{ route('bbooking.notifyread', $notification->id) }}">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                    <i class="mdi mdi-bell-outline"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mt-0 mb-1" key="t-your-order">
                                    {{ $notification->data['bookingauthid'] }} এর বুকিং এপ্রুভ হয়েছে।
                                </h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{ $notification->created_at->format('M d, H:i A') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                @empty
                <a href="javascript:void(0)" class="text-reset notification-item">
                    <div class="flex-grow-1">
                        <h6 class="mt-0 mb-1" key="t-your-order">
                            কোনো নোটিফিকেশন পাওয়া যায়নি।
                        </h6>
                    </div>
                </a>
                
                @endforelse                    
                </div>
                <div class="p-2 border-top d-grid">
                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">@lang('translation.View_More')</span> 
                    </a>
                </div>
            </div>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->name)}}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="contacts-profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">@lang('translation.Profile')</span></a>
                <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">@lang('translation.My_Wallet')</span></a>
                <a class="dropdown-item d-block" href="#" data-bs-toggle="modal" data-bs-target=".change-password"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">@lang('translation.Settings')</span></a>
                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">@lang('translation.Lock_screen')</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
<!-- 
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                <i class="bx bx-cog bx-spin"></i>
            </button>
        </div> -->
        
    </div>
</div>
</header>

<!--  Change-Password example -->
<div class="modal fade change-password" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change-password">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                    <div class="mb-3">
                        <label for="current_password">Current Password</label>
                        <input id="current-password" type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password" autocomplete="current_password"
                            placeholder="Enter Current Password" value="{{ old('current_password') }}">
                        <div class="text-danger" id="current_passwordError" data-ajax-feedback="current_password"></div>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword">New Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new_password" placeholder="Enter New Password">
                        <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userpassword">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            autocomplete="new_password" placeholder="Enter New Confirm password">
                        <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm"></div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdatePassword" data-id="{{ Auth::user()->id }}"
                            type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@section('script')
<script>
      $(document).ready(function(){
      $(document).on("click", '#MarkasRead', function(e){
        e.preventDefault();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });

          var token = '{{ Session::token() }}';

          let href = $(this).attr('data-attr');
          let post_id = $(this).attr('data-id');

        //   console.log(post_id); 
          
          $.ajax({    
              type: 'GET',
              url: href,
              data : {id:post_id, _token: token},
              success:function(res){
                if(res.success){
                        console.log('Success for read notification');
                  }
              },
              error:function (res){
                    console.log("error");
                }
          });

          return false;
      })
    });
</script>

@endsection