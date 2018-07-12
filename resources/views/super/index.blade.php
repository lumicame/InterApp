@extends('layouts.layout')

@section('slider')
@include('super.slider')
@endsection
@section('title')
<h4 id="title_materia" class="header item">
 <i class="home icon" style="font-size: 27px"></i>
    Inicio
  </h4>
@endsection
@section('content')
       
<div class="ui segment">
 <h1 class="ui header">Instituciones</h1>
<div class="row" >
  <table class="ui unstackable blue small selectable celled table" id="table_content">
    <thead>
      <tr >
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo Electronico</th>
        <th>Telefono</th>
        <th>Numero Usuarios</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($schools as $school)
     <tr id="user{{$school->id}}">
      <td class="nit">{{$school->nit}}</td>
      <td class="name">{{$school->name}}</td>
      <td class="email">{{$school->email}}</td>
      <td class="phone">{{$school->phone}}</td>
      <td class="users">{{$school->users()->count()}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar" data-id="{{$school->id}}"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar" data-id="{{$school->id}}"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>

    @endforeach
    
  </tbody>
  <tfoot>
    <tr>
    	<th colspan="6">Total Instituciones: <span id="count_text">{{$schools->count()}}</span></th>
    	</tr>
  </tfoot>
</table>
</div>
</div>

<button class="circular ui icon large green fixed button add" id="" style="position: fixed;
    right: 20px;
    bottom: 50px;">
  <i class="icon plus"></i>
</button>
<!-- popup para agregar a un usuario -->
@include('super.modals')

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/superadmin/superadmin.js')}}"></script>
@endsection