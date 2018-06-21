 <tr id="item{{$subject->id}}">
      <td class="name">{{$subject->name}}</td>
      <td>
      	<center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$subject->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$subject->id}}"><i class="delete icon"></i></button>
      </div></center>
      	</td>
    </tr>