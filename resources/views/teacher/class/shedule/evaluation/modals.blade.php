  <div class="ui large modal" id="evaluation_popup" style="min-height: 80%;">
    <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="header">
    <div class="ui pointing secondary menu">
  <a class="item active" data-tab="first_modal_evaluation">Información<div class="floating ui red label">22</div></a>
  <a class="item" data-tab="second_modal_evaluation">Preguntas</a>
    <a class="item" data-tab="third_modal_evaluation">Agregar Pregunta</a>
</div>
</div>
<div class="scrolling content">
    <input type="hidden" value="" id="id_evaluation">
<!-- tab #1 -->
<div class="ui bottom attached tab active" data-tab="first_modal_evaluation">
  
</div>
<!-- tab #2 -->
<div class="ui bottom attached tab" data-tab="second_modal_evaluation">

    <div class="ui items" id="content_item">
    </div>
</div>

<!-- tab #3 -->
<div class="ui bottom attached tab " data-tab="third_modal_evaluation">
  <!-- popup para agregar una pregunta -->
   
</div> 


  </div>
  </div>

  <!-- popup para agregar un nuevo dba -->
<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" id="form_add_evaluation">
        <h4 class="ui dividing header">Información de la prueba</h4>
        <div class="field">
          <label>Dale un nombre a tu evaluación</label>
          <input type="text" name="name_add" id="name_add" placeholder="(ejm: primera evaluacion del año)">
          </div>
       <div class="field">
     <label>Establece una fecha de cierre</label>
      <input type="datetime-local" id="date_add" name="date_add" placeholder="Fecha de cierre">
  </div>
          <input type="hidden" name="shedule_id" value="{{$shedule->id}}" id="shedule_id">

        <button class="ui button green right floated" style="margin-bottom: 10px" id="agregar">Agregar</button>
        </form>
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para edita un DBA -->
<div class="ui large modal" id="edit_popup" style="min-height: 80%;">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="header">
    <div class="ui pointing secondary menu">
  <a class="item active" data-tab="first_modal">Información</a>
  <a class="item" data-tab="second_modal">Preguntas</a>
    <a class="item" data-tab="third_modal">Agregar Pregunta</a>
</div>
</div>
  <div class="scrolling content">
    <input type="hidden" value="" id="id_edit">
<!-- tab #1 -->
<div class="ui bottom attached tab active" data-tab="first_modal">
  <div class="content">
    <form class="ui form" id="form_edit_evaluation">
        <h4 class="ui dividing header">Información de la prueba</h4>
        <div class="field">
          <label>Dale un nombre a tu evaluación</label>
          <input type="text" name="name_edit" id="name_edit" placeholder="(ejm: primera evaluacion del año)">
          </div>
       <div class="field">
          <label>Establece una fecha de cierre</label>
          <input type="datetime-local" id="date_edit" name="date_edit" placeholder="Fecha de cierre">
       </div>
        <button class="ui button blue">editar</button>
      </form>
    </div>
</div>
<!-- tab #2 -->
<div class="ui bottom attached tab" data-tab="second_modal">

    <div class="ui items" id="content_item">
    </div>
</div>

<!-- tab #3 -->
<div class="ui bottom attached tab " data-tab="third_modal">
  <!-- popup para agregar una pregunta -->
      <form class="ui form" method="post" id="form_add_question">
        <h4 class="ui dividing header">Agregar descripción de la pregunta</h4>
        <div class="field">
           <textarea id="text_pregunta" name="text_pregunta" style="height: 200px" placeholder="Descripción de la pregunta"> </textarea>
          </div>
            <div class="field">
              <label>Respuesta A</label>
              <textarea name="answer_a" id="answer_a" placeholder="Descripción de la respuesta A" rows="2" style="min-height: 58px"></textarea>
            </div>
           <div class="field">
               <label>Respuesta B</label>
               <textarea name="answer_b" id="answer_b" placeholder="Descripción de la respuesta B" rows="2" style="min-height: 58px"></textarea>
           </div>
            <div class="field">
              <label>Respuesta C</label>
              <textarea name="answer_c" id="answer_c" placeholder="Descripción de la respuesta C" rows="2" style="min-height: 58px"></textarea>
          </div>
           <div class="field">
               <label>Respuesta D</label>
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
</div>
  <!-- fin del popup -->

  <!-- popup para eliminar una evaluacion -->
  <div class="ui mini modal" id="delete_popup">
    <i class="close icon"></i>
    <div class="ui inverted dimmer">
    <div class="ui large text loader">Eliminando...</div>
  </div>
      <div class="content">
        <div class="ui form">
          
          <h4 class="ui header">¿Seguro que deseas eliminar esta evaluacion?, se perderan todos los datos como quien a contestado y todas las preguntas</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar_evaluation">Eliminar</button>
          <input type="hidden" id="id_delete" value="">
        </div>

    </div>
  </div>          
  <!-- fin del popup -->