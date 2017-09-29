<!DOCTYPE html>
<html>
<head>

<style type="text/css">
@import 'https://fonts.googleapis.com/css?family=Open+Sans';
@page{margin:0em;}
body{margin:0px;font-family: 'Open Sans', sans-serif;}
.fondo{
position: absolute;
height: 100%;
width: 100%;
}
.nombre {
    position: absolute;
    top: 271px;
    text-align: center;
    width: 100%;
}
.cedula {
    position: absolute;
    top: 350px;
    text-align: center;
    width: 100%;
}
.codigo {
    position: absolute;
    top: 409px;
    text-align: center;
    width: 100%;
}
.deporte {
    position: absolute;
    top: 429px;
    text-align: center;
    width: 100%;
}
.barrio {
    position: absolute;
    top: 510px;
    text-align: center;
    width: 100%;
}
.rh {
    position: absolute;
    top: 590px;
    left: -250px;
    text-align: center;
    width: 100%;
}
.edad {
    position: absolute;
    top: 590px;
    left: 250px;
    text-align: center;
    width: 100%;
}

</style>
</head>
    <body>
         <img class="fondo" src="http://www.idrd.gov.co/SIM/images/carnet_torneos.jpg">
         <div class="nombre">{{$nombres.' '.$apellidos}}</div>
         <div class="cedula">{{$cedula}} </div>
         <div class="deporte">{{$deporte}} </div>
         <div class="barrio">{{$barrio}}</div>
         <div class="rh">{{$rh}}</div>
         <div class="edad">{{$edad}}</div>
    </body>
</html>

