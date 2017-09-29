  <scrip src="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"></scrip>
  <style link="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"></style>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.1/css/responsive.bootstrap.min.css">
  <script src=" https://cdn.datatables.net/responsive/2.0.1/js/dataTables.responsive.min.js"></script>
  <script src=" https://cdn.datatables.net/responsive/2.0.1/js/responsive.bootstrap.min.js"></script>
<style>
tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<html>
<head>
<title>
    Copa claro 2017
</title>
</head>
    <body>
       <table id="lista" name="lista_equipos" class="table table-striped table-bordered" cellspacing="0" width="100%">
       <thead>
        <tr>
         <th></th>
            <th>deporte_nombre</th>
            <th>nombre</th>
            <th>Escuela Deportiva</th>
            <th>Nombre_Localidad</th>
            <th>director</th>
            <th>direccion</th>
            <th>telefono_director</th>
            <th>Doc</th>
            <th>eps</th>
            <th>telefono</th>
            <th>rh</th>
            <th>Cedula</th>
            <th>Segundo_Apellido</th>
            <th>Primer_Apellido</th>
            <th>Primer_Nombre</th>
            <th>Segundo_Nombre</th>
            <th>Fecha_Nacimiento</th>
            <th>Nombre_Ciudad</th>
          </tr>
        </thead>
       <tfoot>
        <tr>
         <th></th>
            <th>deporte_nombre</th>
             <th>nombre</th>  
            <th>Escuela Deportiva</th>
            <th>Nombre_Localidad</th>
            <th>director</th>
            <th>direccion</th>
            <th>telefono_director</th>
            <th>Doc</th>  
            <th>eps</th>  
            <th>telefono</th>
            <th>rh</th>
            <th>Cedula</th>  
            <th>Segundo_Apellido</th>  
            <th>Primer_Apellido</th>  
            <th>Primer_Nombre</th>  
            <th>Segundo_Nombre</th>  
            <th>Fecha_Nacimiento</th>  
            <th>Nombre_Ciudad</th>  
          </tr>
        </tfoot>
        <tbody>
         
         
          @foreach ($participantes as $participante) 
          <tr>
          <td></td>
           <td>{{$participante->deporte_nombre}}</td>
           <td>{{$participante->nombre}}</td>
           <td>{{$participante->nombre_equipo}}</td>
           <td>{{$participante->Nombre_Localidad}}</td>
           <td>{{$participante->delegado}}</td>
           <td>{{$participante->direccion}}</td>
           <td>{{$participante->telefono_equipo}}</td>
           <td><a target="_blank" href="{{$participante->Name_exp_10}}">ver documento </a></td>
           <td><a target="_blank" href="{{$participante->Name_exp_11}}">ver eps </a></td>
           <td>{{$participante->telefono}}</td>
           <td>{{$participante->email}}</td>
           <td>{{$participante->Cedula}}</td>
           <td>{{$participante->Segundo_Apellido}}</td>
           <td>{{$participante->Primer_Apellido}}</td>
           <td>{{$participante->Primer_Nombre}}</td>
           <td>{{$participante->Segundo_Nombre}}</td>
           <td>{{$participante->Fecha_Nacimiento}}</td>
           <td>{{$participante->Nombre_Ciudad}}</td>
          </tr>
             
            @endforeach
          
         </tbody></table>
           <script src="{{ asset('public/Js/reporte.js') }}"></script>
    </body>

</html>