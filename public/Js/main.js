$(function(){
	
	$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	var $loading = $('#loading').hide();
	$(document)
		.ajaxStart(function () {
		$loading.show();
	})
		.ajaxStop(function () {
		$loading.hide();
	});

	$('input[data-role="datepicker"]').datepicker({
	  dateFormat: 'yy-mm-dd',
	  yearRange: "-100:+0",
	  changeMonth: true,
	  changeYear: true,
	});

	$('select').each(function(i, e){
	  if ($(this).attr('data-value'))
	  {
	      if ($.trim($(this).data('value')) !== '')
	      {
	          var dato = $(this).data('value');
	          $(this).val(dato);
	      }
	  }
	});
});
