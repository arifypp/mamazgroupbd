@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','আমাদের সম্পর্কে')
  @section('body')

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4>আমাদের সম্পর্কে</h4>
          <p>আপনি কি আমাদের সম্পর্কে জানতে চাচ্ছেন</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Hero Section ======= -->
  <section class="about" class="d-flex align-items-center">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center offset-lg-1">
          <h1>আমাদের সম্পর্কে জানুন</h1>
          <p>বড়দিনের আগে বিশ্বে ৩ হাজার ৮০০–এর বেশি ফ্লাইট বাতিল করা হয়েছে। এর মধ্যে যুক্তরাষ্ট্রেই বাতিল হয়েছে এক হাজারের বেশি ফ্লাইট। ফ্লাইট অ্যাওয়ার ওয়েবসাইটের বরাত দিয়ে ‘নিউইয়র্ক টাইমস’–এর খবরে এ তথ্য জানা যায়। বড়দিনের আগে বিশ্বে ৩ হাজার ৮০০–এর বেশি ফ্লাইট বাতিল করা হয়েছে। এর মধ্যে যুক্তরাষ্ট্রেই বাতিল হয়েছে এক হাজারের বেশি ফ্লাইট। ফ্লাইট অ্যাওয়ার ওয়েবসাইটের বরাত দিয়ে ‘নিউইয়র্ক টাইমস’–এর খবরে এ তথ্য জানা যায়।  </p>
        </div>
        <div class="col-lg-4 order-2 order-lg-2 hero-img">
          <img src="{{ asset('Frontend/assets/img/about.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

<!-- About us section two -->
 <section class="aboutone" class="d-flex align-items-center">
    <div class="container">
      <div class="row gy-4">
       <div class="col-lg-4 order-2 order-lg-1 hero-img offset-lg-1">
          <img src="{{ asset('Frontend/assets/img/aboutus.png') }}" class="img-fluid animated" alt="">
        </div>
         <div class="col-lg-6 order-1 order-lg-2 d-flex flex-column justify-content-center">
          <h1>আমাদের মিশন</h1>
          <p>ডেলটা এয়ার লাইনসের মুখপাত্র কেট মোডোলো জানান, স্থানীয় সময় গতকাল ৩ হাজার ১০০ ফ্লাইটের মধ্যে ১৫৮টি বাতিল করা হয়। এক সপ্তাহে আবহাওয়া, অমিক্রনের সংক্রমণের কারণে দেড় শতাধিক ফ্লাইট বাতিল করা হয়েছে। আলাস্কা এয়ারলাইনস স্থানীয় সময় গত বৃহস্পতিবার ১৭টি ফ্লাইট বাতিল করেছে।ডেলটা এয়ার লাইনসের মুখপাত্র কেট মোডোলো জানান, স্থানীয় সময় গতকাল ৩ হাজার ১০০ ফ্লাইটের মধ্যে ১৫৮টি বাতিল করা হয়। এক সপ্তাহে আবহাওয়া, অমিক্রনের সংক্রমণের কারণে দেড় শতাধিক ফ্লাইট বাতিল করা হয়েছে। আলাস্কা এয়ারলাইনস স্থানীয় সময় গত বৃহস্পতিবার ১৭টি ফ্লাইট বাতিল করেছে।</p>
        </div>
      </div>
    </div>
  </section>


    <!-- ======= About us section three ======= -->
  <section class="aboutthree" class="d-flex align-items-center">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center offset-lg-1">
          <h1>আমাদের ভিশন</h1>
          <p>মিশিগান বিশ্ববিদ্যালয়ের ইন্টারনাল মেডিসিনের সহযোগী অধ্যাপক হ্যালি প্রেসকট ‘নিউইয়র্ক টাইমস’কে জানান, যখন কয়েক লাখ মানুষ অমিক্রনে একই সময়ে আক্রান্ত হচ্ছেন এবং বড় একটা অংশকে হাসপাতালে যেতে হচ্ছে, তখন হাসপাতালের ধারণক্ষমতা পার হয়ে যেতে খুব বেশি সময় লাগে না।</p>
        </div>
        <div class="col-lg-4 order-2 order-lg-2 hero-img">
          <img src="{{ asset('Frontend/assets/img/vision.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

 @endsection