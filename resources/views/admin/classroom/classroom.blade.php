 <tr id="item{{$class->id}}">
      <td class="id">{{$class->id}}</td>
      <td class="class">{{$class->class}}</td>
      <td class="classroom">{{$class->classroom}}</td>
      <td class="jornada">{{$class->jornada}}</td>
      <td>{{$class->users()->count()}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$class->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$class->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>