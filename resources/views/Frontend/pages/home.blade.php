@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','হোম পেইজ')
  @section('body')
 <!-- ======= Hero Section ======= -->
   <section id="hero" class="d-flex align-items-center">
      <div class="container">
         <div class="row gy-4">
         @foreach( App\Models\Backend\HompageHero::orderBy('id','asc')->get() as $value )
            <div class="col-lg-7 order-1 order-lg-1 d-flex flex-column justify-content-center">
               <h1> {!! $value->title !!} </h1>
               <p>{{ $value->description }}</p>
            </div>
            <div class="col-lg-5 order-2 order-lg-2 hero-img">
               <img src="{{ asset('/assets/images/settings/'. $value->image) }}" class="img-fluid animated" alt="">
            </div>
         @endforeach
         </div>
      </div>
   </section>
 <!-- ======= Clients Section ======= -->
 <section id="clients" class="clients section-bg">
    <div class="container">
       <div class="row">
          <div class="col-md-5">
             <div class="section-title">
               @foreach( App\Models\Backend\FavClient::orderBy('id','asc')->get() as $value )
                <h2> {{ $value->title }} </h2>
                <p> {{ $value->desc }} </p>
               @endforeach
             </div>
          </div>
          <div class="col-md-7">
             <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                @foreach( App\Models\Backend\FavclientLogo::all() as $value )
                   <div class="swiper-slide"><img src="{{ asset('assets/images/clients/'. $value->image) }}" class="img-fluid" alt="{{ $value->name }}"></div>
                 @endforeach  
                </div>
                <div class="swiper-pagination"></div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- End Clients Section -->
 <!-- ======= Services Section ======= -->
 <section id="services" class="services section-bg">
    <div class="container">
       <div class="section-title1">
       @foreach( App\Models\Frontend\Ourserviceshead::all() as $value )
          <h2> {!! $value->title !!} </h2>
          <p> {{ $value->desc }} </p>
       @endforeach
       </div>
       <div class="design">
          <div class="row">
          @foreach( App\Models\Frontend\Ourservice::all() as $value)
             <div class="col-md-6 col-lg-2">
                <div class="icon-box">
                   <img src="{{ asset('assets/images/service/'. $value->image) }}" class="img-fluid" alt="">
                   <h4 class="title"><a href="{{ $value->slug }}">{{ $value->name }}</a></h4>
                </div>
             </div>
            @endforeach

          </div>
       </div>
    </div>
 </section>
 <!-- End Services Section -->
 <!-- ======= About Section ======= -->
 <section id="about" class="about">
    <div class="container">
       <div class="row">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
             <img src="{{ asset('Frontend/assets/img/Image1.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
             <h3> আমাদের <span> সম্পর্কে </span></h3>
             <p>
                মামাজ কোম্পানির প্রধান লক্ষ্য হচ্ছে, আপনাকে প্রতিষ্টিত করা এবং বাংলাদেশের সকল ধর্মের বেকার মানুষদের পাশে দারানো। মামাজের পূর্ণরূপ হচ্ছে, মানুষ মানুষের জন্য। আমাদের উদ্দেশ্য আপনাকে সাফল্য দিকে নিয়ে যাওয়া। তাছাড়াও মামাজ প্রতিষ্ঠানটির আরো অনেক চমৎকার সুযোগ রয়েছে, যেখান থেকে আপনি নিজের স্বপ্নকে বাস্তবায়ন করতে পারবেন।
             </p>
             <div class="row">
                <div class="col-md-4">
                   <h4>50K</h4>
                   <p>ক্লাইন্ট</p>
                </div>
                <div class="col-md-4">
                   <h4>20K</h4>
                   <p>রিভিউস</p>
                </div>
                <div class="col-md-4">
                   <h4>20K</h4>
                   <p>স্যাটিসফাইড</p>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- End About Section -->
 <!-- ======= Team Section ======= -->
 <section id="team" class="achivement">
    <div class="container">
       <div class="section-title">
          <h3>আমাদের <span>অর্জিত সাফল্য</span></h3>
          <p>বিগত কয়েক বছরের আমাদেরি অর্জিত সফল্যর কিছু সংখ্যাক ছবি নিচে দেওয়া হল। শুধু মাত্র আপনাদের অনুপ্রেরণার জন্য:</p>
       </div>
       <div class="row">
       </div>
    </div>
 </section>
 <!-- End Team Section -->
 <section class="tab-design">
    <div class="container">
       <div class="row">
          <div class="col-md-12 col-lg -12">
             <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Client')" id="defaultOpen"><i class="fas fa-long-arrow-alt-right"></i>আমাদের ক্লাইন্ট</button>
                <button class="tablinks" onclick="openCity(event, 'Certification')" ><i class="fas fa-long-arrow-alt-right"></i>আমাদের অর্জন</button>
                <button class="tablinks" onclick="openCity(event, 'Land')" id="defaultOpen"><i class="fas fa-long-arrow-alt-right"></i>আমাদের ল্যান্ড</button>
                <button class="tablinks" onclick="openCity(event, 'Building')" id="defaultOpen"><i class="fas fa-long-arrow-alt-right"></i>আমাদের বিল্ডিং</button>
                <!-- <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
                   <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
             </div>
             <div id="Client" class="tabcontent">
                <div class="row">
                   <div class="col-md-4 col-lg-4">
                      <img src="{{ asset('Frontend/assets/img/group.png') }} ">
                   </div>
                   <div class="col-md-4 col-lg-4">
                      <img src="{{ asset('Frontend/assets/img/group.png') }} ">
                   </div>
                   <div class="col-md-4 col-lg-4">
                      <img src="{{ asset('Frontend/assets/img/group.png') }} ">
                   </div>
                </div>
             </div>
             <div id="Certification" class="tabcontent">
                <h3>আমাদের ক্লাইন্ট</h3>
                <p>Paris is the capital of France.</p>
             </div>
             <div id="Land" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
             </div>
             <div id="Building" class="tabcontent">
                <h3>Content Will Be Here</h3>
                <p>Tokyo is the capital of Japan.</p>
             </div>
          </div>
       </div>
    </div>
 </section>
 @endsection