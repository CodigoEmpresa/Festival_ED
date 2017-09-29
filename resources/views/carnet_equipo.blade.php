<!DOCTYPE html>
<html>
<head>
<style type="text/css">
@import 'https://fonts.googleapis.com/css?family=Open+Sans';
@page{margin:0em;}
body{margin:0px;font-family: 'Open Sans', sans-serif;text-transform: uppercase;}
.fondo{
position: absolute;
height: 100%;
width: 100%;
}
.nombre {
    position: absolute;
    top: 391px;
    text-align: center;
    width: 100%;
}
.cedula {
    position: absolute;
    top: 410px;
    text-align: center;
    width: 100%;
}
.codigo {
    position: absolute;
    top: 439px;
    text-align: center;
    width: 100%;
}
.deporte {
    position: absolute;
    top: 443px;
    text-align: center;
    width: 100%;
}
.categoria {
    position: absolute;
    top: 459px;
    text-align: center;
    width: 100%;
}
.barrio {
    position: absolute;
    top: 475px;
    text-align: center;
    width: 100%;
}
.rh {
    position: absolute;
    top: 490px;
    text-align: center;
    width: 100%;
}
.edad {
    position: absolute;
    top: 505px;
    text-align: center;
    width: 100%;
}
.page-break {
    page-break-after: always;
}
.foto {
    position: absolute;
    left: 33%;
    width: 127px;
    height: 184px;
    top: 171px;
}
.logo_alcaldia {
    position: absolute;
    left: 25%;
    width: 200px;
}
.franja_azul {
    height: 18px;
    width: 100%;
    background: #1995dc;
    position: absolute;
    top: 89px;
    color:white;
}
.franja_abajo {
    height: 28px;
    width: 100%;
    background: #1995dc;
    position: absolute;
    bottom: 0px;
    color:white;
}
.datos_equipo {
    color: #3e3e50;
    font-size: 13px;
}
</style>
<?php 
 function calcular($fecha_nacimiento)
    {
        $date2 = date('Y-m-d');//
        $diff = abs(strtotime($date2) - strtotime($fecha_nacimiento));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $years;
    }
    ?>
</head>
    <body>
        @foreach ($personas as $persona)
             <img class="logo_alcaldia" src="http://www.culturarecreacionydeporte.gov.co/sites/default/files/logo-bogota-mejor-para-todos-scrd.png">
             <div class="franja_abajo">valido solo para Copa Claro Bogotá {{date('Y')}}</div>
             <div class="franja_azul"></div>
             <img class="foto" src="../public/Uploads/{{$persona->pivot['fotografia']}}">
             <div class="nombre">{{$persona['Primer_Nombre'].' '.$persona['Segundo_Nombre'].' '.$persona['Primer_Apellido'].$persona['Segundo_Apellido']}}</div>
             <div class="cedula">{{$persona['Cedula']}} </div>
             <div class="datos_equipo"> 
                <div class="deporte">{{$equipo->categoria_deporte->deporte['nombre'].' Equipo: '.$equipo['nombre_equipo']}} </div>
                <div class="categoria">{{$equipo->categoria_deporte->categoria['nombre']}}</div>
                <div class="barrio">Barrio: {{$equipo['id_barrio']}}</div>
                <div class="rh">Rh: {{$persona->pivot['rh']}}</div>
                <div class="edad">Edad: <?php $a =  calcular($persona['Fecha_Nacimiento']); echo $a; ?></div>
                <div class="page-break"></div>
             </div>
        @endforeach
    </body>

</html>