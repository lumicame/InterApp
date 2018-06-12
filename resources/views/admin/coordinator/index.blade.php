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
  <button  style="margin-bottom: 10px;float: right;" class="ui green button add">
    <i class="icon user"></i>
    Agregar Coordinador
  </button>
  <div class="ui mini form " style="float: left;">
    <div class="inline field">
      <label># Registros por pagina</label>
      <input type="text" name="cantidad" placeholder="10">
    </div>
  </div>

<div class="row" >
  <table class="ui blue selectable celled table">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo Electronico</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
     @foreach($coordinators as $coordinator)
     <tr>
      <td>{{$coordinator->username}}</td>
      <td>{{$coordinator->name}}</td>
      <td>{{$coordinator->email}}</td>
      <td><center><div class="ui small icon buttons">
        <button class="ui button blue editar"><i class="edit outline icon"></i></button>
        <button class="ui button red eliminar"><i class="delete icon"></i></button>
      </div></center></td>
    </tr>

    @endforeach
    
  </tbody>
  <tfoot>
    <tr>
    	<th colspan="2">{{"Total Coordinadores: ".$coordinators->total()}}</th>
    	<th colspan="4">
        {{$coordinators->links('vendor.pagination.default')}}

      </th>
    </tr>
  </tfoot>
</table>
</div>
</div>

<!-- popup para agregar a un usuario -->
<div class="ui flowing popup right bottom transition hidden" id="add_popup">
  <div class="ui one column divided grid">
    <div class="column">
      
      <div class="ui form">
        <h4 class="ui dividing header">Informacion del Coordinador</h4>
        <input type="hidden" id="tipo" value="coordinator">
        <div class="field">
          <label>Nombre</label>
          <div class="two fields">
            <div class="field">
              <input type="text" id="first_name_add" name="first_name_add" placeholder="Primer Nombre">
            </div>
            <div class="field">
              <input type="text" id="second_name_add" name="second_name_add" placeholder="Segundo Nombre">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Correo Electronico</label>
          <div class="field">
            <input type="text" id="email_add" name="email_add" placeholder="Correo Electronico">
          </div>
        </div>
        <button class="ui button green right floated" id="agregar">Agregar</button>
      </div>
    </div>
  </div>
</div>
  <!-- fin del popup -->

   <!-- popup para editar a un usuario -->
<div class="ui flowing popup right bottom transition hidden" id="edit_popup">
  <div class="ui one column divided grid">
    <div class="column">

      <div class="ui form">
        <h4 class="ui dividing header">Informacion del Coordinador</h4>
        <div class="field">
          <label>Nombre</label>
          <div class="two fields">
            <div class="field">
              <input type="text" name="add_first_name" placeholder="Primer Nombre">
            </div>
            <div class="field">
              <input type="text" name="add_second_name" placeholder="Segundo Nombre">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Correo Electronico</label>
          <div class="field">
            <input type="text" name="add_email" placeholder="Email">
          </div>
        </div>
        <button class="ui button green right floated">Agregar</button>
      </div>
    </div>
  </div>
</div>
  <!-- fin del popup -->

  <!-- popup para eliminar a un usuario -->
  <div class="ui flowing popup right bottom transition hidden" id="delete_popup">
    <div class="ui one column divided grid">
      <div class="column">

        <form class="ui form">
          <h4 class="ui header">Seguro que deseas eliminar este Coordinador</h4>
          <button class="ui button red right floated">Eliminar</button>
        </form>
      </div>

    </div>
  </div>          
  <!-- fin del popup -->

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/user.js')}}"></script>
@endsection