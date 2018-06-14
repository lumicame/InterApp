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
    class: { required: true, minlength: 2},
    classroom: { required: true, minlength: 2},
    jornada: { required:true}
},
messages: {
    class: "Debe introducir un nombre. (ejm: Primero A)",
    classroom: "Debe introducir el numero del aula. (ejm: 101)",
    jornada : "Debe introducir una jornada. (ejm: AM)"
},
submitHandler: function(form){
  $.ajax({
    type: 'POST',
    url: 'classroom',
    data: {
        '_token': $('input[name=_token]').val(),
        'class': $('#class').val(),
        'classroom':$('#classroom').val(),
        'jornada':$('#jornada').val()
    },success: function(data) {

        $('#class').val("");
        $('#classroom').val("");
        $('#jornada').val("");
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

//evento para editar a un usuario
$('#form_edit').validate({
  rules: {
    class_edit: { required: true, minlength: 2},
    classroom_edit: { required: true, minlength: 2},
    jornada_edit: { required:true}
},
messages: {
    class_edit: "Debe introducir un nombre. (ejm: Primero A)",
    classroom_edit: "Debe introducir el numero del aula. (ejm: 101)",
    jornada_edit: "Debe introducir una jornada. (ejm: AM)"
},
submitHandler: function(form){
    $.ajax({
        type: 'POST',
        url: 'classroom/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'class_edit': $('#class_edit').val(),
            'classroom_edit':$('#classroom_edit').val(),
            'jornada_edit':$('#jornada_edit').val()
        },success: function(data) {
          $('#item'+data.id+' .class').html(data.class);
          $('#item'+data.id+' .classroom').html(data.classroom);
          $('#item'+data.id+' .jornada').html(data.jornada);

          $('#item'+data.id).addClass("warning"); 
          setTimeout(function() {
              $('#item'+data.id).removeClass("warning"); 

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
        url: 'classroom/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#delete_popup').popup('hide all');
            $('#item'+data.id).addClass("negative");

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

function cargar(id) {
   $.ajax({
        type: 'GET',
        url: 'classroom/'+id,
        data: {
            '_token': $('input[name=_token]').val(),
         },success: function(data) {
                $('#id_edit').val(data.id);
                $('#class_edit').val(data.class);
                $('#classroom_edit').val(data.classroom);
                $('#jornada_edit').val(data.jornada);
        },
    }); 
}