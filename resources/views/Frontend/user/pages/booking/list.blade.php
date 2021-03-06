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
               <div class="col-md-3">
               </div>
               <div class="col-md-9">
                  <div class="topbar1">
                     <h5>বুকিং লিস্ট</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">বুকিং তালিকা</h5>
                  <table class="table table-striped" >
                     <thead>
                        <tr>
                           <th scope="col">বুকিং নাম্বার</th>
                           <th scope="col">বুকিং জমি</th>
                           <th scope="col">বুকিং টাকা</th>
                           <th scope="col">ডিউ বুকিং টাকা</th>
                           <th scope="col">পেইড বুকিং টাকা</th>
                           <th scope="col">টোটাল টাকা</th>
                           <th scope="col">বুকিং স্টাটার্স</th>
                        </tr>
                     </thead>
                     <tbody>
                         @foreach( $bookings as $booking )
                        <tr>
                           <th scope="row">{{ $booking->bookingid }}</th>
                           <td>{{ $booking->landvalue }} SFT</td>
                           <td>{{ number_format($booking->bookingcash, 2, '.')}}৳</td>
                           <td>{{ number_format($booking->dueamount, 2, '.')}}৳</td>
                           <td>{{ number_format($booking->bookingcash - $booking->dueamount, 2, '.')}}৳</td>
                           <td>{{ number_format($booking->fullamount, 2, '.')}}৳</td>
                           <td>
                               @if($booking->status == 2)
                                <span class="text-danger">বাতিল</span>
                               @elseif ($booking->status == 1)
                                <span class="text-success">অ্যাপ্রুভ</span>
                               @else 
                               <span class="text-danger">পেনডিন</span>
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