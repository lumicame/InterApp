@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 Coordinadores
     </h4>
    
@endsection
@section('slider')
 @include('admin.slider')

@endsection
@section('content')
       
<div class="ui segment">
 <h1 class="ui header">Coordinadores</h1>
<div class="row" >
  <table class="ui blue small selectable celled table" id="table_content" >
    <thead>
      <tr >
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo Electronico</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <divclass="infinite-scroll">
        
      
     @foreach($coordinators as $coordinator)
     <tr id="user{{$coordinator->id}}">
      <td class="username">{{$coordinator->username}}</td>
      <td class="name">{{$coordinator->name}}</td>
      <td class="id">{{$coordinator->email}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$coordinator->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$coordinator->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>

    @endforeach
    </div>
  </tbody>
  <tfoot>
    <tr>
    	<th colspan="6">Total Coordinadores: <span id="count_text">{{$coordinators->count()}}</span></th>
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
@include('admin.modals')

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/user.js')}}"></script>
@endsection