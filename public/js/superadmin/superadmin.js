

// eventos para mostrar los popups
//activar modal para agregar datos
$(document).on('click','.ui.green.button.add',function () {
    $('#add_popup').modal("show");    
});
//activar modal para agregar una pregunta
$(document).on('click','.ui.button.add_question',function () {
  $('#id_dba').val($(this).data("id"));
   $('#add_question').modal("show");    
});
//activar modal para editar datos
$(document).on('click','.ui.button.editar',function () {
   cargar($(this).data("id"));
   $('#edit_popup').modal("show");    
});
//activar modal para editar preguntas
$(document).on('click','.ui.button.editar_question',function () {
   cargar_question($(this).data("id"));
   $('#edit_popup').modal("show");    
});
//activar modal para editar dbas
$(document).on('click','.ui.button.editar_dba',function () {
   cargar_dba($(this).data("id"));
   $('#edit_popup').modal("show");    
});
//activar modal para eliminar datos
$(document).on('click','.ui.button.eliminar',function () {
    $('#id_delete').val($(this).data("id"));
    $('#delete_popup').modal("show");    
});

$('#subject_search').on('change', function() {
  filtrar();
});
$('#grade_search').on('change', function() {
  filtrar();
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
        $('.ui.inverted.dimmer').addClass("active");
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
                    $('.ui.inverted.dimmer').removeClass("active");   

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
        $('.ui.inverted.dimmer').addClass("active");

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
        url: 'superadmin/school/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#delete_popup').popup('hide all');
            $('#user'+data.id).addClass("negative");
        $('.ui.inverted.dimmer').removeClass("active");   

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
//Agregar un nuevo DBA
  $('#form_add_dba').validate({
      rules: {
        name_add:{required: true, minlength: 3},
    },
    messages: {
        name_add:"Escribe el nombre del DBA (min:3 caracteres)",
        subject_add:"Selecciona una materia",
        grade_add: "Selecciona un grado",
    },
    submitHandler: function(form){
        $('.ui.inverted.dimmer').addClass("active");
      $.ajax({
        type: 'POST',
        url: 'dba',
        data: {
            '_token': $('input[name=_token]').val(),
            'name_add': $('#name_add').val(),
            'subject_add':$('#subject_add').val(),
            'grade_add':$('#grade_add').val(),
        },success: function(data) {

            $('#name_add').val("");
          $('#subject_add').prop('selectedIndex', 0);
            $('#grade_add').prop('selectedIndex', 0);
                    $('.ui.inverted.dimmer').removeClass("active");   
  $('#add_popup').modal("hide");
            $('#table_content').append(data.data);   

            $('#item'+data.id).addClass("positive"); 
            setTimeout(function() {
              $('#item'+data.id).removeClass("positive"); 

          },6000);          
            var count= parseInt($('#count_text').html());
            count=count+1;
            $('#count_text').html(count);
        },
    });
    }
    });

//evento para editar un DBA
    $('#form_edit_dba').validate({
      rules: {
        name_edit: { required: true, minlength: 2},
    },
    messages: {
        name_edit: "Debe introducir un nombre."
    },
    submitHandler: function(form){
        $('.ui.inverted.dimmer').addClass("active");

        $.ajax({
            type: 'POST',
            url: 'dba/'+$('#id_edit').val()+'/edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'name_edit': $('#name_edit').val(),
            },success: function(data) {
              $('#item'+data.id+' .name').html(data.name);

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

//Eliminar un DBA
    $('#eliminar_dba').on('click',function () {
        $('.ui.inverted.dimmer').addClass("active");

        $.ajax({
            type: 'POST',
            url: 'dba/'+$('#id_delete').val()+'/delete',
            data: {
                '_token': $('input[name=_token]').val()
            },success: function(data) {
                $('#item'+data.id).addClass("negative");
            $('.ui.inverted.dimmer').removeClass("active");   

                $('#delete_popup').modal("hide");
                setTimeout(function() {
                  $('#item'+data.id).fadeOut( "slow", function() {

                      $('#item'+data.id).remove();

                      var count= parseInt($('#count_text').html());
                      count=count-1;
                      $('#count_text').html(""+count);
                  });
              }, 1000);
            },
        });
    });
    //Agregar un nuevo DBA

//Agregar una pregunta al dba    
  $('#form_add_question').validate({
      rules: {
        text_pregunta: { required: true, minlength: 10},
        answer_a:{required: true, minlength:1},
        answer_b:{required: true, minlength:1},
        answer_c:{required: true, minlength:1},
        answer_d:{required: true, minlength:1},

    },
    messages: {
        text_pregunta:"mas informacion sobre la pregunta",
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
        url: 'dba/question',
        data: {
            '_token': $('input[name=_token]').val(),
            'id_dba':$('#id_dba').val(),
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
                    $('.ui.inverted.dimmer').removeClass("active");   
                    $('#add_popup').modal("hide");
            $('#item'+$('#id_dba').val()+' .count').html(data.count);
        },
    });
    }
    });

//Editar una pregunta
 $('#form_edit_question').validate({
      rules: {
        text_pregunta: { required: true, minlength: 10},
        answer_a:{required: true, minlength:1},
        answer_b:{required: true, minlength:1},
        answer_c:{required: true, minlength:1},
        answer_d:{required: true, minlength:1},

    },
    messages: {
        text_pregunta:"mas informacion sobre la pregunta",
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
        url: 'question/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
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
                    $('.ui.inverted.dimmer').removeClass("active");   
                    $('#edit_popup').modal("hide");
                    $('#item'+data.id).replaceWith(data.data);
        },
    });
    }
    });

//Eliminar una pregunta
  $('#eliminar_question').on('click',function () {
        $('.ui.inverted.dimmer').addClass("active");

        $.ajax({
            type: 'POST',
            url: 'question/'+$('#id_delete').val()+'/delete',
            data: {
                '_token': $('input[name=_token]').val()
            },success: function(data) {
                $('#item'+data.id).addClass("negative");
            $('.ui.inverted.dimmer').removeClass("active");   

                $('#delete_popup').modal("hide");
                setTimeout(function() {
                  $('#item'+data.id).fadeOut( "slow", function() {
                      $('#item'+data.id).remove();
                  });
              }, 1000);
            },
        });
    });

//Filtrar por materia y grado
function filtrar() {
          $('#cargando').addClass("active");
  $.ajax({
        type: 'POST',
        url: 'question/search',
        data: {
                '_token': $('input[name=_token]').val(),
                'subject':$('#subject_search').val(),
                'grade':$('#grade_search').val(),
            },
        success: function(data) {
          $('#count_preguntas').html(data.count);
          $('#cargando').removeClass("active");   
          $('#content_item').html(data.data);
        },
    }); 
}

function cargar(id) {
   $.ajax({
        type: 'GET',
        url: 'superadmin/school/'+id,
        success: function(data) {
                $('#id_edit_dba').val(data.id);
                $('#name_edit').val(data.name);
                $('#email_edit').val(data.email);
                $('#number_edit').val(data.phone);
                
        },
    }); 
}
function cargar_dba(id) {
   $.ajax({
        type: 'GET',
        url: 'dba/'+id,
        success: function(data) {
                $('#id_edit').val(data.id);
                $('#name_edit').val(data.name);
        },
    }); 
}
function cargar_question(id) {
   $.ajax({
        type: 'GET',
        url: 'question/'+id,
        success: function(data) {
                $('#id_edit').val(data.id); 
                $('#text_pregunta').trumbowyg("html", data.question);
            $('#answer_a').trumbowyg("html", data.a);
            $('#answer_b').trumbowyg("html", data.b);
            $('#answer_c').trumbowyg("html", data.c);
            $('#answer_d').trumbowyg("html", data.d);
        },
    }); 
}


