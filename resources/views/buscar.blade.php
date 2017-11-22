@extends('master-formularios')

@section('script')
@parent
     <script src="{{ asset('public/Js/buscar/buscar.js') }}"></script>

@stop

@section('content')
    <div class="content" id="app" data-url="{{ url('/') }}" style="min-height: 900px;">
        <div class="row">
          @if($status == 'success')
              <div id="alerta" class="col-xs-12">
                  <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Datos actualizados satisfactoriamente.
                  </div>
              </div>
              <div class="col-xs-12">
                <br>
              </div>
          @endif
        </div>
				<div id="users">
          <div class="col-lg-6">
            <div class="input-group">
  				    <input class="form-control search" placeholder="Search" />
              <span class="input-group-btn">
  				      <button class="sort btn btn-primary " data-sort="name">
  			           Ordenar por nombre
  				      </button>
              </span>
            </div>
          </div>
          <div class="col-lg-12">
			      <ul class="list">
  			      @foreach($equipos as $equipo)
                <li>
    				      <h3 class="name">{{ $equipo['nombre_equipo'] }}</h3>
                  <div class="row">
                    <div class="col-md-3 deporte"><strong>Deporte:</strong> <span class="deporte">{{ $equipo->categoria_deporte->deporte['nombre'] }}</span></div>
                    <div class="col-md-3 modalidad"><strong>Categoría:</strong> <span class="nombre">{{ $equipo->categoria_deporte->categoria['nombre'] }}</span></div>
                    <div class="col-md-3 ubicacion"><strong>Ubicación:</strong> <span class="localidad">{{ $equipo->localidad['Localidad'] }}</span></div>
                    <div class="col-md-3 estado"><strong>Estado:</strong> <span class="localidad">{{ ($equipo->estado==1)?'Equipo Completo':'No cumple'}}</span></div>
                    <div class="col-md-12">
                      <br>
                      <a class="btn btn-xs btn-default" target="_blank" href="{{ url('/welcome/'.url_segura('encapsular',$equipo['id'])) }}">Editar</a> 
                    </div>
                  </div>
    				    </li>
              @endforeach
  				  </ul>
          </div>
				</div>
    </div>
@stop
