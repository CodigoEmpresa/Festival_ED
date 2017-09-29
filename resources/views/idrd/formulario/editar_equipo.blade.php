@extends('master-formularios')

@section('script')
	@parent
	
     <script src="{{ asset('public/Js/formulario/miembros.js') }}"></script>
@stop

@section('content')
    <div class="content" id="app" data-url="{{ url('/') }}">
        <div class="row">
    		<div class="col-md-12">
    			<div class="separador first">
    				<h4>
    					<span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span> Busque y seleccione un equipo
    				</h4>
    			</div>
    			<div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Nombre del equipo o institución</label>
                        <input type="text" id="buscador" name="nombre" value="" class="form-control">
                        <input type="hidden" name="id_equipo">
                    </div>
                </div>
            </div>		
    		<div class="col-md-12">
    			<br><br>
    		</div>
        </div>
    </div>
@stop