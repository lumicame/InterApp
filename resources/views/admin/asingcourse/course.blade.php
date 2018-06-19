 <tr id="item{{$shedule->id}}">
      <td class="subject">{{$shedule->subject->name}}</td>
      <td class="teacher">{{$shedule->user->name}}</td>
      <td class="shedule"> @foreach($shedule->dates as $date)
        {{$date->day." ".$date->star." - ".$date->end}}
        <br>  
          @endforeach</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button green editar" data-id="{{$shedule->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$shedule->id}}" data-classroom_id="{{$shedule->classroom->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>