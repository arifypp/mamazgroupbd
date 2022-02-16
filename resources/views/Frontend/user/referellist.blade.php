@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','ইনভাইট পাঠান')
@section('body')
{{-- Profile section  --}}
<section class="profile-section">
   <div class="container">
      <div class="row">
          @php
            $reflist = App\Models\User::where('referrer_id', Auth::user()->id)->get();
          @endphp
          @foreach( $reflist as $user )
          <div class="col-md-4 my-5 py-5">
              <div class="card">
                  <div class="card-body py-2 text-center">
                      <div class="refereluserdetails">
                        <img src="{{ asset($user->avatar) }}" class="img-fluid mb-3 border rounded-circle p-3" widht="50" alt="{{$user->name }}" style="width:100px;">
                      <h3> {{$user->name }} </h3>
                      @php 
                            $countReferenceid = App\Models\User::where('referrer_id', $user->id)->count();
                            @endphp
                            @if( $countReferenceid <= 7 )
                            <small>Customer</small><br>
                            @elseif( $countReferenceid <= 14 )
                            <small>Marketing Cordinator</small><br>
                            @elseif( $countReferenceid <= 21 )
                            <small>Marketing Contractor Cordinator</small><br>
                            @endif
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
   </div>
</section>
@endsection