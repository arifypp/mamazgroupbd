@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','বুকিং লিস্ট')
@section('body')
{{-- Profile section  --}}
<section class="profile-section">
   <div class="container">
      <div class="main-body">
         <div class="mobiledevice">
            <div class="row">
               <div class="col-md-2">
               </div>
               <div class="col-md-10">
                  <div class="topbar1">
                     <h5>বুকিং লিস্ট</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-10 "style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">বুকিং তালিকা</h5>
                  <table class="table table-striped" >
                     <thead>
                        <tr>
                           <th scope="col">বুকিং নাম্বার</th>
                           <th scope="col">বুকিং জমির পরিমান</th>
                           <th scope="col">বুকিং টাকা</th>
                           <th scope="col">বুকিং স্টাটার্স</th>
                        </tr>
                     </thead>
                     <tbody>
                         @foreach( $bookings as $booking )
                        <tr>
                           <th scope="row">{{ $booking->bookingid }}</th>
                           <td>{{ $booking->flatvalue }} SFT</td>
                           <td>{{ number_format($booking->bookingmoney, 2, '.')}}৳</td>
                           <td>
                               @if($booking->status == 2)
                                <span class="text-danger">বাতিল হয়েছে</span>
                               @elseif ($booking->status == 1)
                                <span class="text-success">অ্যাপ্রুভ হয়েছে</span>
                               @else 
                               <span class="text-danger">পেনডিন হয়েছে</span>
                               @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
@endsection