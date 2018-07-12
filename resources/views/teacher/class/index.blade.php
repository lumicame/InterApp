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
@if($shedules->count()>0)
      @foreach($shedules as $shedule)
       @include('teacher.class.card')
       @endforeach
   </div>
   @else
   </div>
<center style="
    /* margin-left: 50%; */
    margin-top: 20%;
    /* position:  absolute; */
"><h1>No tienes clases asignadas</h1></center>
@endif
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/student.js')}}"></script>
@endsection