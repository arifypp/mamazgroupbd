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
         
           <li class="dropdown"><a href="service.html"><span>সার্ভিসেস</span> <i class="bi bi-chevron-down"></i></a>
            <ul class="anyClass">
             <div class="megamenu">  
            <div class="container">
              <h6>Services</h6>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="left-menubar">
                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Akshir Property Development<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Mamaz Best Home & Interiot<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Property Development<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Eco Park Resort & Swimming<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Research Center<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                   <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Home All Solutions<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>IT & All Software Solutions<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Import & Export<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best School & College<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Medical College<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>
                 
                   
                </div>
                </div>
                 <div class="col-lg-6 col-md-12">
                  <div class="right-menubar">
                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Life Risk Support<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                    <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Fashion & Designer House<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                     <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Eco Tourism & Travels<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                        <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best All Idea Solution<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                         <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Eco Food & Delivery Beverage<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                      <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Training Centre<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Eco Agro & Nursery<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a> 

                      <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Rehab Centre<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>

                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Eco Industries<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>
                   
                  <a href=""><img src="{{ asset('Frontend/assets/img/group.png') }}"><strong>Best Foundation<br><p>Learn more about pricing &<br> get started your Business.</p></strong></a>
                  </div>
                 
                 
                </div>
                
              </div>
            </div>

          </div>
            </ul>
          </li>
          <li ><a class="nav-link scrollto @if( Route::currentRouteNamed('contact')) active @endif" href="{{ route('contact') }}">যোগাযোগ</a></li>
          @auth
          <li><a class="getstarted scrollto" href="{{ route('user.dashboard') }}">ড্যাশবোর্ড <span> &nbsp;| 850৳</span></a>
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