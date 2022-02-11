@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','ড্যাশবোর্ড')
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
                     <h5>ড্যাশবোর্ড</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-10 "style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="uppderdesign">
               <div class="row">
                  <div class="col-md-3 offset-md-1">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           @php 
                           $user = auth()->user()->id; 
                           $wallet = \DB::table('wallets')->whereIn('user_id', auth()->user())->get();
                           @endphp
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/1.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>অ্যাসেট টাকা</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 cash-taka" data-toggle="modal" data-target="#Cashtaka">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/2.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 9)->get();
                              @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>ক্যাশ টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="Cashtaka" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">ক্যাশ টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <center>
                                 <h1>@if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif <sup class="text-success" style="font-size:10px;">Available Balance</sup></h1>
                              </center>
                              <form action="{{ route('addmoney.transfer') }}" method="post">
                                 @csrf
                                 <input type="hidden" name="amount" value="@if(!empty($wallet['0']) ){{$wallet['0']->raw_balance}}@else{{'0'}}@endif">
                                 <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                 <div class="form-group">
                                    <label for="Send To">Send To</label>
                                    <select name="sendto" id="sendto" class="form-control">
                                       <option value="0">Please Select Box </option>
                                       @php $wtype = CoreProc\WalletPlus\Models\WalletType::find([7, 11, 14]); @endphp
                                       
                                       @foreach( $wtype  as $key => $wallettypename )
                                       <option value="{{ $wallettypename->name }}">{{ $wallettypename->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="text-danger">@error('sendto'){{ $message }} @enderror</span>

                                 </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Transfer Now</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7 myagenttaka">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/3.png') }}" alt="" class="mb-2" width="50"></span><br>
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 11)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           
                           </h3>
                           <b>এজেন্ট টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="AgentTaka" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">এজেন্ট টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <center>
                                 <h1>@if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif <sup class="text-success" style="font-size:10px;">Available Balance</sup></h1>
                              </center>
                              <form action="{{ route('addmoney.transfer') }}" method="post">
                                 @csrf
                                 <input type="hidden" name="amount" value="@if(!empty($wallet['0']) ){{$wallet['0']->raw_balance}}@else{{'0'}}@endif">
                                 <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}">
                                 <div class="form-group">
                                    <label for="Send To">Send To</label>
                                    <select name="sendto" id="sendto" class="form-control">
                                       <option value="0">Please Select Box </option>
                                       @php $wtype = CoreProc\WalletPlus\Models\WalletType::find([7, 11, 14]); @endphp
                                       
                                       @foreach( $wtype  as $key => $wallettypename )
                                       <option value="{{ $wallettypename->name }}">{{ $wallettypename->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="text-danger">@error('sendto'){{ $message }} @enderror</span>

                                 </div>
                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Transfer Now</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-3 offset-md-1">
                     <div class="d-flex justify-content-center mt-7 px-7 charitymoney">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/4.png') }}" alt="" class="mb-2" width="50"></span><br>
                              @php 
                                 $user = auth()->user()->id; 
                                 $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 12)->get();
                              @endphp
                                 @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>চ্যারিটি দান টাকা</b>
                        </div>
                     </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal" id="charitymoney" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="staticBackdropLabel">চ্যারিটি দান টাকা</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                           আল্লাহ তাআলা বলেন, 'যদি তোমরা দান প্রকাশ্যে করো, তবে তা উত্তম; আর যদি তা গোপনে করো এবং অভাবীদের দাও, তবে তা তোমাদের জন্য শ্রেয়। ... এতে দানের ফজিলত বিনষ্ট হয়। আল্লাহ তাআলা বলেন, 'সদ্ব্যবহার, সুন্দর কথা ওই দান অপেক্ষা উত্তম, যার পেছনে আসে যন্ত্রণা। আল্লাহ তাআলা ঐশ্বর্যশালী ও পরম সহিষ্ণু।

                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/5.png') }}" alt="" class="mb-2" width="50"></span><br>
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 13)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>ভ্যাট / ট্যাক্স</b>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="d-flex justify-content-center mt-7 px-7">
                        <div class="stat">
                           <h3 class="mb-0"><span><img src="{{ asset('assets/images/dashboard-icon/6.png') }}" alt="" class="mb-2" width="50"></span><br>
                           @php 
                              $user = auth()->user()->id; 
                              $wallet = \DB::table('wallets')->where('user_id', $user)->where('wallet_type_id', 14)->get();
                           @endphp
                              @if( !empty($wallet['0']) ) {{ $wallet['0']->raw_balance }}৳ @else  {{ "0৳" }} @endif
                           </h3>
                           <b>মামাজ পয়সা</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">Report History</h5>
                  <table class="table table-striped" >
                     <thead>
                        <tr>
                           <th scope="col">Sl</th>
                           <th scope="col">Report Name</th>
                           <th scope="col">Report Date</th>
                           <th scope="col">Report Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">1</th>
                           <td>Mark</td>
                           <td>Otto</td>
                           <td>@mdo</td>
                        </tr>
                        <tr>
                           <th scope="row">2</th>
                           <td>Jacob</td>
                           <td>Thornton</td>
                           <td>@fat</td>
                        </tr>
                        <tr>
                           <th scope="row">3</th>
                           <td>Larry</td>
                           <td>the Bird</td>
                           <td>@twitter</td>
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

@section('script')
<script>
   // A $( document ).ready() block.
   $( document ).ready(function() {
      // Cash taka 
      $(".cash-taka").click(function(){
         $("#Cashtaka").scrollTop(0);
         $('#Cashtaka').modal('show');
      });
      // Agent Taka 
      $(".myagenttaka").click(function(){
         $("#AgentTaka").scrollTop(0);
         $('#AgentTaka').modal('show');
      });
      // Charity money 
      
      $(".charitymoney").click(function(){
         $("#charitymoney").scrollTop(0);
         $('#charitymoney').modal('show');
      });
      $("button[data-dismiss=modal]").click(function(){
        $(".modal").modal('hide');
      });
   });
</script>
@endsection