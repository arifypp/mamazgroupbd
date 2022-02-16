@extends ('Frontend.layout.master')
{{-- title --}}
@section('title','যোগাযোগ')
  @section('body')

  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4>যোগাযোগ করুন</h4>
          <p>আপনি কি আমাদের সম্পর্কে জানতে চাচ্ছেন</p>
        </div>
      </div>
    </div>
  </section>
<!-- ======= Contact Us Section ======= -->
<section id="contact" class="contact">
    <div class="container">

<h4>আমাদেরকে মেসেজ করুন</h4>
      <div class="row">
     
        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="{{ route('contact.send') }}" method="post" id="submitform">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">               
                <input type="text" name="name" class="form-control" id="name" placeholder="আপনার নাম"  autocomplete="off">
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">               
                <input type="email" class="form-control" name="email" id="email" placeholder="আপনার ইমেইল"  autocomplete="off">
              </div>
            </div>
            <div class="form-group mt-3">              
              <input type="text" class="form-control" name="subject" id="subject" placeholder="আপনার বিষয়"  autocomplete="off">
            </div>
            <div class="form-group mt-3">
              <textarea name="message" class="form-control" cols="30" rows="10" ></textarea>
            </div>
            <div class="my-3">
            
              <!-- <div class="error-message"></div> -->
              <!-- <div class="sent-message">Your message has been sent. Thank you!</div> -->
            </div>
            <div class="text-center"><button type="submit" class="button-design submitcf">মেসেজ পাঠান <span class="spinner-border" style="display:none;"></span></button></div>
          </form>
        </div>
        <div class="col-lg-5 d-flex align-items-stretch">
          <div class="info">
            <h3>দ্রুত যোগাযোগ</h3>
            <span>আপনার যদি কোনো প্রয়োজনীয় তথ্য জানার থাকে তাহলে আমাদেরকে সরাসরি ফোন করতে পারেন।</span>
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>ঠিকানা:</h4>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>ই-মেইল:</h4>
              <p>info@example.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>ফোন:</h4>
              <p>+1 5589 55488 55s</p>
            </div>

            <div class="social-links mt-1">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
          </div>

           
          </div>

        </div>


      </div>

    </div>
  </section><!-- End Contact Us Section -->
  <section class="google-map">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <h5>আমাদের ম্যাপ</h5>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.4725585782985!2d90.25848986481708!3d23.837347734546608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755ebcb1b912fb3%3A0xb643e40d19ecae53!2sAnandapur%2C%20Savar%20Union!5e0!3m2!1sen!2sbd!4v1639163193120!5m2!1sen!2sbd" width="1500" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          
        </div>
        
      </div>
      
    </div>
    
  </section>

@endsection

@section('script')
<script>
  $(function(){
      $.ajaxSetup({
      headers: {
              "X-CSRFToken": '{{csrf_token()}}'
          }
      });
      $('#submitform').submit(function(e){
          e.preventDefault();
          var mydata = $(this).serialize();

          $(".spinner-border").show();
          $(".spinner-border").addClass("spinner-border-sm");
          // $(".submitcf").text("মেসেজ যাচ্ছে...");
          $.ajax({
              method : 'POST',
              url : "{{ route('contact.send') }}",
              data:mydata,
              success: function(response) {
                  if(response.success){
                      toastr.success(response.message);
                  }
                  $(".spinner-border").hide();
                  setTimeout(function(){
                      document.getElementById("submitform").reset();
                  }, 3000);
                  
          },
          error:function (response){
              $('.text-danger').html('');
              $('.text-danger').delay(5000).fadeOut();
              $.each(response.responseJSON.errors,function(field_name,error){
                  $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>');
              $(".spinner-border").hide();
              
              })
          }
          })
      })

  })
</script>
@endsection