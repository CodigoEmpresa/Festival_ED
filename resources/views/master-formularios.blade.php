<!DOCTYPE html>

<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      @section('style')
          <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="{{ asset('public/Css/bootstrap.min.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/sticky-footer.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/main.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/list.css') }}" media="screen">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/alertify.css') }}" media="screen">
      @show
  <title>Festival escuelas deportivas IDRD {{date('Y')}}</title>
  </head>
  <body>
      @include('includes.menu')
      </br></br>
      <div class="form-container container">
          <!-- Contenedor información módulo -->
          <div class="page-header" id="banner">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>Festival escuelas deportivas IDRD <span class="text-default">{{ date('Y') }}</span></h1>
                <p class="lead"><h4>IDRD</h4></p>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6">
                 <div align="right">
                    <img src="{{ asset('public/Img/IDRD.png') }}" width="250px"/>
                 </div>
              </div>
            </div>
          </div>
          <!-- FIN Contenedor información módulo -->
          <!-- Contenedor panel principal -->
          @yield('content')
          <!-- FIN Contenedor panel principal -->
      </div>
      @section('script')
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
          <script src="{{ asset('public/Js/bootstrap.min.js') }}"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
          <script src="{{ asset('public/Js/main.js') }}"></script>
          <script src="{{ asset('public/Js/list.js') }}"></script>
          <script src="{{ asset('public/Js/alertify.js') }}"></script>

      @show
  </body>
</html>
