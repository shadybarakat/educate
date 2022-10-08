@extends('layouts.app')

@section('content')

   <p>{{$course->id}}</p> 
  <p>{{$course->name}}</p>  
  <p>Rating:{{$course->Rating}}</p>  
  <p>Lectures:{{$course->Lectures}}</p>  
  <p>Duration:{{$course->Duration}}</p>  
  <p>level:{{$course->level}}</p>  
  <p>description:{{$course->description}}</p>  
  <p>price:{{$course->price}}</p>  
  <p>Language:{{$course->Language}}</p>  
   <p>{{$course->created_at}}</p>
<p>  {{$course->updated_at}}</p>

<img src="/{{$course->image}}" style="width: 150px; hieght: 150px;">
<br>

   <div class="pull-left">
                <a class="btn btn-success" href="{{ route('course.index') }}"> Back</a>
            </div>
@endsection