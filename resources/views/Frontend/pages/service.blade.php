@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','আমাদের সার্ভিসেস')
  @section('body')

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4>আমাদের সার্ভিসেস</h4>
          <p>আপনি কি আমাদের সার্ভিসেস জানতে চাচ্ছেন</p>
        </div>
      </div>
    </div>
  </section>

 <!-- ======= Services Section ======= -->
 <section id="services" class="services section-bg">
    <div class="container">
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
 @endsection