@extends('layouts.app')

@section('content')
@if ($errors->any())
<ul>
@foreach ( $errors->all() as $error )
   <li>{{$error}}</li> 
@endforeach
  </ul>  
@endif

{{--  {{ Form::open(array('url' => 'instructor_update')) }}  --}}
{!! Form::model($instructor, ['route' => ['instructor.update', $instructor->id], 'method' => 'patch','files' => true]) !!}

{{Form::text('name',$instructor->name)}}
{{form::text('department',$instructor->department)}}  
{{Form::file('image')}}
{{Form::submit('update')}}
{{ Form::close() }}

@endsection