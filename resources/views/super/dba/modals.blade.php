   <!-- popup para agregar un nuevo dba -->
<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" id="form_add_dba">
        <h4 class="ui dividing header">Informacion del DBA</h4>
        <div class="field">
          <label>Nombre para el DBA</label>
          <input type="text" name="name_add" id="name_add" placeholder="(ejm: DBA suma matematicas)">
          </div>
        <div class="field" >
              <label>Materia</label>
    <select class="required" name="subject_add" id="subject_add" autofocus>
    <option value="">Selecciona una materia</option>
    <?php $ss=App\Subject::where('school_id','=',null)->get();?>
    @foreach($ss as $subject)
    <option value="{{$subject->id}}">{{$subject->name}}</option>
    @endforeach
    </select>
        </div>
        <div class="field" >
              <label>Grado °</label>
    <select class="required" name="grade_add" id="grade_add" autofocus>
    <option value="">Selecciona un grado</option>
    <?php $grades=App\Grade::all(); ?>
    @foreach($grades as $grade)
    <option value="{{$grade->id}}">{{$grade->name}}</option>
    @endforeach
    </select>
        </div>
        <button class="ui button green right floated" style="margin-bottom: 10px" id="agregar">Agregar</button>
        </form>
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para edita un DBA -->
<div class="ui mini modal" id="edit_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" id="form_edit_dba">
                <h4 class="ui dividing header">Informacion del DBA</h4>
                <input type="hidden" value="" id="id_edit">
        <div class="field">
          <label>Nombre para el DBA</label>
          <input type="text" name="name_edit" id="name_edit" placeholder="(ejm: DBA suma matematicas)">
          </div>
        <button class="ui button blue right floated" style="margin-bottom: 10px" id="editar">editar</button>
        </form>
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para editar a un usuario -->
<div class="ui small modal" id="add_question">
    <i class="close icon"></i>
<div class="ui inverted dimmer">
    <div class="ui large text loader">Agregando...</div>
  </div>
<div class="header">Agregar Pregunta</div>
    <div class="scrolling content">
      <form class="ui form" method="post" id="form_add_question">
        <h4 class="ui dividing header">agregar descripcion de la pregunta</h4>
        <div class="field">
           <textarea id="text_pregunta" placeholder="Descripción de la pregunta"> </textarea>
          </div>
            <div class="field">
              <label>A</label>
          <input type="text" name="inicio_edit" id="inicio_edit" placeholder="(ejm: 7:45)">
          </div>
           <div class="field">
               <label>B</label>
          <input type="text" name="inicio_edit" id="inicio_edit" placeholder="(ejm: 7:45)">
           </div>
            <div class="field">
              <label>C</label>
          <input type="text" name="inicio_edit" id="inicio_edit" placeholder="(ejm: 7:45)">
          </div>
           <div class="field">
               <label>D</label>
          <input type="text" name="inicio_edit" id="inicio_edit" placeholder="(ejm: 7:45)">
           </div>
       
        <button class="ui button green right floated" style="margin-bottom: 10px" id="add_pregunta">Agregar</button>
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
          <h4 class="ui header">Seguro que deseas eliminar este horario</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar_dba">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->