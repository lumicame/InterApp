@extends('layouts.layout')
@section('title')


<h4 id="title_materia" class="header item">
 DBA
     </h4>
    
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

@section('slider')
 @include('super.slider')
@endsection
@section('content')
    <div class="ui segment">
 <h1 class="ui header">DBAS</h1>
<div class="row" >
  <table class="ui unstackable blue small selectable celled table" id="table_content" >
    <thead>
      <tr >
      	<th>Nombre</th>
        <th>Grado°</th>
        <th>Materia</th>
        <th>Tolal Preguntas</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($dbas as $dba)
    @include('super.dba.dba')
    @endforeach
  </tbody>
  <tfoot>
    <tr>
    	<th colspan="8">Total DBAS: <span id="count_text">{{$dbas->count()}}</span></th>
    	</tr>
      
  </tfoot>
</table>
</div>
</div>
        <input type="hidden" id="tipo" value="coordinator">

<button class="circular ui icon large green fixed button add" id="" style="position: fixed;
    right: 20px;
    bottom: 50px;">
  <i class="icon plus"></i>
</button>
<!-- popup para agregar a un usuario -->
@include('super.dba.modals')

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