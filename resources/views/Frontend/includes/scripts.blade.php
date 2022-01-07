<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('Frontend/assets/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/vendor/php-email-form/validate.js') }}"></script>
<!-- toastr plugin -->
<script src="{{ asset('/assets/libs/toastr/toastr.min.js') }}"></script>

<!-- toastr init -->
<script src="{{ asset('/assets/js/pages/toastr.init.js') }}"></script>
<script>
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
  tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
  tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery(window).on('load',function(){
      jQuery('.loader').fadeOut(500);
    });
  });
  
  $(window).on('load', function(){
    setTimeout(function() {
      $('#staticBackdrop').modal('show')
    });
  });
  toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
	
	@if (Session::has('message') )
            var type="{{ Session::get('alert-type', 'info') }}";
                switch (type)
                {
                    case'info':
                        toastr.info("{{ Session::get('message') }}");
                    break;
                    case'success':
                        toastr.success("{{ Session::get('message') }}");
                    break;
                    case'warning':
                        toastr.warning("{{ Session::get('message') }}");
                    break;
                    case'error':
                        toastr.error("{{ Session::get('message') }}");
                    break;
                }
    @endif
</script>
<!-- Template Main JS File -->
<script src="{{ asset('Frontend/assets/js/main.js') }}"></script>

@yield('script')