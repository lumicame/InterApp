@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 Preguntas
     </h4>
    
@endsection
@section('slider')
 @include('super.slider')

@endsection
@section('content')
       
<div class="ui segment">
 <h1 class="ui header">Preguntas</h1>

<div class="row" >
  <div class="ui items">
  <div class="item">
    <div class="content">
      <a class="header">Header</a>
      <div class="meta">
        <span>Description</span>
      </div>
      <div class="description">
        <p></p>
      </div>
      <div class="extra">
        Additional Details
      </div>
    </div>
  </div>
  <div class="item">
    
    <div class="content">
      <a class="header">Header</a>
      <div class="meta">
        <span>Description</span>
      </div>
      <div class="description">
        <p></p>
      </div>
      <div class="extra">
        Additional Details
      </div>
    </div>
  </div>
</div>
 
</div>
</div>


<!-- popup para agregar a un usuario -->


<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/course.js')}}"></script>
@endsection