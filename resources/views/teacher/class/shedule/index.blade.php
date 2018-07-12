@extends('layouts.layout')

@section('title')
<h4 id="title_materia" class="header item">
 {{Auth::user()->school->name}}
     </h4>
@endsection


@section('StyleNav')

@include('teacher.style')
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/ui/trumbowyg.min.css')}}"/>

  <script type="text/javascript" src="{{asset('Trumbowyg/dist/trumbowyg.min.js')}}"></script> 
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.css')}}"/>
            <script src="{{asset('Trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js')}}"></script>
@endsection

@section('slider')
 @include('teacher.slider')
@endsection

@section('content')
<div class="ui segment container">
<h4>{{$shedule->classroom->class." ".$shedule->classroom->classroom." - ".$shedule->subject->name}}<h4>
  <div class="ui pointing secondary menu">
  <a class="item active" data-tab="first">Alumnos</a>
  <a class="item" data-tab="second">Reportes</a>
  <a class="item" data-tab="third">Evaluaciones</a>
</div>

<div class="ui bottom attached tab segment active" data-tab="first" style="min-height: 400px">
  <div class="ui four doubling cards" >
      
      @foreach($shedule->classroom->users()->orderBy('second_name')->get() as $student)
       @include('teacher.group.student.card')
       @endforeach
     
   </div>
</div>
<div class="ui bottom attached tab segment" data-tab="second" style="min-height: 400px">
  Second
</div>
<div class="ui bottom attached tab segment" data-tab="third" style="min-height: 400px">

    <div class="ui three doubling cards" id="contenedor_evaluaciones"> 
    @if($shedule->evaluations->count()>0)  
    @foreach($shedule->evaluations as $evaluation)
     @include('teacher.class.shedule.evaluation.card')
     @endforeach
     @else
         
    @endif
    </div>
 
  <button class="circular ui icon large green fixed button add" style="position: fixed;right: 20px;bottom: 50px;">
  <i class="icon plus"></i>
</button>
</div>
  
</div>
 @include('teacher.class.shedule.evaluation.modals')

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
        ['fullscreen']]
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
        ['fullscreen']]
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
        ['fullscreen']]
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
        ['fullscreen']]
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
        ['fullscreen']]
      });
</script>
<script src="{{asset('js/teacher/teacher.js')}}"></script>
@endsection