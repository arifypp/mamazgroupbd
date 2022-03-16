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
               <div class="col-md-3">
               </div>
               <div class="col-md-9">
                  <div class="topbar1">
                     <h5>রিপোর্ট লিস্ট</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">রিপোর্ট তালিকা</h5>
                  <table class="table table-striped" >
                     <thead>
                        <tr>
                           <th scope="col">রিপোর্ট তারিখ</th>
                           <th scope="col">নাম</th>
                           <th scope="col">মোবাইল নাম্বার</th>
                           <th scope="col">রিপোর্ট স্টাটার্স</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach( $report as $value )
                        <tr>
                           <th scope="row">{{ $value->date }}</th>
                           <td>{{ $value->name }}</td>
                           <td>{{ $value->phone }}</td>
                           <td>
                              @if( $value->status == 1)
                                 <span class="text-success">এপ্রুভ হয়েছে</span>
                              @else
                              <span class="text-danger">এপ্রুভ হয়নি</span>
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