  @foreach($questions as $question)
  <div id="item{{$question->id}}" class="item" style="background: #1726900d;padding: 10px;border-radius: 5px">
    <div class="content">
      <div class="header" style="width: 100%"><span style="float: left;">{!!$question->question!!}</span>
        <h3 style="float: right;">{{$question->dba->subject->name." - ".$question->dba->grade->name}}</h3></div>
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
  @endforeach