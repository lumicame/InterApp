@extends('layouts.layout')
@section('StyleNav')
@include('coordinator.style')
@endsection

@section('content')
<div class="container" style="margin-right: 3%;margin-left: 3%">
    
          
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{$tipo}}
</div>
@endsection