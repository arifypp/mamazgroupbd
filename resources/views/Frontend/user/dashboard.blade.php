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
                      <h3 class="mb-0"><i class="fas fa-hand-holding-usd"></i><br>142৳</h3> <b>Mamaz Money</b>
                  </div>
                  
              </div>
                  
                </div>
                 <div class="col-md-3">
                  <div class="d-flex justify-content-center mt-7 px-7">
                  
                  <div class="stat">
                      <h3 class="mb-0"><i class="fas fa-users"></i><br>142</h3> <b>Reference Users</b>
                  </div>
                  
              </div>
                  
                </div>
                 <div class="col-md-3">
                  <div class="d-flex justify-content-center mt-7 px-7">
                  
                  <div class="stat">
                      <h3 class="mb-0"><i class="far fa-bookmark"></i><br>142</h3> <b>Booking Area</b>
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