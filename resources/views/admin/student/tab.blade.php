<div class="ui bottom attached tab segment" data-tab="{{$classroom->id}}">
  <h4>{{$classroom->class." - ".$classroom->classroom}}</h4>
      <table class="ui blue small selectable celled table"  id="table_content{{$classroom->id}}">
    <thead>
      <tr >
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo Electronico</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($classroom->users as $user)
         @include('admin.recursos.user')
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th colspan="6">Total Estudiantes: <span id="count_text{{$classroom->id}}">{{$classroom->users()->count()}}</span></th>
          </tr>
  </tfoot>
</table>
<button class="circular ui icon large green fixed button add" data-id="{{$classroom->id}}" style="position: fixed;right: 20px;bottom: 50px;">
  <i class="icon plus"></i>
</button>
    </div>
