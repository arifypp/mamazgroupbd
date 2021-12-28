@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','আমাদের সম্পর্কে')
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
            <h5>Dashboard</h5>
            
          </div>
        </div>
        </div>
      </div>
      
          
      
            <div class="row gutters-sm">
              <div class="col-md-2 mb-3">
            
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap active">
                      <a href="dashboard.html"><h6><i class="fas fa-tachometer-alt"></i>Dashboard</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <a href="report.html"><h6><i class="fas fa-sticky-note"></i>Report</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                      <a href="profile.html"><h6><i class="fas fa-user-cog"></i>Profile Setting</h6></a>
                     
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <h6><i class="fas fa-power-off"></i>Logout</h6>
                    </a>    
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>                     
                    </li>
                   
                   
                    
                  </ul>
                </div>
              </div>
  
  
               <div class="col-md-10 "style="background-color: #F8FAFD; padding-top: 0px;">
                 <div class="uppderdesign">
                <div class="row">
             
                <div class="col-md-3 offset-md-1">
                 <div class="d-flex justify-content-center mt-7 px-7">
                  
                  <div class="stat">
                      <h3 class="mb-0"><i class="fas fa-american-sign-language-interpreting"></i><br>142</h3> <b>Land Purchase</b>
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