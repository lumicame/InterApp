@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 {{Auth::user()->school->name}}
     </h4>
@endsection

@section('StyleNav')
@include('coordinator.style')
@endsection

@section('slider')
 @include('coordinator.slider')
@endsection

@section('content')
<div class="ui segment">
 <h1 class="ui header">Docentes</h1>
<div class="row" >
  <table class="ui blue small selectable celled table" id="table_content">
    <thead>
      <tr >
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo Electronico</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($teachers as $user)
         @include('admin.recursos.user')
    @endforeach
    
  </tbody>
  <tfoot>
    <tr>
    	<th colspan="6">Total Docentes: <span id="count_text">{{$teachers->count()}}</span><input type="hidden" id="count" value="{{$teachers->count()}}"> </th>

    </tr>
  </tfoot>
</table>
</div>
</div>
        <input type="hidden" id="tipo" value="teacher">

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