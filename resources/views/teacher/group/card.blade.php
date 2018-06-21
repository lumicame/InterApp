 <div class="card"  style="cursor: pointer;border-radius: 10px ">
    <div class="content">
      <div class="header">
         {{$classroom->class}}
       </div>
      <div class="meta">{{$classroom->class." ".$classroom->classroom}}<br>
        {{$classroom->users->count()." Alumnos"}}
      </div>
      </div>
      <div class="ui bottom attached button blue" onclick="location.href='grupos/{{$classroom->id}}/estudiantes';">
      <i class="arrow right icon"></i>
      Entrar
    </div>
    
  </div>