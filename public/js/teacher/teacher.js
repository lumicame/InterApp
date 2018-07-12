 $('.menu .item').tab();
// eventos para mostrar los popups
$(document).on('click','.ui.green.button.add',function () {
    $('#add_popup').modal("show");    
});
$(document).on('click','.ui.button.edit_evaluation',function () {
   cargar_evaluation($(this).data("id"));
   $('#edit_popup').modal("show");    
});

$(document).on('click','.eliminarEvaluation',function () {
    $('#id_delete').val($(this).data("id"));
    $('#delete_popup').modal("show");    
});
$(document).on('click','.open_evaluation',function () {
    $('#id_evaluation').val($(this).data("id"));
    $('#evaluation_popup').modal("show");    
});

//evento para agregar una evaluacion
$('#form_add_evaluation').validate({
	rules: {
		name_add: { required: true, minlength: 2},
		date_add: { required: true},
	},
	messages: {
		name_add: "Debe introducir un nombre para la evaluación.",
		date_add: "Debe introducir una fecha.",
	},
	submitHandler: function(form){
		$('.ui.inverted.dimmer').addClass("active");
		$.ajax({
			type: 'POST',
			url: 'evaluation',
			data: {
				'_token': $('input[name=_token]').val(),
				'shedule_id':$('#shedule_id').val(),
				'name': $('#name_add').val(),
				'date':$('#date_add').val(),
			},success: function(data) {
				
				$('#name_add').val("");
				$('#date_add').val("");
				$('#contenedor_evaluaciones').append(data.data);   
				$('.ui.inverted.dimmer').removeClass("active");

				$('#add_popup').modal("hide"); 
				$('#item'+data.id).addClass("positive"); 
				setTimeout(function() {
					$('#item'+data.id).removeClass("positive"); 

				},6000);          
				
			},
		});
	}
});

//evento para editar una evaluacion
$('#form_edit_evaluation').validate({
	rules: {
		name_edit: { required: true, minlength: 2},
		date_edit: { required: true},
	},
	messages: {
		name_edit: "Debe introducir un nombre para la evaluación.",
		date_edit: "Debe introducir una fecha.",
	},
	submitHandler: function(form){
		$('.ui.inverted.dimmer').addClass("active");
		$.ajax({
			type: 'POST',
			url: 'evaluation/'+$('#id_edit').val()+'/edit',
			data: {
				'_token': $('input[name=_token]').val(),
				'name': $('#name_edit').val(),
				'date':$('#date_edit').val(),
			},success: function(data) {
				$('.ui.inverted.dimmer').removeClass("active");
				$('#contenedor_evaluaciones #item'+data.id+" .content .header").html(data.name);
				$('#contenedor_evaluaciones #item'+data.id+" .content .meta").html("Cierra el: "+data.finish);
			},
		});
	}
});
//Agregar una pregunta a la evaluacion    
$('#form_add_question').validate({
	rules: {
		text_pregunta: { required: true, minlength: 10},
		answer_a:{required: true, minlength:1},
		answer_b:{required: true, minlength:1},
		answer_c:{required: true, minlength:1},
		answer_d:{required: true, minlength:1},

	},
	messages: {
		text_pregunta:"Más informacion sobre la pregunta",
		answer_a:"Ingrese la Respuesta A",
		answer_b:"Ingrese la Respuesta B",
		answer_c:"Ingrese la Respuesta C",
		answer_d:"Ingrese la Respuesta D",
		answer_correct:"Selecciona una respuesta correcta"
	},
	submitHandler: function(form){
		$('.ui.inverted.dimmer').addClass("active");
		$.ajax({
			type: 'POST',
			url: 'evaluation/question',
			data: {
				'_token': $('input[name=_token]').val(),
				'evaluationID':$('#id_edit').val(),
				'text_pregunta': $('#text_pregunta').val(),
				'answer_a':$('#answer_a').val(),
				'answer_b':$('#answer_b').val(),
				'answer_c':$('#answer_c').val(),
				'answer_d':$('#answer_d').val(),
				'answer_correct':$('#answer_correct').val(),
			},success: function(data) {
				$('.trumbowyg-editor').html("");
				$('#text_pregunta').val("");
				$('#answer_a').val("");
				$('#answer_b').val("");
				$('#answer_c').val("");
				$('#answer_d').val("");
				$('#answer_correct').prop('selectedIndex', 0);
				cargar_evaluation($('#id_edit').val());
				$('.ui.inverted.dimmer').removeClass("active");   
				$.uiAlert({textHead: 'Pregunta agregada corrrectamente',text: '',bgcolor: '#19c3aa',textcolor: '#fff',position: 'top-right',icon: 'checkmark box',time: 3,}); 
				
			},
		});
	}
});
$('#eliminar_evaluation').on('click',function () {
      $('.ui.inverted.dimmer').addClass("active");
    $.ajax({
        type: 'POST',
        url: 'evaluation/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#contenedor_evaluaciones #item'+data.id).addClass("negative");
        $('.ui.inverted.dimmer').removeClass("active");
            $('#delete_popup').modal("hide");
            setTimeout(function() {
              $('#contenedor_evaluaciones #item'+data.id).fadeOut( "slow", function() {

                  $('#contenedor_evaluaciones #item'+data.id).remove();
              });
          }, 1000);

        },
    });
});
$(document).on('click','.activar_evaluation',function () {
	var id=$(this).data("id");
	$.ajax({
        type: 'POST',
        url: 'evaluation/'+id+'/activar',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {

        	if(data.estado=="inactivo"){
        		$('#contenedor_evaluaciones #item'+data.id+' .extra.content .ui.mini.buttons .activar_evaluation').html("Activar");
        		$('#contenedor_evaluaciones #item'+data.id+' .extra.content .ui.mini.buttons .activar_evaluation').addClass("green");
        	}
        	else{
        		$('#contenedor_evaluaciones #item'+data.id+' .extra.content .ui.mini.buttons .activar_evaluation').html("Desactivar");
        		$('#contenedor_evaluaciones #item'+data.id+' .extra.content .ui.mini.buttons .activar_evaluation').removeClass("green");
        	}
        	$('#contenedor_evaluaciones #item'+data.id+' .content .estado').html('Estado: '+data.estado);
           

        },
    });
});
function cargar_evaluation(id) {
	$('.ui.inverted.dimmer').addClass("active");
	$.ajax({
		type: 'GET',
		url: 'evaluation/'+id,
		data: {
			'_token': $('input[name=_token]').val(),
		},success: function(data) {
			d=new Date(data.finish);

			$('#id_edit').val(data.evaluation_id);
			$('#name_edit').val(data.name);
			$('#date_edit').val(d.getFullYear()+"-"+zeroPadded(d.getMonth() + 1)+"-"+zeroPadded(d.getDate())+"T"+d.getHours()+":"+zeroPadded(d.getMinutes()));
			$('#content_item_preguntas').html(data.questions);
			$('.ui.inverted.dimmer').removeClass("active");

		},
	}); 
}
function zeroPadded(val) {
	if (val >= 10)
		return val;
	else
		return '0' + val;
}