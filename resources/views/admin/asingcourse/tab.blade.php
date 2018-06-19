<div class="ui bottom attached tab segment" data-tab="{{$classroom->id}}">
  <h4>{{$classroom->class." - ".$classroom->classroom}}</h4>
      <table class="ui blue small selectable celled table"  id="table_content{{$classroom->id}}">
    <thead>
      <tr>
        <th>Materia</th>
        <th>Profesor</th>
        <th>Horario</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($classroom->shedules as $shedule)
         @include('admin.asingcourse.course')
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th colspan="6">Total Horarios: <span id="count_text{{$classroom->id}}">{{$classroom->shedules()->count()}}</span></th>
          </tr>
  </tfoot>
</table>
<button class="circular ui icon large green fixed button add" data-id="{{$classroom->id}}" data-name="{{$classroom->class.' '.$classroom->classroom}}" style="position: fixed;right: 20px;bottom: 50px;">
  <i class="icon plus"></i>
</button>
    </div>