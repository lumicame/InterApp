<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
        <h4 class="ui dividing header">Informacion de la materia</h4>
        <div class="field">
          <label>Nombre</label>
              <input type="text" id="materia" name="materia" placeholder="(ejm: Matematicas)">
            </div>
        <button class="ui button green right floated" style="margin-bottom: 10px" id="agregar">Agregar</button>
        </form>
      
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para editar a un usuario -->
<div class="ui mini modal" id="edit_popup">
    <i class="close icon"></i>
<div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando cambios...</div>
  </div>
    <div class="content">

      <form class="ui form" method="post" id="form_edit">
        <input type="hidden" value="" id="id_edit">
        <h4 class="ui dividing header">Informacion de la materia</h4>
        <div class="field">
          <label>Nombre</label>
              <input type="text" id="materia_edit" name="materia_edit" placeholder="(ejm: Matematicas)">
            </div>
            
        <button class="ui button blue right floated" style="margin-bottom: 10px" id="editar">Editar</button>
      </form>
    </div>
</div>
  <!-- fin del popup -->

  <!-- popup para eliminar a un usuario -->
  <div class="ui mini modal" id="delete_popup">
    <i class="close icon"></i>
    <div class="ui inverted dimmer">
    <div class="ui large text loader">Eliminando...</div>
  </div>
      <div class="content">
        <div class="ui form">
          <input type="hidden" id="id_delete" value="">
          <h4 class="ui header">Seguro que deseas eliminar esta materia</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->