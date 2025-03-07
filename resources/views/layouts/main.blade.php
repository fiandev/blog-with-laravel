<!doctype html>
<html lang="en">
  <head>
    @include("partials.seo")
    @yield("head")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/style.css" title="main-css" />
    <link rel="stylesheet" href="/css/event.css" title="event-css" />
    @yield("css")
  </head>
  <body class="px-2">
    <div class="preload">
      <div class="loader"></div>
    </div>
    @include("partials/navbar")
    <div id="container" class="container mb-3">
     @yield("container")
    </div>
    @include("partials/footer")
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('/js/main.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){      
       $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
       $('.disclaimer').remove();
      }); 
    </script>
     @yield("script")
  </body>
</html>