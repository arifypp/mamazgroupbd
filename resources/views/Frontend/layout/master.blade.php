<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>@yield('title') | মামাজ গ্রুপ ইন্ডাট্রিজ</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
      @include('Frontend.includes.css')
   </head>
   <body>
      <!-- Pre Loader ============================================ -->
      <div class="loader" id="loader">
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
     </div>
      @include('Frontend.includes.header')
      {{-- @include('Frontend.includes.hero') --}}
      <!-- End Hero -->
      <main id="main">
         @yield('body')
      </main>
      <!-- End #main -->
      <!-- ======= Footer ======= -->
      @include('Frontend.includes.footer')
      <!-- End Footer -->
      @include('Frontend.includes.scripts')
   </body>
</html>