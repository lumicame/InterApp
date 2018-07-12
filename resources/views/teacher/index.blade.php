@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 {{Auth::user()->school->name}}
     </h4>
    
@endsection

@section('StyleNav')
@include('teacher.style')
@endsection

@section('slider')
 @include('teacher.slider')
@endsection
@section('content')
    <div class="ui five doubling cards">
      

       @include('teacher.menu')
       
   </div>
                
@endsection