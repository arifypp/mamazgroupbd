@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','ট্রান্সিকশন লিস্ট')
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
                     <h5>ট্রান্সিকশন লিস্ট</h5>
                  </div>
               </div>
            </div>
         </div>
         @include('Frontend/user/bookingleft')
         <div class="col-md-9"style="background-color: #F8FAFD; padding-top: 0px;">
            <div class="mb-6">
               <div class="card" >
                  <h5 style="padding:10px 20px;">ট্রান্সিকশন তালিকা</h5>
                  <table class="table table-striped" >
                     <thead>
                        <tr>
                           <th scope="col">ব্যবহারকারীর নাম</th>
                           <th scope="col">ট্রান্সিকশন আইডি </th>
                           <th scope="col">ওয়ালেট নাম </th>
                           <th scope="col">টাকা</th>
                           <th scope="col"> বর্তমান টাকা </th>
                           <th scope="col"> তারিখ </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach( App\Models\Transaction::where('user_id', Auth::user()->id)->get() as $value )
                           <tr>
                              <td>{{ $value->user->name }}</td>
                              <td>{{ $value->txn_id }}</td>
                              <td> {{ $value->wallettype->name }} </td>
                              <td>৳{{ number_format( $value->amount , 0 , '.' , ',' ) }} BDT</td>
                              <td>{{ __('-') }}</td>
                              <td>{{ date('d M, Y h:i:s a', strtotime($value->created_at)) }}</td>
                           </tr>
                        @endforeach
                        @php 
                           $wallet = DB::table('wallets')->where('user_id', auth()->user()->id)->get(); 
                        @endphp

                        @foreach( $wallet as $ledger )
                           @php 
                              $walletledger = DB::table('wallet_ledgers')->where('wallet_id', $ledger->id)->get();
                           @endphp

                           @foreach( $walletledger as $ledgerdata )
                           <tr>
                              <td> {{ __(Auth::user()->name) }}</td>
                              <td> - </td>
                              <td> 
                                 @php 
                                 $walletype = DB::table('wallet_types')->where('id', $ledgerdata->wallet_id)->get();
                                 @endphp

                                 @foreach( $walletype as $walletname ) 
                                 {{ $walletname->name }}
                                 @endforeach

                              </td>
                              <td>৳{{ number_format( $ledgerdata->amount , 0 , '.' , ',' ) }} BDT</td>
                              <td>৳{{ number_format( $ledgerdata->running_raw_balance , 0 , '.' , ',' ) }} BDT</td>
                              <td>{{ date('d M, Y h:i:s a', strtotime($ledgerdata->created_at)) }}</td>
                           </tr>
                           @endforeach

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