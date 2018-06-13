
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
  var tipo = $('#tipo').val();
  $.ajax({
    type: 'POST',
    url: 'user',
    data: {
        '_token': $('input[name=_token]').val(),
        'tipo':tipo,
        'firstname': $('#first_name_add').val(),
        'secondname':$('#second_name_add').val(),
        'email':$('#email_add').val()
    },success: function(data) {

        $('#first_name_add').val("");
        $('#second_name_add').val("");
        $('#email_add').val("");
        $('#table_content').append(
            '<tr id="user'+data.id+'">'+
            '<td class="username">'+data.username+'</td>'+
            '<td class="name">'+data.name+'</td>'+
            '<td class="email">'+data.email+'</td>'+
            '<td><center><div class="ui small icon buttons">'+
            '<button class="ui button blue editar" data-id="'+data.id+'"><i class="edit outline icon"></i></button>'+
            '<button class="ui button red eliminar" data-id="'+data.id+'"><i class="delete icon"></i></button>'+
            '</div></center></td>'+
            '</tr>');   

        $('#user'+data.id).addClass("positive"); 
        setTimeout(function() {
          $('#user'+data.id).removeClass("positive"); 

      },6000);          
        var count= parseInt($('#count').val());
        count=count+1;
        $('#count').val(count);
        $('#count_text').html(count);
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
    $.ajax({
        type: 'POST',
        url: 'user/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'firstname': $('#first_name_edit').val(),
            'secondname':$('#second_name_edit').val(),
            'email':$('#email_edit').val()
        },success: function(data) {
          $('#user'+data.id+' .username').html(data.username);
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
        url: 'user/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#delete_popup').popup('hide all');
            $('#user'+data.id).addClass("negative");

            $('#delete_popup').modal("hide");
            setTimeout(function() {
              $('#user'+data.id).fadeOut( "slow", function() {

                  $('#user'+data.id).remove();

                  var count= parseInt($('#count').val());
                  count=count-1;
                  $('#count').val(""+count);
                  $('#count_text').html(""+count);
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