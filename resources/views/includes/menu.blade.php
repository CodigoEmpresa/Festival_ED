<!-- Menu Módulo -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="{{ url('/welcome') }}" class="navbar-brand">SIM</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			@if(!empty($_SESSION['Usuario']))
				<ul class="nav navbar-nav">
				 	
		            	<li class="{{ $seccion && ($seccion == 'Formulario' || $seccion == 'Busqueda') ? 'active' : '' }}">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Copa claro 2017<span class="caret"></span></a>
											<ul class="dropdown-menu" aria-labelledby="themes">
												<li class="{{ $seccion && $seccion == 'Formulario' ? 'active' : '' }}"><a href="{{ url('/welcome') }}">Formulario de inscripción</a></li>
												<li class="{{ $seccion && $seccion == 'Busqueda' ? 'active' : '' }}"><a href="{{ url('/buscar') }}">Busqueda de equipos</a></li>
												<li class="{{ $seccion && $seccion == 'Busqueda' ? 'active' : '' }}"><a target="_blank" href="{{ url('/reporte') }}">Reporte inscritos</a></li>
												<li class="{{ $seccion && $seccion == 'Busqueda' ? 'active' : '' }}"><a  target="_blank" href="{{ url('/reporte_equipos') }}">Reporte equipos</a></li>
											</ul>
		              	</li>
		            	<li class="{{ $seccion && $seccion == 'Personas' ? 'active' : '' }}">
		                	<a href="{{ url('/personas') }}">Administración</a>
		              	</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $_SESSION['Usuario']['Persona']['Primer_Apellido'].' '.$_SESSION['Usuario']['Persona']['Primer_Nombre'] }}<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>
				  				<a href="{{ url('logout') }}">Cerrar sesión</a>
							</li>
						</ul>
					</li>
				</ul>
			@endif
		</div>
	</div>
</div>
<!-- FIN Menu Módulo -->
