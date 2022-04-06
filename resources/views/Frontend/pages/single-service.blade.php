@extends ('Frontend.layout.master')
{{-- title --}}
@section('title', $value->name )
  @section('body')

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4>{{ $value->name }}</h4>
          <p>{{ $value->slug }}</p>
        </div>
      </div>
    </div>
  </section>
  
   <!-- ======= Services Section ======= -->
 <section id="services" class="services section-bg py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto offset-md-2 justify-content-center align-self-center text-center">
                <h4>{{ $value->name }}</h4>
                {!! $value->desc !!}

                <div class="contact-section">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-block btn-sm">যোগাযোগ করুন</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection