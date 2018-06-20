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
    materia: { required: true, minlength: 3}
},
messages: {
    materia: "Introduce un nombre para la materia. (ejm: Matematicas)"
},
submitHandler: function(form){
      $('.ui.inverted.dimmer').addClass("active");

  $.ajax({
    type: 'POST',
    url: 'subject',
    data: {
        '_token': $('input[name=_token]').val(),
        'materia': $('#materia').val(),
    },success: function(data) {

        $('#materia').val("");
        $('#table_content').append(data.data);   
                $('.ui.inverted.dimmer').removeClass("active");

        $('#add_popup').modal("hide"); 

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
   materia_edit: { required: true, minlength: 3}
},
messages: {
     materia_edit: "Introduce un nombre para la materia. (ejm: Matematicas)"
},
submitHandler: function(form){
      $('.ui.inverted.dimmer').addClass("active");

    $.ajax({
        type: 'POST',
        url: 'subject/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'materia_edit': $('#materia_edit').val(),
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
//evento para eliminar a un usuario
$('#eliminar').on('click',function () {
      $('.ui.inverted.dimmer').addClass("active");

    $.ajax({
        type: 'POST',
        url: 'subject/'+$('#id_delete').val()+'/delete',
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

function cargar(id) {
   $.ajax({
        type: 'GET',
        url: 'subject/'+id,
        data: {
            '_token': $('input[name=_token]').val(),
         },success: function(data) {
                $('#id_edit').val(data.id);
                $('#materia_edit').val(data.name);
          
        },
    }); 
}