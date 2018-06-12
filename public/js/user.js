

// eventos para mostrar los popups
$('.ui.green.button.add').popup({popup: '#add_popup',on:'click',position:'bottom center'});
$('.ui.button.editar').popup({popup: '#edit_popup',on:'click',position:'bottom center'});
$('.ui.button.eliminar').popup({popup: '#delete_popup',on:'click',position:'bottom center'});

//evento para agregar un nuevo usuario
$('#agregar').on('click',function () {
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
                alert("Agregado correctamente");
                $('#contenedor'+data.classid).append('<tr class="item'+data.id+'"><td>'+data.nit+'</td><td>'+data.name_subject+'</td><td>'+data.name_profesor+'</td><td class="td">'+data.fecha+
                    '<br>  '+'</td><td><div class="ui buttons"><button class="ui positive button edit-modal" data-id="'+data.id+'">Agregar Hora</button><div class="or" data-text="ó"></div><button class="ui negative button delete-modal" data-id="'+data.id+'">Eliminar</button>'+
                    '</div></td></tr>');                  
               

        },
    });
});