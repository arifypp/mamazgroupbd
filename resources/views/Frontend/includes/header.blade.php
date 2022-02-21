  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
       <div class="col-lg-6">
          <div class="logo">
         <a href="{{ route('homepage') }}">
      @foreach( $site_settings as $value )
           <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="Mamaz" class="img-fluid">
      @endforeach
          </a>
      </div>
    </div>
     
    <div class="col-lg-6">
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto @if( Route::currentRouteNamed('homepage')) active @endif" href="{{ route('homepage') }}">হোম</a></li>
          <li><a class="nav-link scrollto @if( Route::currentRouteNamed('about')) active @endif" href="{{ route('about') }}"> আমাদের সম্পর্কে </a></li>
         
           <li><a class="nav-link scrollto @if( Route::currentRouteNamed('services')) active @endif" href="{{ route('services') }}">সার্ভিসেস</a> </li>
          <li ><a class="nav-link scrollto @if( Route::currentRouteNamed('contact')) active @endif" href="{{ route('contact') }}">যোগাযোগ</a></li>
          @auth
          @php 
              $user = auth()->user()->id; 
              $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
          @endphp
          <li><a class="getstarted scrollto" href="{{ route('user.dashboard') }}">ড্যাশবোর্ড <span> &nbsp;| @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif</span></a>
        </li>
        @endauth
        @guest
          <li><a class="getstarted scrollto" href="{{ route('userlogin') }}">সাইনইন করুন </a></li>
        @endguest 
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      </div>

    </div>
  </header><!-- End Header -->