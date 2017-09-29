$(function()
{
	
	var URL = $('#app').data('url')+'/';
	var INTEGRANTES = null;

	if($('#integrantes').length)
		INTEGRANTES = $.parseJSON(JSON.stringify($('#integrantes').data('json')));

	var populate_modal = function(data)
	{
		$('select[name="Id_TipoDocumento"]').val(data['Id_TipoDocumento']);
		$('input[name="Cedula"]').val(data['Cedula']);
		$('input[name="Primer_Apellido"]').val(data['Primer_Apellido']);
		$('input[name="Segundo_Apellido"]').val(data['Segundo_Apellido']);
		$('input[name="Primer_Nombre"]').val(data['Primer_Nombre']);
		$('input[name="Segundo_Nombre"]').val(data['Segundo_Nombre']);
		$('input[name="Fecha_Nacimiento"]').val(data['Fecha_Nacimiento']);
		$('input[name="telefono_participante"]').val(typeof data['telefono'] == 'undefined' ? '' : data['telefono']);
		$('input[name="email_participante"]').val(typeof data['email'] == 'undefined' ? '' : data['email']);
		$('input[name="Id_Genero"]').removeAttr('checked').parent('.btn').removeClass('active');
	    $('input[name="Id_Genero"][value="'+data['Id_Genero']+'"]').trigger('click');
		$('select[name="Id_Etnia"').val(data['Id_Etnia']);
		$('select[name="Talla"').val(data['talla']);
		$('input[name="Id_Persona"').val(data['Id_Persona']);
		$('select[name="rh"').val(typeof data['rh'] == 'undefined' ? '' : data['rh']);
		if($('input[name="id_categoria_deporte"]').val() == 1){
			$('input[data-role="datepicker_limite"]').datepicker({
			dateFormat: 'yy-mm-dd',
			yearRange: "-15:-13",
			changeMonth: true,
			changeYear: true,
			});
		}
		if($('input[name="id_categoria_deporte"]').val() == 2){
			$('input[data-role="datepicker_limite"]').datepicker({
			dateFormat: 'yy-mm-dd',
			yearRange: "-22:-14",
			changeMonth: true,
			changeYear: true,
			});
		}
		$('#modal_form_persona').modal('show');
	}

	var populate_upz = function (id_localidad) {
		$.post(
			URL+'listar_upz',
			{
				id_localidad: id_localidad,
			},
			function(data)
			{
				$('select[name="id_upz"]').html('');
				$('select[name="id_upz"]').append('<option value="">Seleccionar</option>');

				if(data.length)
				{
					$.each(data, function(i, e){
						$('select[name="id_upz"]').append('<option value="'+e.cod_upz+'">'+e.Upz+'</option>');
					});
					$('select[name="id_upz"]').val($('select[name="id_upz"]').data('value')).trigger('change');
				}
			},
			'json'
		)
	}

	var populate_barrios = function (id_upz) {
		$.post(
			URL+'listar_barrios',
			{
				id_upz: id_upz,
			},
			function(data)
			{
				$('select[name="id_barrio"]').html('');
				$('select[name="id_barrio"]').append('<option value="">Seleccionar</option>');

				if(data.length)
				{
					$.each(data, function(i, e){
						$('select[name="id_barrio"]').append('<option value="'+e.IdBarrio+'">'+e.Barrio+'</option>');
					});
					$('select[name="id_barrio"]').val($('select[name="id_barrio"]').data('value')).trigger('change');
				}
			},
			'json'
		)
	}

	var populate_modalidad = function (id_deporte) {
		$.post(
			URL+'listar_modalidad',
			{
				id_deporte: id_deporte,
			},
			function(data)
			{
				$('select[name="id_modalidad"]').html('');
				$('select[name="id_modalidad"]').append('<option value="">Seleccionar</option>');

				if(data.length)
				{
					$.each(data, function(i, e){
						$('select[name="id_modalidad"]').append('<option value="'+e.id+'">'+e.nombre+'</option>');
					});
					$('select[name="id_modalidad"]').val($('select[name="id_modalidad"]').data('value')).trigger('change');
				}
			},
			'json'
		)
	}

	var populate_categorias = function (id_modalidad) {
		$.post(
			URL+'listar_categorias',
			{
				id_modalidad: id_modalidad,
			},
			function(data)
			{
				$('select[name="id_categoria"]').html('');
				$('select[name="id_categoria"]').append('<option value="">Seleccionar</option>');

				if(data.length)
				{
					$.each(data, function(i, e){
						$('select[name="id_categoria"]').append('<option value="'+e.id+'">'+e.nombre+'</option>');
					});
					$('select[name="id_categoria"]').val($('select[name="id_categoria"]').data('value')).trigger('change');
				}
			},
			'json'
		)
	}


	$('select[name="id_deporte"]').on('change', function(e)
	{
		if ($(this).val() !== '')
			populate_modalidad($(this).val());
	});

	$('select[name="id_modalidad"]').on('change', function(e)
	{
		if ($(this).val() !== '')
			populate_categorias($(this).val());
	});

	$('select[name="id_localidad"]').on('change', function(e)
	{
		if ($(this).val() !== '')
			populate_upz($(this).val());
	});


	$('select[name="id_upz"]').on('change', function(e)
	{
		if ($(this).val() !== '')
			populate_barrios($(this).val());
	});

	$('#terminos').on('click', function(e)
	{
		if ($(this).is(':checked'))
			$('button[type="submit"]').removeAttr('disabled');
		else
			$('button[type="submit"]').attr('disabled', 'disabled');
	});

	$('input[name="Cedula"]').on('blur', function(data)
	{
		if ($(this).val() != '')
		{
			$.get(URL+'/personas/service/buscar/'+$(this).val(),
				{},
				function(data){
				 	 var count = Object.keys(data).length;
  					 if (count==1)
  					 {
  					 	$.each(data, function(i, e){
  					 		populate_modal(e);
					    });
  					 } else {
  					 	var miembro = {
							Id_TipoDocumento: '',
							Cedula: $('input[name="Cedula"]').val(),
							Primer_Apellido: '',
							Segundo_Apellido: '',
							Primer_Nombre: '',
							Segundo_Nombre: '',
							Fecha_Nacimiento: '',
							telefono: '',
							email: '',
							Id_Genero: '',
							Id_Etnia: '',
							Id_Persona: '0',
							rh: ''
						};
						populate_modal(miembro);
  					 }
				},
				'json'
			);
		}
	});

	$("#form_persona").on('submit', function(e)
	{
		var formObj = $(this);
    	var formURL = URL+'/welcome/persona/procesar';
    	var formData = new FormData(this);

		$.ajax({
        	url: formURL,
    		type: 'POST',
        	data:  formData,
    		mimeType:"multipart/form-data",
    		contentType: false,
        	cache: false,
			dataType: 'json',
	        processData:false,
		    success: function(data, textStatus, jqXHR)
		    {
		    	if (data.estado == false)
		    	{
					popular_errores_modal(data.errors);
		        } else if (data.estado == 'repetido') {
				    alertify.alert(data.errors, function(){
					    alertify.message('OK');
					});
		      	} else {
					window.location.reload();
				}
		    },
		     error: function(jqXHR, textStatus, errorThrown)
		    {

		    }
	    });

		e.preventDefault();
	});

	var popular_errores_modal = function(data)
	{
		$('#form_persona .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
				if (typeof data[error] !== 'function') {
						switch(error)
						{
							case 'tipoDocumento':
							case 'Id_Etnia':
							case 'Id_Pais':
							case 'Talla':
							case 'rh':
								selector = 'select';
							break;
							case 'Cedula':
							case 'Primer_Apellido':
							case 'Primer_Nombre':
							case 'Fecha_Nacimiento':
							case 'Id_Genero':
								selector = 'input';
							break;
						}
						$('#form_persona '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
				}
		}
	}

	$("#form_remover").on('submit', function(e)
	{
		var formObj = $(this);
    	var formURL = URL+'/welcome/persona/remover';
    	var formData = new FormData(this);

    	$.ajax({
	        url: formURL,
	    	type: 'POST',
	        data:  formData,
	    	mimeType:"multipart/form-data",
	    	contentType: false,
	        cache: false,
	        processData:false,
	        dataType: 'json',
		    success: function(data, textStatus, jqXHR)
		    {
		    	if (data.estado)
		    	{
			       	window.location.reload();
		       	}
		    },
		    error: function(jqXHR, textStatus, errorThrown)
		    {

		    }
	    });

		e.preventDefault();
	});

	$('#agregar_miembro').on('click', function(e)
	{
		var miembro = {
			Id_TipoDocumento:'',
			Cedula: '',
			Primer_Apellido: '',
			Segundo_Apellido: '',
			Primer_Nombre: '',
			Segundo_Nombre: '',
			Fecha_Nacimiento: '',
			telefono: '',
			email: '',
			Id_Genero: '',
			Id_Etnia: '',
			Id_Persona: '0',
			rh: ''
		};

		populate_modal(miembro);
		e.preventDefault();
	});

	$('#integrantes').delegate('a[data-role="editar"]', 'click', function(e)
	{
		var Id_Persona = $(this).closest('li').data('rel');

		var persona = $.grep(INTEGRANTES, function(dt) {
    	return dt.Id_Persona == Id_Persona;
		});
		persona = persona[0];
		persona.rh = persona.pivot['rh'];
		persona.telefono = persona.pivot['telefono'];
		persona.email = persona.pivot['email'];
		populate_modal(persona);
		e.preventDefault();
	});


	$('#integrantes').delegate('a[data-role="remover"]', 'click', function(e)
	{
		var Id_Persona = $(this).closest('li').data('rel');
		$('#modal_form_remover').modal('show');
		$('#form_remover').find('input[name="Id_Persona"]').val(Id_Persona);
		e.preventDefault();
	});

	$('select[name="id_deporte"]').trigger('change');
	$('select[name="id_localidad"]').trigger('change');
});
