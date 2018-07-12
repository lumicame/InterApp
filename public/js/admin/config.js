$('#description_edit').trumbowyg("html", $('#school_description').val());

$('#cargar_foto').on('click',function () {
	$('#avatarInput').click();
});
$('#avatarInput').on('change',function () {
	$('#segment_top').addClass('loading');
	var formData = new FormData();
    formData.append('photo', $('#avatarInput')[0].files[0]);
	formData.append('_token',$('input[name=_token]').val());
    formData.append('tipo',"photo");
    $.ajax({
        url: 'config/school/'+$('#school_id').val(),
        method: "POST",
        data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
            $('#logo').attr('src', data.logo);
	$('#segment_top').removeClass('loading');
    }).fail(function () {
	$('#segment_top').removeClass('loading');
            });
});
$('#cargar_portada').on('click',function () {
	$('#portadaInput').click();
});
$('#portadaInput').on('change',function () {
	$('#segment_top').addClass('loading');
	var formData = new FormData();
    formData.append('photo', $('#portadaInput')[0].files[0]);
	formData.append('_token',$('input[name=_token]').val());
    formData.append('tipo',"portada");
    $.ajax({
        url: 'config/school/'+$('#school_id').val(),
        method: "POST",
        data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
            $('#portada').css("background-image", "url('"+data.portada+"')");
	$('#segment_top').removeClass('loading');
    }).fail(function () {
	$('#segment_top').removeClass('loading');
            });
});
//evento para editar el nombre del colegio
$('#edit_name_school').validate({
	rules: {
		name_edit: { required: true, minlength: 2},
	},
	messages: {
		name_edit: "Debe introducir un nombre para la Institucion.",
	},
	submitHandler: function(form){
		$('#button_name').addClass('loading');
		$.ajax({
			type: 'POST',
			url: 'config/school/'+$('#school_id').val(),
			data: {
				'_token': $('input[name=_token]').val(),
				'tipo':"name",
				'name': $('#name_edit').val(),
			},success: function(data) {
				$('#button_name').removeClass('loading');
				$('#title_school').html(data.name);
				$.uiAlert({textHead: 'Cambios guardados correctamente',text: '',bgcolor: '#19c3aa',textcolor: '#fff',position: 'top-right',icon: 'checkmark box',time: 3,}); 
       
			},
		});
	}
});
//evento para editar el nombre del colegio
$('#edit_number_school').validate({
	rules: {
		number_edit: { required: true, minlength: 7},
	},
	messages: {
		number_edit: "Debe introducir un numero de telefono.",
	},
	submitHandler: function(form){
		$('#button_number').addClass('loading');
		$.ajax({
			type: 'POST',
			url: 'config/school/'+$('#school_id').val(),
			data: {
				'_token': $('input[name=_token]').val(),
				'tipo':"number",
				'number': $('#number_edit').val(),
			},success: function(data) {
					$('#button_number').removeClass('loading');
				$.uiAlert({textHead: 'Cambios guardados correctamente',text: '',bgcolor: '#19c3aa',textcolor: '#fff',position: 'top-right',icon: 'checkmark box',time: 3,}); 
                
			},
		});
	}
});
//evento para editar el nombre del colegio
$('#edit_direction_school').validate({
	rules: {
		direction_edit: { required: true, minlength: 5},
	},
	messages: {
		direction_edit: "Debe introducir una dirección para la Institución.",
	},
	submitHandler: function(form){
		$('#button_direction').addClass('loading');
		$.ajax({
			type: 'POST',
			url: 'config/school/'+$('#school_id').val(),
			data: {
				'_token': $('input[name=_token]').val(),
				'tipo':"direction",
				'direction': $('#direction_edit').val(),
			},success: function(data) {
				$('#button_direction').removeClass('loading');
				$.uiAlert({textHead: 'Cambios guardados correctamente',text: '',bgcolor: '#19c3aa',textcolor: '#fff',position: 'top-right',icon: 'checkmark box',time: 3,}); 
                         
			},
		});
	}
});
$('#edit_description_school').validate({
	rules: {
		description_edit: { required: true, minlength: 5},
	},
	messages: {
		description_edit: "Debe introducir una descripción para la Institución.",
	},
	submitHandler: function(form){
				$('#button_description').addClass('loading');
		$.ajax({
			type: 'POST',
			url: 'config/school/'+$('#school_id').val(),
			data: {
				'_token': $('input[name=_token]').val(),
				'tipo':"description",
				'description': $('#description_edit').val(),
			},success: function(data) {
					$('#button_description').removeClass('loading');
				$.uiAlert({textHead: 'Cambios guardados correctamente',text: '',bgcolor: '#19c3aa',textcolor: '#fff',position: 'top-right',icon: 'checkmark box',time: 3,}); 
                           
			},
		});
	}
});