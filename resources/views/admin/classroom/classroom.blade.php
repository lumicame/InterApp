 <tr id="item{{$class->id}}">
      <td class="class">{{$class->class}}</td>
      <td class="classroom">{{$class->classroom}}</td>
      <td class="grade">{{$class->grade->name}}</td>
      <td class="jornada">{{$class->jornada}}</td>
      @if($class->director()->first())
        <td>{{$class->director()->first()->name." - ".$class->director()->first()->username}}</td>
      @else
      <td>Por asignar</td>
      @endif
      <td>{{$class->users()->count()}}</td>
      <td class="quota">{{$class->quota}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$class->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$class->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>