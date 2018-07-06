@extends('layouts.layout')

@section('slider')
 @include('admin.slider')

@endsection
@section('title')
 <i class="home icon" style="font-size: 27px"></i>
   {{Auth::user()->school->name}} 
@endsection
@section('content')
    
          <div class="ui six doubling cards">
      

       @include('admin.menu')
       
   </div>
                   

@endsection