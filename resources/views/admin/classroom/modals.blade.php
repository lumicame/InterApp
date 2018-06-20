<div class="ui mini modal" id="add_popup">
  <i class="close icon"></i>
  <div class="ui inverted dimmer">
    <div class="ui large text loader">Guardando...</div>
  </div>
  <div class="content">
      <form class="ui form" method="post" id="form_add">
        <h4 class="ui dividing header">Informacion del salon</h4>
            <div class="field">
              <label>Nombre para el curso</label>
              <input type="text" id="class" name="class" placeholder="Nombre (ejm: Primero A)">
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
            <div class="field">
              <label># de aula</label>
              <input type="number" id="classroom" name="classroom" placeholder="Aula (ejm: 101)">
            </div>
            <div class="field">
              <label>Jornada</label>
              <input type="text" id="jornada" name="jornada" placeholder="Jornada (ejm: AM)">
            </div>
            <div class="field">
              <label>Total de cupos</label>
              <input type="number" id="quota" name="quota" placeholder="(ejm: 30)">
            </div>
            <div class="field">
          <label>Selecciona un director de grupo</label>
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
        <h4 class="ui dividing header">Informacion del salon</h4>
     
          
            <div class="field">
              <label>Nombre para el curso</label>
              <input type="text" id="class_edit" name="class_edit" placeholder="Nombre (ejm: Primero A)">
            </div>
            <div class="field" >
              <label>Grado °</label>
    <select class="required" name="grade_edit" id="grade_edit" autofocus>
    <option value="">Selecciona un grado</option>
    <?php $grades=App\Grade::all(); ?>
    @foreach($grades as $grade)
    <option value="{{$grade->id}}">{{$grade->name}}</option>
    @endforeach
    </select>
        </div>
            <div class="field">
              <label># de aula</label>
              <input type="text" id="classroom_edit" name="classroom_edit" placeholder="Aula (ejm: 101)">
            </div>
            <div class="field">
              <label>Jornada</label>
              <input type="text" id="jornada_edit" name="jornada_edit" placeholder="Jornada (ejm: AM)">
            </div>
            <div class="field">
              <label>Total de cupos</label>
              <input type="number" id="quota_edit" name="quota_edit" placeholder="(ejm: 30)">
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
          <h4 class="ui header">¿Seguro que deseas eliminar este salon de clases?</h4>
          <button class="ui button red right floated" style="margin-bottom: 10px" id="eliminar">Eliminar</button>
        </div>

    </div>
  </div>          
  <!-- fin del popup -->
