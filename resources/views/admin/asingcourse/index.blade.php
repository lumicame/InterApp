@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 {{Auth::user()->school->name}}
     </h4>
    
@endsection
@section('slider')
 @include('admin.slider')

@endsection
@section('content')
       
<div class="ui segment">
 <h1 class="ui header">Asignar Cursos</h1>

<div class="row" >
  <div class="ui grid">

  <div class="three wide column">
    <div class="ui vertical fluid tabular menu">
      @foreach($classrooms as $classroom)
      <a class="item" data-tab="{{$classroom->id}}">
        {{$classroom->class}}
      </a>
      @endforeach
    </div>
  </div>
  <div class="thirteen wide stretched column">
    @foreach($classrooms as $classroom)
      @include('admin.asingcourse.tab')
      @endforeach
  </div>
</div>
 
</div>
</div>


<!-- popup para agregar a un usuario -->
@include('admin.asingcourse.modals')

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/course.js')}}"></script>
@endsection