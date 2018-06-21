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
 <div class="ui six doubling cards">
      
      @foreach($shedules as $shedule)
       @include('teacher.class.card')
       @endforeach
   </div>

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/student.js')}}"></script>
@endsection