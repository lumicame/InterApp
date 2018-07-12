@extends('layouts.layout')
@section('title')
<h4 id="title_materia" class="header item">
 Mi Cuenta
     </h4>
    
@endsection
@section('slider')
 @include('admin.slider')

@endsection
@section('content')
 

<!-- popup para agregar a un usuario -->
@include('profile')

@endsection