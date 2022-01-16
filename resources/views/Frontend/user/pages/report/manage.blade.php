@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','রিপোর্ট লিস্ট')
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
                     <h5>রিপোর্ট লিস্ট</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-10 "style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">রিপোর্ট তালিকা</h5>
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
                        <tr>
                           <th scope="row">fdgfgv</th>
                           <td>SFT</td>
                           <td>sfdfg</td>
                           <td> test </td>
                        </tr>
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