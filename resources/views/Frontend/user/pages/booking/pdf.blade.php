
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            @foreach( $site_settings as $value )
                <img src="{{ public_path ('/assets/images/settings/' .$value->websitelogodark) }}" alt="Mamaz" class="img-fluid" width="200">
            @endforeach
            <h2 class="m-0 p-0" style="padding:0; margin:0; margin-top:5px;">ফ্ল্যাট বুকিং</h2>
            <h4 class="m-0 p-0" style="padding:0; margin:0;">আকশির প্রপার্টি ডেভেলোপমেন্ট</h4>
            <p class="m-0 p-0" style="padding:0; margin:0;"> রেজিঃ নং-সি ১১১৩০২/২০১৮ </p>
        </div>
    </div>
    <hr>
    <div class="row d-flex">
        <div class="col-md-12 booking">
          <p> 
              <span class="text-left">বুকিং রেজিস্ট্রেশন নং: <u>{{ $bookings->bookingid }}</u></span> 
              <span class="text-right float-right" style="float:right">বুকিং রেজিস্ট্রেশন নং: <u>{{ $bookings->bookingid }}</u></span>
        </p> 
        </div>
        <div class="col-md-6">
           পার্ট -২
        </div>
    </div>
</div>
