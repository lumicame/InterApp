@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 Preguntas
     </h4>
    
@endsection
@section('slider')
 @include('super.slider')

@endsection
@section('StyleNav')
<style type="text/css">
  .ui.mini.vertical.menu{
    margin-top: 70px;
  }
</style>
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/ui/trumbowyg.min.css')}}"/>

  <script type="text/javascript" src="{{asset('Trumbowyg/dist/trumbowyg.min.js')}}"></script> 
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.css')}}"/>
            <script src="{{asset('Trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js')}}"></script>
@endsection
@section('content')
    
<div class="ui segment">
  <div style="width: 100%">
 <h1 class="ui header" style="float: left;">Banco de preguntas</h1>
 <br>
 <h5 style="float: left;position: absolute;">Resultados: (<span id="count_preguntas">{{$questions->count()}}</span>)</h5>
   <form class="ui form" style="float: right;width: auto;" >
     <div class="two fields" >
      <div class="field">
        <select class="required" name="subject_search" id="subject_search" autofocus>
    <option value="0">Selecciona una materia</option>
    <?php $ss=App\Subject::where('school_id','=',null)->get();?>
    @foreach($ss as $subject)
    <option value="{{$subject->id}}">{{$subject->name}}</option>
    @endforeach
    </select>
      </div>

      <div class="field">
        <div class="field" >
    <select class="required" name="grade_search" id="grade_search" autofocus>
    <option value="0">Selecciona un grado</option>
    <?php $grades=App\Grade::all(); ?>
    @foreach($grades as $grade)
    <option value="{{$grade->id}}">{{$grade->name}}</option>
    @endforeach
    </select>
        </div>
      </div>
    
        </div>
        
   </form> 
     
  </div>
 
<div class="row" >
   <div class="ui inverted dimmer" id="cargando">
    <div class="ui large text loader">Cargando...</div>
  </div>
  <div class="ui items" id="content_item">
    @include('super.question.questions')
</div>
 
</div>
</div>


<!-- popup para las preguntas -->
@include('super.question.modals')

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script type="text/javascript">
      $('#text_pregunta').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        
                   
                ]
});
      $('#answer_a').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        
                   
                ]
});
      $('#answer_b').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        
                   
                ]
});
      $('#answer_c').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        
                   
                ]
});
      $('#answer_d').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        
                   
                ]
});

</script>
<script src="{{asset('js/superadmin/superadmin.js')}}"></script>
@endsection