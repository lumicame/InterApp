 $('.menu .item').tab();
// eventos para mostrar los popups
$(document).on('click','.ui.green.button.add',function () {
  $('#classroom_add').val($(this).data('id'));
    $('#text_class_add').val($(this).data('name'));

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
    inicio_add: { required: true},
    fin_add: { required: true},
},
messages: {
    subject_add:"Selecciona una materia",
    day_add: "Selecciona un dia.",
    inicio_add: "Introduce una hora correcta.",
    inicio_time_add: "Selecciona un horario.",
    fin_add: "Introduce una hora correcta.",
    fin_time_add: "Selecciona un horario.",
    user_add: "Selecciona un docente.",
},
submitHandler: function(form){
  $.ajax({
    type: 'POST',
    url: 'asingcourse',
    data: {
        '_token': $('input[name=_token]').val(),
        'subject_id': $('#subject_add').val(),
        'day':$('#day_add').val(),
        'inicio':$('#inicio_add').val(),
        'inicio_time':$('#inicio_time_add').val(),
        'fin':$('#fin_add').val(),
        'fin_time':$('#fin_time_add').val(),
        'user_id':$('#user_add').val(),
        'classroom_id':$('#classroom_add').val()
    },success: function(data) {

          $('#subject_add').prop('selectedIndex', 0);
          $('#day_add').prop('selectedIndex', 0);
          $('#inicio_add').val('');
          $('#inicio_time_add').prop('selectedIndex', 0);
          $('#fin_add').val('');
          $('#fin_time_add').prop('selectedIndex', 0);
          $('#user_add').prop('selectedIndex', 0);
        $('#table_content'+$('#classroom_add').val()).append(data.data);   
        $('#add_popup').modal("hide"); 
        $('#item'+data.id).addClass("positive"); 
        setTimeout(function() {
          $('#item'+data.id).removeClass("positive"); 

      },6000);          
        var count= parseInt($('#count_text'+$('#classroom_add').val()).html());
        count=count+1;
        $('#count_text'+$('#classroom_add').val()).html(count);
    },
});
}
});

//evento para editar a un usuario
$('#form_edit').validate({
  rules: {
    inicio_edit: { required: true},
    fin_edit: { required: true},
},
messages: {
     day_edit: "Selecciona un dia.",
    inicio_edit: "Introduce una hora correcta.",
    inicio_time_edit: "Selecciona un horario.",
    fin_edit: "Introduce una hora correcta.",
    fin_time_edit: "Selecciona un horario.",
},
submitHandler: function(form){
    $.ajax({
        type: 'POST',
        url: 'asingcourse/'+$('#id_edit').val()+'/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'day':$('#day_edit').val(),
                    'inicio':$('#inicio_edit').val(),
                    'inicio_time':$('#inicio_time_edit').val(),
                    'fin':$('#fin_edit').val(),
                    'fin_time':$('#fin_time_edit').val(),
        },success: function(data) {
          $('#item'+data.id +' .shedule').append(data.fecha+'<br>');

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
        url: 'asingcourse/'+$('#id_delete').val()+'/delete',
        data: {
            '_token': $('input[name=_token]').val()
        },success: function(data) {
            $('#item'+data.id).addClass("negative");

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
