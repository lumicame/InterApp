 <tr id="item{{$dba->id}}">
      <td class="name">{{$dba->name}}</td>
      <td class="grade">{{$dba->grade->name}}</td>
      <td class="subject">{{$dba->subject->name}}</td>
      <td class="count">{{$dba->questions->count()}}</td>
      <td>
      	<center><div class="ui small icon buttons">
        <button class="ui button green add_question" data-id="{{$dba->id}}"><i class="plus icon"></i>Agregar pregunta</button>
        <button class="ui button blue editar_dba" data-id="{{$dba->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$dba->id}}"><i class="delete icon"></i></button>
      </div></center>
      	</td>
    </tr>