

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Kopa Fasta">
    <meta name="generator" content="Hugo 0.104.2">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="@yield('favicon')">

    <link rel="stylesheet" href="{{asset('modules/kycmodule/css/app.css')}}">
      <link rel="stylesheet" href="{{asset('modules/kycmodule/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('modules/kycmodule/css/form.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body class="d-flex flex-column">

    <div class="overlay">
       <div class="loader">
          <center><img src="{{asset('modules/kycmodule/img/loader.gif')}}" alt=""></center>
       </div>
    </div>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top top-bar">
    <div class="container-fluid text-center justify-content-center d-flex flex-column">
         <img src="{{asset('modules/kycmodule/img/logo-h.png')}}" height="40px" alt="">
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0 background-field">
  @yield('content')
</main>

  </body>
  <script type="text/javascript" src="{{ asset('modules/kycmodule/js/jQuery.js'); }}"></script>
  <script type="text/javascript" src="{{ asset('modules/kycmodule/js/app.js'); }}"></script>
  <script type="text/javascript" src="{{ asset('modules/kycmodule/js/form.js'); }}"></script>
  <script type="text/javascript" src="{{ asset('modules/kycmodule/js/ajax.js'); }}"></script>

</html>
