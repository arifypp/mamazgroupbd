<div class="row gutters-sm">
              <div class="col-md-3 mb-3">
            
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item justify-content-center align-items-center flex-wrap">
                        <div class="author-bio align-self-center align-item-center" style="text-align:center; color:black; ">
                          <div class="author-img text-center">
                          @if(Auth::user()->avatar)
                            <img class="image rounded-circle img-fluid" src="{{asset(Auth::user()->avatar)}}" alt="profile_image" width="80">
                          @else
                            <img class="image rounded-circle img-fluid" src="{{asset ('assets/images/favicon.ico')}}" alt="profile_image" width="80">
                          @endif
                          </div><hr>
                          <div class="author-name">
                            <span>{{ Auth::user()->name }}</span><br>
                            @php 
                              $countReferenceid = App\Models\User::where('referrer_id', Auth::user()->id)->count();
                            @endphp
                            @if( $countReferenceid <= 7 )
                            <small>Marketing Associate</small><br>
                            @elseif( $countReferenceid <= 14 )
                            <small>Marketing Cordinator</small><br>
                            @elseif( $countReferenceid <= 21 )
                            <small>Marketing Contractor Cordinator</small><br>
                            @endif
                            <span>{{ Auth::user()->username }}</span>
                          </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('user.dashboard') || Route::currentRouteNamed('user.dashboard') || Route::currentRouteNamed('user.dashboard') ) active @endif">
                      <a href="{{ route('user.dashboard') }}"><h6><i class="fas fa-tachometer-alt"></i>ড্যাশবোর্ড</h6></a>
                     
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('addmoney.create')) active @endif">
                      <a href="{{ route('addmoney.create') }}"><h6><i class="fas fa-hand-holding-usd"></i>টাকা যুক্ত করুন</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('apply.create') || Route::currentRouteNamed('booking.edit') || Route::currentRouteNamed('booking.create') ) active @endif">
                      <a href="{{ route('apply.create') }}"><h6><i class="fab fa-amazon-pay"></i> কিস্তি দিন</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('apply.create') || Route::currentRouteNamed('booking.edit') || Route::currentRouteNamed('booking.create') ) active @endif">
                      <a href="{{ route('apply.create') }}"><h6><i class="fas fa-pen"></i>আবেদন করুন</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('booking.manage') || Route::currentRouteNamed('booking.edit') || Route::currentRouteNamed('booking.create') ) active @endif">
                      <a href="{{ route('booking.manage') }}"><h6><i class="fas fa-swatchbook"></i>বুকিং দিন</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('booking.list')) active @endif">
                      <a href="{{ route('booking.list') }}"><h6><i class="fas fa-sticky-note"></i>বুকিং লিস্ট</h6></a>
                     
                    </li>
                    @php
                   $application =  App\Models\Frontend\Booking::where('bookingauthid', 3 )->get();
                    @endphp
                  @if( !empty( auth()->user()->id == $application[0]->bookingauthid) )
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('report.manage')) active @endif">
                      <a href="{{ route('report.manage') }}"><h6><i class="fas fa-book"></i>রিপোর্ট লিস্ট</h6></a>
                     
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap @if( Route::currentRouteNamed('report.create')) active @endif">
                      <a href="{{ route('report.create') }}"><h6><i class="fas fa-book"></i>রিপোর্ট পাঠান</h6></a>
                     
                    </li>
                  @endif  
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                      <a href="profile.html"><h6><i class="fas fa-user-cog"></i>প্রোফাইল সেটিং</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                          <h6><i class="fas fa-power-off"></i>লগ আউট</h6>
                      </a>    
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>                     
                    </li>
                  </ul>
                </div>
              </div>