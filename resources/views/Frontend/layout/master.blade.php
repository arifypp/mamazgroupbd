<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>@yield('title') | মামাজ গ্রুপ ইন্ডাট্রিজ</title>
      <!-- Favicons -->
      @foreach( $site_settings as $value )
      <link href="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}" rel="icon">
      <link rel="shortcut icon" href="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}">
      <link rel="apple-touch-icon image_src" href="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}">
      <meta name="description" content="{{ $value->metadesc }}"/>
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
      <meta property="og:type" content= "website" />
      <meta property="og:url" content="{{ $value->address }}"/>
      <meta property="og:site_name" content="{{ $value->title }}" />
      <meta property="og:image" itemprop="image primaryImageOfPage" content="{{ URL::asset ('/assets/images/settings/' .$value->websitefavicondark) }}" />
      <meta name="twitter:card" content="summary"/>
      <meta name="twitter:domain" content="{{ $value->address }}"/>
      <meta name="twitter:title" property="og:title" itemprop="name" content="{{ $value->metadesc }}" />
      <meta name="twitter:description" property="og:description" itemprop="description" content="{ $value->metadesc }}" />
      @endforeach
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

      @include('Frontend.includes.css')
   </head>
   <body>
      <!-- Pre Loader ============================================ -->
   
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