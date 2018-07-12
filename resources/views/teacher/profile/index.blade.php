@extends('layouts.layout')

@section('title')
<h4 id="title_materia" class="header item">
 Configurar Cuenta
     </h4>
@endsection


@section('slider')
 @include('teacher.slider')
@endsection

@section('content')
@include('teacher.style')
  @include('profile')
@endsection
