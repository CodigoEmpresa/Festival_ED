@extends('master-formularios')
@section('script')
@parent
     <script src="{{ asset('public/Js/formulario/equipo.js?n=1') }}"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
@section('content')

<?

    
preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
if(count($matches)<2){
  preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
}

if (count($matches)>1){
  //Then we're using IE
  $version = $matches[1];

  switch(true){
    case ($version<=8):
      echo '<img src="public/Img/no-compatible.jpg">';
      exit();
      break;

    case ($version==9 || $version==10):
      //IE9 & IE10!
      echo '<img src="public/Img/no-compatible.jpg">';
      exit();
      break;

    case ($version==11):
      //Version 11!
      echo '<img src="public/Img/no-compatible.jpg">';
      exit();
      break;
      
    default:
      //You get the idea
  }
}
?>
<div id="loading">
  <img id="loading-image" src="http://3.bp.blogspot.com/-JeGYJyA7z2k/VNUMuthhjDI/AAAAAAAAATk/LnNLV4OGz-A/s1600/iconoCargando-1-.gif" alt="Loading..." />
</div>

    <div class="content" id="app" data-url="{{ url('/') }}">
        <form action="{{ $formulario ? url('/welcome/editar') : url('/welcome/insertar') }}" method="post" enctype="multipart/form-data">
            <div class="row">
               @if($status == 'complete')
                    <div id="alerta" class="col-xs-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Registro completo de su equipo favor revisar su correo confirmando la inscripción.
                        </div>
                    </div>
                @endif
                @if($status == 'success')
                    <div id="alerta" class="col-xs-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Por favor incluya los participante y complete el registro.
                        </div>
                    </div>
                @elseif($status == 'error')
                    <div class="col-xs-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Solucione los siguientes inconvenientes y vuelva a intentarlo.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
        		<div class="col-md-6">
        			<div class="separador first">
        				<h4>
        					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Datos generales del Escuela Deportiva
        				</h4>
        			</div>
        			<div class="row">
    	
                        <div class="col-md-12 form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="">Escuela Deportiva :&nbsp;&nbsp;</label>
                            @if (empty($formulario['nombre_equipo']))
                                 <input type="text" name="nombre" value="{{ $formulario ? $formulario['nombre_equipo'] : old('nombre') }}" class="form-control">
                            @endif

                            @if (!empty($formulario['nombre_equipo']))
                                 <p class="form-control-static"> {{ $formulario['nombre_equipo'] }} </p>
                                 <input type="hidden" name="nombre" value="{{$formulario['nombre_equipo']}}">
                            @endif
                        </div>
                        <div class="col-md-12 form-group {{ $errors->has('entrenador') ? 'has-error' : '' }}">
                            <label for="">Entrenador: </label>
                            <input type="text" name="entrenador" value="{{ $formulario ? $formulario['entrenador'] : old('entrenador') }}" class="form-control">
                        </div>
    		    		@if (empty($formulario['id_categoria_deporte']))
                          <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-12 form-group {{ $errors->has('id_categoria_deporte') ? 'has-error' : '' }}">
                                    <label for="">Categoria:</label>
                                    <select name="id_categoria_deporte" id="" class="form-control" data-value="{{ $formulario ? $formulario['id_categoria_deporte'] : old('id_categoria_deporte') }}">
                                        <option value="">Seleccionar</option>
                                        @foreach ($Categoria_deporte as $categoria)
                                            <option value="{{ $categoria['id_categoria_deporte'] }}">{{ $categoria->deporte['nombre'] }} {{ $categoria->categoria['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                          </div>
                        @endif

                        @if (!empty($formulario['id_categoria_deporte']))
                          <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-12 form-group {{ $errors->has('id_categoria_deporte') ? 'has-error' : '' }}">
                                <label for="">Categoría:&nbsp;&nbsp;</label>
                                @foreach ($Categoria_deporte as $categoria)
                                    @if ($formulario['id_categoria_deporte']== $categoria['id_categoria_deporte'])
                                        <p for="">{{ $categoria->deporte['nombre'] }} {{ $categoria->categoria['nombre'] }}</p>
                                        <input type="hidden" name="id_categoria_deporte" value="{{$formulario['id_categoria_deporte']}}">
                                    @endif
                                @endforeach
                                 </div>
                                
                            </div>
                          </div>
                        @endif
    		    		
        			</div>
                    <div class="row">
        				<div class="col-md-12 form-group {{ $errors->has('id_localidad') ? 'has-error' : '' }}">
    		    			<label for="">Localidad</label>
    		    			<select name="id_localidad" id="" class="form-control" data-value="{{ $formulario ? $formulario['id_localidad'] : old('id_localidad') }}">
                                <option value="">Seleccionar</option>
    		    				@foreach ($localidades as $localidad)
                                    <option value="{{ $localidad['Id_Localidad'] }}">{{ $localidad['Localidad'] }}</option>
                                @endforeach
    		    			</select>
    		    		</div>  		    		
        			</div>
        		</div>
        		 
        		<div class="col-md-6">
        			<div class="separador">
        				<h4>
        					<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Datos de contacto
        				</h4>
        			</div>
        			<div class="row">
        				<div class="col-md-12 form-group {{ $errors->has('delegado') ? 'has-error' : '' }}">
        					<label for="">Nombre Director Escuela</label>
        					<input type="text" name="delegado" class="form-control" value="{{ $formulario ? $formulario['delegado'] : old('delegado') }}">
        				</div>
                        <div class="col-md-12 form-group {{ $errors->has('asistente') ? 'has-error' : '' }}">
                            <label for="">Asistente: </label>
                            <input type="text" name="asistente" value="{{ $formulario ? $formulario['asistente'] : old('asistente') }}" class="form-control">
                        </div>
        				<div class="col-md-12 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        					<label for="">E-mail es nesesario que sea GMAIL</label>
        					<input type="email" name="email" required class="form-control" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@gmail.com" value="{{ $formulario ? $formulario['email'] : old('email') }}">
        				</div>
        				<div class="col-md-6 form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
        					<label for="">Teléfono</label>
        					<input type="text" name="telefono" class="form-control" value="{{ $formulario ? $formulario['telefono'] : old('telefono') }}">
        				</div>
        				<div class="col-md-6 form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
        					<label for="">Dirección</label>
        					<input type="text" name="direccion" class="form-control" value="{{ $formulario ? $formulario['direccion'] : old('direccion') }}">
        				</div>
        			</div>
        		</div>
        		<div class="col-md-12">
        			<div class="separador">
        				<h4>
        					<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Documentos requeridos
        				</h4>
        			</div>
        			<div class="row">
        				<div class="col-md-12 form-group {{ $errors->has('certificado') ? 'has-error' : '' }}">
        					<label for="">Planilla de Inscripción (Descargelo</label> <a href="{{asset('public/PLANILLA-IDRD-CLARO.xls')}}" target="_blank"> aquí, </a><label for="">diligencie y adjunte el documento en Formato PDF, PNG ó JPG)</label>
        					<input type="file" class="form-control" name="certificado">
                            @if ($formulario)
                                <br>
                                <a href="{{ asset('public/Uploads/'.$formulario['pdf']) }}" target="_blank"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Consentimiento actual</a>
                                <input type="hidden" name="certificado_old" value="{{ $formulario['pdf'] }}">
                            @else
                                <input type="hidden" name="certificado_old" value="0">
                            @endif
        				</div>
        			</div>
        		</div>

                @if ($formulario)
                    <div class="col-md-12">
                        <div class="separador">
                            <h4>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Integrantes <a id="agregar_miembro" href="" class="pull-right btn btn-xs btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="integrantes" data-json="{{ $formulario->personas }}">
                                @if (count($formulario->personas) == 0)
                                    No se han registrado para este Escuela Deportiva en el momento.
                                @else
                                    <ul class="list-group">
                                        @foreach($formulario->personas as $persona)
                                            <li class="list-group-item" data-rel="{{ $persona['Id_Persona'] }}">
                                                <h4 class="list-group-item-heading">{{ $persona['Primer_Apellido'].' '.$persona['Primer_Nombre'] }}</h4>
                                                <p class="list-group-item-text">
                                                    <div class="row">
                                                        <div class="col-md-3"><strong>Fecha de nacimiento</strong>: {{ $persona['Fecha_Nacimiento'] }}</div>
                                                        <div class="col-md-3"><strong>{{ $persona->tipoDocumento['Nombre_TipoDocumento'] }}</strong>: {{ $persona['Cedula'] }}</div>
                                                        <div class="col-md-3"><strong>Genero</strong>: {{ $persona->Id_Genero == '1' ? 'M' : 'F' }}</div>
                                                        <div class="col-md-3"><strong>Edad</strong>: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $persona['Fecha_Nacimiento'])->age }}</div>
                                                    </div>
                                                </p>
                                                <a class="btn btn-xs btn-default" data-role="editar"  href="#">
                                                    Editar
                                                </a>
                                                <a class="btn btn-xs btn-default" data-role="remover" href="#">
                                                    Remover
                                                </a>
                                              
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
            		<div class="col-md-12">
            			<div class="separador">
            				<h4>
            					<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Términos y condiciones
            				</h4>
            			</div>
            			<div class="row">
            				<div class="col-xs-12">
            					<div class="alert alert-warning" role="alert">
        							De acuerdo a la Ley 1581 de 2012 para la protección de datos personales, cuyo objeto es desarrollar el derecho constitucional que tienen todas las personas a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos, y los demás derechos, libertades y garantías constitucionales a que se refiere el artículo 15 de la Constitución Política; así como el derecho a la información consagrado en el artículo 20 de la misma. Autorizo para que mis datos personales, fotografías y videos puedan ser publicados en la página web del Instituto Distrital de Recreación y Deporte IDRD; en lo relacionado con los Festival escuelas deportivas {{date('Y')}}, excluyendo a la entidad de cualquier responsabilidad derivada de alguna demanda por situación de publicación de datos personales. Así mismo doy mi consentimiento para mi participación de las diferentes actividades programadas en el marco de realización de la Festival escuelas deportivas {{date('Y')}} y eximo al Instituto Distrital de Recreación y Deporte IDRD  de responsabilidades que van más allá de la atención en primeros auxilios y notificación a mi EPS. Adicionalmente doy constancia de que leí y entendí el contenido del presente documento..
        							<br>
        							<br>
        							<div class="row">
        								<div class="col-xs-12 center">
        									<div class="checkbox">
        										<label>
        									    	<input type="checkbox" id="terminos" name="terminos" value="" {{ $formulario ? 'checked' : '' }}>
        									    	<strong>Entiendo y acepto los términos y condiciones de los juegos.</strong>
        									  	</label>
        									</div>
        								</div>
        							</div>
            					</div>
            				</div>
            			</div>
            		</div>
                @endif
        		<div class="col-md-12">
        			<hr>
        		</div>
        		<div class="col-md-12">
                    <input type="hidden" name="id" value="{{ $formulario ? $formulario['id'] : '0' }}">
                    <input type="hidden" name="_method" value="{{ $formulario ? 'PUT' : 'POST' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary" value="" {{ $formulario ? '' : 'disabled="disabled"' }}>
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                        Guardar
                    </button>
        			@if($formulario)
                        <!-- <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal_form_remover_equipo">
                              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                              Eliminar
                         </a>-->
                    @endif
        		</div>
        		<div class="col-md-12">
        			<br><br>
        		</div>
            </div>
        </form>
    </div>
@stop
<div class="modal fade" id="modal_form_persona" class="modal fade" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="" id="form_persona" enctype='multipart/form-data' >
        <input type="hidden" name="id" value="{{ $formulario ? $formulario['id'] : '0' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #489cdf; font-family: Arial">&nbsp;&nbsp;&nbsp;Agregar integrantes a la Escuela Deportiva </h4>
                 
                    @if (empty($formulario['nombre_equipo']))
                                 <input type="text" name="nombre" value="{{ $formulario ? $formulario['nombre_equipo'] : old('nombre') }}" class="form-control">
                            @endif

                            @if (!empty($formulario['nombre_equipo']))
                                 <p style="color: #B40404; font-style: italic">&nbsp;&nbsp;&nbsp; {{ $formulario['nombre_equipo'] }} </p>
                                 <input type="hidden" name="nombre" value="{{$formulario['nombre_equipo']}}"> 
                            @endif
                      <br>
                             @if (!empty($formulario['id_categoria_deporte']))
                          <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-12 form-group {{ $errors->has('id_categoria_deporte') ? 'has-error' : '' }}">
                                <label for=""><font color="#489cdf" style="font-family: Arial">Categoría:&nbsp;&nbsp;</font></label>
                                @foreach ($Categoria_deporte as $categoria)
                                    @if ($formulario['id_categoria_deporte']== $categoria['id_categoria_deporte'])
                                        <p for="" style="color: #B40404; font-style: italic"> {{ $categoria->categoria['nombre'] }}</p>
                                        <input type="hidden" name="id_categoria_deporte" value="{{$formulario['id_categoria_deporte']}}">
                                    @endif
                                @endforeach
                                 </div>
                                
                            </div>
                          </div>
                        @endif
                </div>
                <div class="modal-body">
                    <fieldset>
                   
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Cedula">* Documento </label>
                                <input type="text" name="Cedula" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Id_TipoDocumento">* Tipo documento </label>
                                <select name="Id_TipoDocumento" id="" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($documentos as $documento)
                                        <option value="{{ $documento['Id_TipoDocumento'] }}">{{ $documento['Descripcion_TipoDocumento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for="Primer_Apellido">* Primer apellido </label>
                                <input type="text" name="Primer_Apellido" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for="Segundo_Apellido">Segundo apellido </label>
                                <input type="text" name="Segundo_Apellido" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for="Primer_Nombre">* Primer nombre </label>
                                <input type="text" name="Primer_Nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for="Segundo_Nombre">Segundo nombre </label>
                                <input type="text" name="Segundo_Nombre" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <hr>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Fecha_Nacimiento">* Fecha de nacimiento</label>
                                <input type="text" name="Fecha_Nacimiento" data-role="datepicker_limite" id="Fecha_Nacimiento" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Id_Genero">* Talla</label>
                                    
                                       <select class="form-control" name="Talla">
                                            <option value="XXS">XXS</option> 
                                            <option value="XS">XS</option> 
                                            <option value="S">S</option> 
                                            <option value="M">M</option> 
                                            <option value="L">L</option> 
                                            <option value="XL">XL</option> 
                                            <option value="XXL">XXL</option>   
                                       </select>
                             </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Id_Genero">* Género</label><br>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="Id_Genero" value="1" autocomplete="off"> <span class="text-success">M</span>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="Id_Genero" value="2" autocomplete="off"> <span class="text-danger">F</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                      
                                <input type="hidden" value="7" name="Id_Etnia" id="" class="form-control">
                       
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="rh">* Grupo sanguíneo </label>
                                <select name="rh" id="" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="A-">A-</option>
                                    <option value="A+">A+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="B-">B-</option>
                                    <option value="B+">B+</option>
                                    <option value="O-">O-</option>
                                    <option value="O+">O+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="">Copia documento de identidad <small class="text-default">(Formato PDF, PNG ó JPG)</small></label>
                                <input type="file" name="documento_de_entidad">
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="">Copia EPS o SISBEN<small class="text-default">(Formato PDF, PNG ó JPG)</small></label>
                                <input type="file" name="afiliacion_eps">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="Id_Pais" value="41">
                    <input type="hidden" name="Nombre_Ciudad" value="Bogotá">
                    <input type="hidden" name="Id_Persona" value="0">
                    <input type="hidden" name="id_equipo" value="{{ $formulario ? $formulario['id'] : '' }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_form_remover" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="" id="form_remover" enctype='multipart/form-data'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Remover integrante.</h4>
                </div>
                <div class="modal-body">
                    ¿Realmente desea remover a esta persona?
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_equipo" value="{{ $formulario ? $formulario['id'] : '' }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="Id_Persona" value="0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Remover</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_form_remover_equipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="{{ url('/welcome/remover') }}" method="post" id="form_remover_equipo" enctype='multipart/form-data'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Remover equipo.</h4>
                </div>
                <div class="modal-body">
                    ¿Realmente desea eliminar este equipo?
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_equipo" value="{{ $formulario ? $formulario['id'] : '' }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
