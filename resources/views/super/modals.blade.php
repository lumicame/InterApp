<div class="ui modal" id="add_popup">
  <i class="close icon"></i>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
        <h4 class="ui dividing header">Informacion de la institución</h4>
        <div class="field">
          <label>Nombre de la institución</label>
              <input type="text" id="name_add" name="name_add" placeholder="¿Como se llama la institución?">
            </div>
        <div class="field">
          <label>Correo Electronico</label>
          <div class="field">
            <input type="email" id="email_add" name="email_add" placeholder="¿Cual es el correo de la institución?" required="true">
          </div>
        </div>
        <div class="field">
          <label>Telefono</label>
          <div class="field">
            <input type="number" id="number_add" name="number_add" placeholder="¿Cual es el telefono de la institución?" required="true">
          </div>
        </div>

        <h4 class="ui dividing header">Informacion del Administrador</h4>
        <div class="field">
          <label>Nombre del administrador</label>
          <div class="two fields">
            <div class="field">
              <input type="text" id="first_name_admin_add" placeholder="Primer nombre">
            </div>
            <div class="field">
              <input type="text" id="second_name_admin_add" placeholder="Segundo nombre">
            </div>
          </div>
        </div>
        <button class="ui button green right floated" style="margin-bottom: 10px" id="agregar">Agregar</button>
        </form>
      
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para editar a un usuario -->
<div class="ui modal" id="edit_popup">
    <i class="close icon"></i>

    <div class="content">

      <form class="ui form" method="post" id="form_edit">
        <input type="hidden" value="" id="id_edit">
        <h4 class="ui dividing header">Informacion del usuario</h4>
        <div class="field">
          <label>Nombre</label>
          <div class="two fields">
            <div class="field">
              <input type="text" id="first_name_edit" placeholder="Primer Nombre">
            </div>
            <div class="field">
              <input type="text" id="second_name_edit" placeholder="Segundo Nombre">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Correo Electronico</label>
          <div class="field">
            <input type="email" id="email_edit" placeholder="Email">
          </div>
        </div>
        <button class="ui button blue right floated" style="margin-bottom: 10px" id="editar">Editar</button>
      </form>
    </div>
</div>
  <!-- fin del popup -->

  <!-- popup para eliminar a un usuario -->
  <div class="ui modal" id="delete_popup">
    <i class="close icon"></i>
      <div class="content">

        <div class="ui form">
          <input type="hidden" id="id_delete" value="">
          <h4 class="ui header">Seguro que deseas eliminar este usuario</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->
