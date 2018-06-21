<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
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
        <button class="ui button green right floated" style="margin-bottom: 10px" id="editar">Agregar</button>
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