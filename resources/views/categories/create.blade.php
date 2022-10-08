
@extends('layouts.app')

@section('content')
{{--  {{ Form::open(array('url' => 'category/store')) }}  --}}
{!! Form::open( ['route' => ['category.store' ]]) !!}

<div class="col-lg-6">
    {{Form::text('name',null,["class"=>"form-control"])}}
   
</div>

<div class="col-lg-6">
     {{Form::submit('Add New Category',['class'=>'btn btn-primary'])}}
</div>
{{ Form::close() }}

@endsection