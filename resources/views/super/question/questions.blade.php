  @foreach($questions as $question)
   <div id="item{{$question->id}}" class="item" >
    <div class="ui segment" style="background: #3644a50f;padding: 10px;border-radius: 5px;width: 100%">
      <div class="ui grid" style="padding-left: 20px;padding-right: 20px">
        <div class="row">

      <div class="header" style="width: 100%">
        <span style="float: left;">{!!$question->question!!}</span>
        <h3 style="float: right;margin-top: 0px">{{$question->dba->subject->name." - ".$question->dba->grade->name}}</h3>
      </div>
          
        </div>
      </div>
      <div class="content">
      <div class="description">
        <ol type="A">
          <li>{!!$question->a!!}</li>
          <li>{!!$question->b!!}</li>
          <li>{!!$question->c!!}</li>
          <li>{!!$question->d!!}</li>
        </ol>
      </div>
      <div class="extra" style="color: #239063;">
        Respuesta correcta: {{$question->correct}}
        <br>
        <button class="ui inverted blue button editar_question" data-id="{{$question->id}}">Editar</button>
        <button class="ui inverted red button eliminar" data-id="{{$question->id}}">Eliminar</button>
      </div>
    </div>
    </div>
  </div>
  @endforeach