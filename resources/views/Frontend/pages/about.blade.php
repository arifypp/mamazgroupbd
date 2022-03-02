@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','আমাদের সম্পর্কে')
  @section('body')

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        @foreach( App\Models\Frontend\About::all() as $value )
          <h4>{{ $value->title }}</h4>
          <p>{{ $value->desc }}</p>
        @endforeach
        </div>
      </div>
    </div>
  </section>
@foreach( App\Models\Frontend\AboutContent::all() as $value )
@if( $value->layout == 1 )
  <!-- ======= Hero Section ======= -->
  <section class="about" class="d-flex align-items-center">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center offset-lg-1">
          <h1>{{ $value->title }}</h1>
          <p>{!! $value->desc !!}</p>
        </div>
        <div class="col-lg-4 order-2 order-lg-2 hero-img">
          <img src="{{ asset('assets/images/aboutpage/'. $value->image) }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->
@elseif($value->layout == 2)
<!-- About us section two -->
<section class="aboutone" class="d-flex align-items-center">
    <div class="container">
      <div class="row gy-4">
       <div class="col-lg-4 order-2 order-lg-1 hero-img offset-lg-1">
        <img src="{{ asset('assets/images/aboutpage/'. $value->image) }}" class="img-fluid animated" alt="">
        </div>
         <div class="col-lg-6 order-1 order-lg-2 d-flex flex-column justify-content-center">
         <h1>{{ $value->title }}</h1>
          <p>{!! $value->desc !!}</p>
        </div>
      </div>
    </div>
  </section>
@endif
@endforeach


@endsection