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
<h4>{{$students->class}}<h4>
 <div class="ui six doubling cards">
      
      @foreach($students as $student)
       @include('teacher.group.student.card')
       @endforeach
     
  <div class="card" style="cursor: pointer;width: 190px;height:  190px;">
    <div class="image">
       <img src="data:image/png;base64,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">
    </div>
    
  </div>
   </div>

<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('script')
<script src="{{asset('js/student.js')}}"></script>
@endsection