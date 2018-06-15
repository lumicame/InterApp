 <tr id="item{{$user->id}}">
      <td class="username">{{$user->username}}</td>
      <td class="name">{{$user->name}}</td>
      <td class="id">{{$user->email}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$user->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$user->id}}" data-classroom_id="{{$user->classroom->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>