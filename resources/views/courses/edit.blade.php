@extends('layouts.app')

@section('content')
@if ($errors->any())
<ul>
@foreach ( $errors->all() as $error )
   <li>{{$error}}</li> 
@endforeach
  </ul>  
@endif

{{--  {{ Form::open(array('url' => 'course_update')) }}  --}}
{!! Form::model($course, ['route' => ['course.update', $course->id], 'method' => 'patch','files' => true]) !!}

{{Form::text('name',$course->name)}}
{{form::number('rating',$course->Rating)}}  
{{form::number('lectures',$course->Lectures)}}  
{{form::number('duration',$course->Duration)}}  
{{form::text('level',$course->level)}}  
{{form::text('description',$course->description)}}  
{{form::number('price',$course->price)}}  
{{form::text('language',$course->Language)}}  
{{Form::file('image')}}

{{Form::submit('update')}}
{{ Form::close() }}






@endsection