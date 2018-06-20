 $('.menu .item').tab();
// eventos para mostrar los popups
$(document).on('click','.ui.green.button.add',function () {
    $('#classroom_id').val($(this).data("id"));
    $('#add_popup').modal("show");    
});
$(document).on('click','.ui.button.editar',function () {
   cargar($(this).data("id"));
   $('#edit_popup').modal("show");    
});

$(document).on('click','.ui.button.eliminar',function () {
    $('#id_delete').val($(this).data("id"));
    $('#classroom_id_delete').val($(this).data("classroom_id"));
    $('#delete_popup').modal("show");    
});


//evento para agregar un nuevo usuario
$('#form_add').validate({
  rules: {
    first_name_add: { required: true, minlength: 2},
    second_name_add: { required: true, minlength: 2},
    email_add: { required:true, email: true}
},
messages: {
    first_name_add: "Debe introducir un nombre.",
    second_name_add: "Debe introducir un apellido.",
    email_add : "Debe introducir un email válido."
},
submitHandler: function(form){
  $('.ui.inverted.dimmer').addClass("active");
  var tipo = $('#tipo').val();
  $.ajax({
    type: 'POST',
    url: 'user',
    data: {
        '_token': $('input[name=_token]').val(),
        'tipo':tipo,
        'classroom_id':$('#classroom_id').val(),
        'firstname': $('#first_name_add').val(),
        'secondname':$('#second_name_add').val(),
        'email':$('#email_add').val()
    },success: function(data) {
       
         $('#first_name_add').val("");
        $('#second_name_add').val("");
        $('#email_add').val("");
        $('#table_content'+$('#classroom_id').val()).append(data.data);   
        $('.ui.inverted.dimmer').removeClass("active");
         $.uiAlert({
textHead: 'Registro exitoso',
text: 'Se ha enviado un email con los datos de ingreso a la plataforma al usuario '+$('#first_name_add').val()+" "+$('#second_name_add').val(),
 bgcolor: '#19c3aa',
  textcolor: '#fff',
   position: 'top-right',
    icon: 'checkmark box',
     time: 3,}); 
                 $('.ui.inverted.dimmer').removeClass("active");

        $('#add_popup').modal("hide"); 
        $('#item'+data.id).addClass("positive"); 
        setTimeout(function() {
          $('#item'+data.id).removeClass("positive"); 

      },6000);          
        var count= parseInt($('#count_text'+$('#classroom_id').val()).html());
        count=count+1;
        $('#count_text'+$('#classroom_id').val()).html(count);
    },
});
}
});

//evento para editar a un usuario
$('#form_edit').validate({
  rules: {
    first_name_edit: { required: true, minlength: 2},
    second_name_edit: { required: true, minlength: 2},
    email_edit: { required:true, email: true}
},
messages: {
    first_name_add: "Debe introducir un nombre.",
    second_name_add: "Debe introducir un apellido.",
    email_add : "Debe introducir un email válido."
},
submitHandler: function(form){
      $('.ui.inverted.dimmer').addClass("active");

    $.ajax({
        type: 'POST',
        url: 'user/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'firstname': $('#first_name_edit').val(),
            'secondname':$('#second_name_edit').val(),
            'email':$('#email_edit').val()
        },success: function(data) {
          $('#item'+data.id+' .username').html(data.username);
          $('#item'+data.id+' .name').html(data.name);
          $('#item'+data.id+' .email').html(data.email);

          $('#item'+data.id).addClass("warning"); 
          setTimeout(function() {
              $('#item'+data.id).removeClass("warning"); 

          },2000);          
                  $('.ui.inverted.dimmer').removeClass("active");

          $('#edit_popup').modal("hide");

      },
  });
}
});
//evento para eliminar a un usuario
$('#eliminar').on('click',function () {
      $('.ui.inverted.dimmer').addClass("active");

    $.ajax({
        type: 'POST',
        url: 'user/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#delete_popup').popup('hide all');
            $('#item'+data.id).addClass("negative");
        $('.ui.inverted.dimmer').removeClass("active");

            $('#delete_popup').modal("hide");
            setTimeout(function() {
              $('#item'+data.id).fadeOut( "slow", function() {

                  $('#item'+data.id).remove();

                  var count= parseInt($('#count_text'+$('#classroom_id_delete').val()).html());
                  count=count-1;
                  $('#count_text'+$('#classroom_id_delete').val()).html(""+count);
              });
          }, 1000);

        },
    });
});

function cargar(id) {
   $.ajax({
        type: 'GET',
        url: 'user/'+id,
        data: {
            '_token': $('input[name=_token]').val(),
         },success: function(data) {
                $('#id_edit').val(data.id);
                $('#first_name_edit').val(data.first_name);
                $('#second_name_edit').val(data.second_name);
                $('#email_edit').val(data.email);
        },
    }); 
}