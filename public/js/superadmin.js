// eventos para mostrar los popups
$(document).on('click','.ui.green.button.add',function () {
    $('#add_popup').modal("show");    
});
$(document).on('click','.ui.button.editar',function () {
   cargar($(this).data("id"));
   $('#edit_popup').modal("show");    
});

$(document).on('click','.ui.button.eliminar',function () {
    $('#id_delete').val($(this).data("id"));
    $('#delete_popup').modal("show");    
});
//evento para agregar una nueva instituciòn
    $('#form_add').validate({
      rules: {
        name_add:{required: true, minlength: 5},
        number_add:{required: true, minlength: 7},
        first_name_admin_add: { required: true, minlength: 2},
        second_name_admin_add: { required: true, minlength: 2},
        email_add: { required:true, email: true}
    },
    messages: {
        name_add:"Escribe el nombre de la institucion (min:5 caracteres)",
        number_add:"Escribe el telefono de la institucion (min:7 caracteres)",
        first_name_admin_add: "Escribe el nombre del administrador",
        second_name_admin_add: "Escribe el segundo nombre del administrador",
        email_add: "Escribe un correo electronico valido"
    },
    submitHandler: function(form){
      $.ajax({
        type: 'POST',
        url: 'superadmin/school',
        data: {
            '_token': $('input[name=_token]').val(),
            'name_add': $('#name_add').val(),
            'number_add':$('#number_add').val(),
            'first_name_admin_add':$('#first_name_admin_add').val(),
            'second_name_admin_add':$('#second_name_admin_add').val(),
            'email_add':$('#email_add').val()
        },success: function(data) {

            $('#name_add').val("");
            $('#number_add').val("");
            $('#first_name_admin_add').val("");
            $('#second_name_admin_add').val("");
            $('#email_add').val("");
            $('#table_content').append(
                '<tr id="user'+data.id+'">'+
                '<td class="nit">'+data.nit+'</td>'+
                '<td class="name">'+data.name+'</td>'+
                '<td class="email">'+data.email+'</td>'+
          '<td class="phone">'+data.phone+'</td>'+
          '<td class="users">1</td>'+
                '<td><center><div class="ui small icon buttons">'+
                '<button class="ui button blue editar" data-id="'+data.id+'"><i class="edit outline icon"></i></button>'+
                '<button class="ui button red eliminar" data-id="'+data.id+'"><i class="delete icon"></i></button>'+
                '</div></center></td>'+
                '</tr>');   

            $('#user'+data.id).addClass("positive"); 
            setTimeout(function() {
              $('#user'+data.id).removeClass("positive"); 

          },6000);          
            var count= parseInt($('#count_text').html());
            count=count+1;
            $('#count_text').html(count);
        },
    });
    }
    });

//evento para editar una nueva instituciòn
    $('#form_edit').validate({
      rules: {
        name_edit: { required: true, minlength: 2},
        number_edit: { required: true, minlength: 7},
        email_edit: { required:true, email: true}
    },
    messages: {
        name_edit: "Debe introducir un nombre.",
        number_edit: "Debe introducir un apellido.",
        email_edit : "Debe introducir un email válido."
    },
    submitHandler: function(form){
        $.ajax({
            type: 'POST',
            url: 'superadmin/school/'+$('#id_edit').val()+'/edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'name_edit': $('#name_edit').val(),
                'number_edit':$('#number_edit').val(),
                'email_edit':$('#email_edit').val()
            },success: function(data) {
              $('#user'+data.id+' .phone').html(data.phone);
              $('#user'+data.id+' .name').html(data.name);
              $('#user'+data.id+' .email').html(data.email);

              $('#user'+data.id).addClass("warning"); 
              setTimeout(function() {
                  $('#user'+data.id).removeClass("warning"); 
              },2000);          
              $('#edit_popup').modal("hide");

          },
      });
    }
    });
//evento para eliminar a un usuario
$('#eliminar').on('click',function () {
    $.ajax({
        type: 'POST',
        url: 'superadmin/school/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#delete_popup').popup('hide all');
            $('#user'+data.id).addClass("negative");

            $('#delete_popup').modal("hide");
            setTimeout(function() {
              $('#user'+data.id).fadeOut( "slow", function() {

                  $('#user'+data.id).remove();

                  var count= parseInt($('#count_text').html());
                  count=count-1;
                  $('#count_text').html(""+count);
              });
          }, 1000);

        },
    });
});

function cargar(id) {
   $.ajax({
        type: 'GET',
        url: 'superadmin/school/'+id,
        success: function(data) {
                $('#id_edit').val(data.id);
                $('#name_edit').val(data.name);
                $('#number_edit').val(data.phone);
                $('#email_edit').val(data.email);
        },
    }); 
}