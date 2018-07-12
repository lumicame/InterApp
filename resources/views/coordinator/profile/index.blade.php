@extends('layouts.layout')

@section('title')
<h4 id="title_materia" class="header item">
 Mi Cuenta
     </h4>
@endsection


@section('slider')
 @include('coordinator.slider')
@endsection

@section('content')

@include('coordinator.style')
 @include('profile')
    
@endsection