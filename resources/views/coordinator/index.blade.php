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
    <div class="ui six doubling cards">
      

       @include('coordinator.menu')
       
   </div>
                
@endsection