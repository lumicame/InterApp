<div class="ui modal" id="add_popup">
  <i class="close icon"></i>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
        <h4 class="ui dividing header">Informacion del salon</h4>
        <div class="field">
          <label>Datos</label>
          <div class="three fields">
            <div class="field">
              <input type="text" id="class" placeholder="Nombre (ejm: Primero A)">
            </div>
            <div class="field">
              <input type="number" id="classroom" placeholder="Aula (ejm: 101)">
            </div>
            <div class="field">
              <input type="text" id="jornada" placeholder="Jornada (ejm: AM)">
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
        <h4 class="ui dividing header">Informacion del salon</h4>
        <div class="field">
          <label>Datos</label>
          <div class="three fields">
            <div class="field">
              <input type="text" id="class_edit" placeholder="Nombre (ejm: Primero A)">
            </div>
            <div class="field">
              <input type="text" id="classroom_edit" placeholder="Aula (ejm: 101)">
            </div>
            <div class="field">
              <input type="text" id="jornada_edit" placeholder="Jornada (ejm: AM)">
            </div>
          </div>
        </div>
        <button class="ui button blue right floated" style="margin-bottom: 10px" id="editar">Editar</button>
      </form>
    </div>
</div>
  <!-- fin del popup -->

  <!-- popup para eliminar a un usuario -->
  <div class="ui mini modal" id="delete_popup">
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
