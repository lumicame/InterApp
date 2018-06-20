<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
        <h4 class="ui dividing header">Informacion Horario</h4>
        <div class="field" >
              <label>Materia</label>
    <select class="required" name="subject_add" id="subject_add" autofocus>
    <option value="">Selecciona una materia</option>
    @foreach(Auth::user()->school->subjects as $subject)
    <option value="{{$subject->id}}">{{$subject->name}}</option>
    @endforeach
    </select>
        </div>
        <div class="field">
          <label>Docente</label>
          <?php
          $roles=App\Role::where('name','teacher')->first();
        $teachers =App\User::where([['role_id', '=', $roles->id],['school_id', '=', Auth::user()->school->id]])->get();
               ?>
      <select class="required" id="user_add" name="user_add">
    <option value="">Selecciona un profesor</option>
    @foreach($teachers as $teacher)
    <option value="{{$teacher->id}}">{{$teacher->name." - ".$teacher->username}}</option>
    @endforeach
    </select>
        </div>
        <div class="field disabled">
          <input type="hidden" class="classroom_add" id="classroom_add">
          <label>Curso</label>
          <input type="text" id="text_class_add" disabled="true">
        </div>

          <div class="field">
            <select class="required" id="day_add" name="day_add">
            <option value="">Selecciona un dia</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option> 
          </select>
          </div>
          <div class="two fields">
            <div class="field">
          <input type="text" name="inicio_add" id="inicio_add" placeholder="(ejm: 7:45)">
          </div>
           <div class="field">
               <select class="required" name="inicio_time_add" id="inicio_time_add">
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
           </div>
          </div>
          <div class="two fields">
            <div class="field">
          <input type="text" name="fin_add" id="fin_add" placeholder="(ejm: 7:45)">
          </div>
          <div class="field">
               <select class="required" name="fin_time_add" id="fin_time_add">
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
           </div>
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
    <div class="ui large text loader">Agregando...</div>
  </div>
    <div class="content">

      <form class="ui form" method="post" id="form_edit">
        <input type="hidden" value="" id="id_edit">
        <h4 class="ui dividing header">Agregar un horario a esta materia</h4>
        <div class="field">
            <select class="required" id="day_edit" name="day_edit">
            <option value="">Selecciona un dia</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option> 
          </select>
          </div>
          <div class="two fields">
            <div class="field">
          <input type="text" name="inicio_edit" id="inicio_edit" placeholder="(ejm: 7:45)">
          </div>
           <div class="field">
               <select class="required" name="inicio_time_edit" id="inicio_time_edit">
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
           </div>
          </div>
          <div class="two fields">
            <div class="field">
          <input type="text" name="fin_edit" id="fin_edit" placeholder="(ejm: 7:45)">
          </div>
          <div class="field">
               <select class="required" name="fin_time_edit" id="fin_time_edit">
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
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
    <div class="ui inverted dimmer">
    <div class="ui large text loader">Eliminando...</div>
  </div>
      <div class="content">
        <div class="ui form">
          <input type="hidden" id="classroom_id_delete" value="">
          <input type="hidden" id="id_delete" value="">
          <h4 class="ui header">Seguro que deseas eliminar este horario</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->
