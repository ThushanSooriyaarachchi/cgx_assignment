<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>voyage | Landing, Corporate &amp; Business Templatee</title>
     
    <!-- Stylesheets-->
    
    <link rel="stylesheet" href="{{ asset('build/assets/CSS/theme.css') }}">

  </head>


  <body>

    <!-- Nav bar -->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="index.html"><img class="d-inline-block" src="build/assets/imgs/logo.png" width="50" alt="logo" /><span class="fw-bold text-primary ms-2">CGX</span></a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <form class="d-flex ms-auto">
              <!-- <a class="btn text-800 order-1 order-lg-0 me-2" type="button">View Status</a> -->
              <a class="btn btn-voyage-outline order-0 mr-2" href="{{ route('login') }}">Sign in</a>
              <a class="btn btn-voyage-outline order-1" href="{{ route('register') }}">Sign Up</a>
            </form>
          </div>
        </div>
      </nav>

      
      <section class="mt-7 py-0">
        
      </section>
      @yield('content')
      
    </main>


    <script src="{{ asset('build/assets/js/theme.js') }}"></script>

    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&amp;display=swap') }}" rel="stylesheet">
  </body>

</html>