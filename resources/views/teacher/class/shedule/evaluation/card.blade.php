<div id="item{{$evaluation->id}}" class="ui card link">
  <div class="content open_evaluation">
    <div class="header">{{$evaluation->name}}</div>
    <div class="meta">Cierra el: {{$evaluation->finish}}</div>
    <div class="estado">Estado: {{$evaluation->estado}}</div>
  </div>
  <a class="ui red right corner label eliminarEvaluation" data-id="{{$evaluation->id}}">
        <i class="close icon"></i>
      </a>

 <div class="extra content">
  <i class="check icon"></i>
    {{1}}/{{$shedule->classroom->users->count()}} realizados
   <div class="ui mini buttons" style="float: right;">
  <button class="ui button blue edit_evaluation" data-id="{{$evaluation->id}}">editar</button>
  <div class="or" data-text="Ó"></div>
  @if($evaluation->estado=="inactivo")
  <button class="ui button green activar_evaluation" data-id="{{$evaluation->id}}">activar</button>
  @else
  <button class="ui button activar_evaluation" data-id="{{$evaluation->id}}">desactivar</button>
  @endif
</div>
 </div>
</div>