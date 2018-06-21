@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 DBA
     </h4>
    
@endsection


@section('slider')
 @include('super.slider')
@endsection
@section('content')
    <div class="ui segment">
 <h1 class="ui header">DBAS</h1>
<div class="row" >
  <table class="ui blue small selectable celled table" id="table_content" >
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
<script src="{{asset('js/superadmin.js')}}"></script>
@endsection