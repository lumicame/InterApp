
   <!-- popup para editar una pregunta -->
<div class="ui large modal" id="edit_popup">
    <i class="close icon"></i>
<div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
<div class="header">Editar Pregunta</div>
    <div class="scrolling content">
      <form class="ui form" method="post" id="form_edit_question">
        <input type="hidden" name="id_edit" id="id_edit">
        <h4 class="ui dividing header">Agregar descripción de la pregunta</h4>
        <div class="field">
           <textarea id="text_pregunta" name="text_pregunta" style="height: 200px" placeholder="Descripción de la pregunta"> </textarea>
          </div>
            <div class="field">
              <label>A</label>
              <textarea name="answer_a" id="answer_a" placeholder="Descripción de la respuesta A" rows="2" style="min-height: 58px"></textarea>
            </div>
           <div class="field">
               <label>B</label>
               <textarea name="answer_b" id="answer_b" placeholder="Descripción de la respuesta B" rows="2" style="min-height: 58px"></textarea>
           </div>
            <div class="field">
              <label>C</label>
              <textarea name="answer_c" id="answer_c" placeholder="Descripción de la respuesta C" rows="2" style="min-height: 58px"></textarea>
          </div>
           <div class="field">
               <label>D</label>
               <textarea name="answer_d" id="answer_d" placeholder="Descripción de la respuesta D" rows="2" style="min-height: 58px"></textarea>
           </div>
           <div class="field">
             <label>Selecciona la respuesta correcta</label>
             <select class="required" style="width: auto;" id="answer_correct" name="answer_correct">
               <option value="">Selecciona una respuesta</option>
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="C">C</option>
               <option value="D">D</option>

             </select>
           </div>
       
        <button class="ui button green right floated" style="margin-bottom: 10px" id="add_pregunta">Guardar</button>
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
          <input type="hidden" id="classroom_id_delete" value="">
          <input type="hidden" id="id_delete" value="">
          <h4 class="ui header">Seguro que deseas eliminar esta pregunta</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar_question">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->