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
          <link rel="stylesheet" href="{{ asset('public/Css/jquery-ui.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/alertify.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/bootstrap.min.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/sticky-footer.css') }}" media="screen">
          <link rel="stylesheet" href="{{ asset('public/Css/main.css') }}" media="screen">
      @show

      @section('script')
          <script src="{{ asset('public/Js/jquery.js') }}"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.12/jquery.datetimepicker.full.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
          <script src="{{ asset('public/Js/main.js') }}"></script>
          <script src="{{ asset('public/Js/alertify.js') }}"></script>
      @show

      <title>Copa claro  {{date('Y')}}}</title>
  </head>

  <body>
      @include('includes.menu')
      </br></br>
      <div class="container">
          <!-- Contenedor información módulo -->
          <div class="page-header" id="banner">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>Festival Escuelas Deportivas <span class="text-default">{{ date('Y') }}</span></h1>
                <p class="lead"><h4>Formulario de inscripción</h4></p>
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
  </body>

</html>
