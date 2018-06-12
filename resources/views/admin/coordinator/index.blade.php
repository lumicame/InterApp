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
          	<button  id="agregar" style="margin-bottom: 10px;float: right;" class="ui green button add">
  <i class="icon user"></i>
  Agregar Coordinador
</button>
<div class="ui flowing popup right bottom transition hidden">
	<div class="ui one column divided grid">
		<div class="column">
			
			<form class="ui form">
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
</form>
		</div>
		  
	</div>
  
</div>
          	<div class="row" >
          		<table class="ui blue selectable celled table">
  <thead>
    <tr>
    <th>Id</th>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Correo Electronico</th>
    <th>Acción</th>
  </tr>
</thead>
  <tbody>
  	@foreach($coordinators as $coordinator)
  	<tr>
  		<td >{{$coordinator->id}}</td>
      <td>{{$coordinator->username}}</td>
      <td>{{$coordinator->name}}</td>
      <td>{{$coordinator->email}}</td>
      <td><center><div class="ui small icon buttons">
  <button class="ui button blue"><i class="edit outline icon"></i></button>
  <button class="ui button red"><i class="delete icon"></i></button>
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
<div class="ui flowing popup right bottom transition hidden" id="edit_popup">
	<div class="ui one column divided grid">
		<div class="column">
			
			<form class="ui form">
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
</form>
		</div>
		  
	</div>
  
</div>

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
          	</div>
      

   </div>
                   


@endsection
@section('script')
<script type="text/javascript">
    $('.ui.green.button.add').popup({popup: '.fluid.popup',on:'click',position:'bottom center'});
$('.ui.button.blue').popup({popup: '#edit_popup',on:'click',position:'bottom center'});
$('.ui.button.red').popup({popup: '#delete_popup',on:'click',position:'bottom center'});
    
</script>
@endsection