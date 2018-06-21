  <div class="card"  style="cursor: pointer;border-radius: 10px"  >
    <div class="content">
      <div class="header">
         {{$shedule->subject->name}}
       </div>
      <div class="meta">{{$shedule->classroom->class." ".$shedule->classroom->classroom}}<br>
{{$shedule->classroom->users->count()." Alumnos"}}
      </div>
      <div class="description">
        <table>
           @foreach($shedule->dates as $date)
          <tr>
            <td style="padding-right:25px">{{$date->day}}</td>
            <td>{{$date->star}} - {{$date->end}}</td>
          </tr>
        @endforeach
          
        </table>
       
      </div>
      </div>
      <div class="ui bottom attached button blue" onclick="location.href='clases/{{$shedule->id}}';">
      <i class="arrow right icon"></i>
      Entrar
    </div>
    
  </div>