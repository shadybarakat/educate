@extends('layouts.app')

@section('content')
<div class="pull-left">
                <a class="btn btn-success" href="{{ route('course.create') }}"> add new course</a>
            </div>
        <table class="table">
            <tr>
                <td>id</td>
                <td>name</td>
                <td>description</td>
                <td>instructor</td>
                <td>photo</td>

            </tr>
            @foreach ($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->name}}</td>
                <td>{{$course->description}}</td>
                <td>{{$course->instructor->name}}</td>
                <td><img src="/{{$course->image}}" style="width: 150px; hieght: 150px;"></td>
                <td>
                    <form action="{{ route('course.destroy',$course->id) }}" method="POST">
                <a  class="btn btn-primary" href="{{ route('course.show',$course->id) }}">show</a>    
                <a class="btn btn-warning" href="{{ route('course.edit',$course->id) }}">Edit</a>    
                {{--  <a  class="btn btn-danger" href="delete/{{$course->id}}">Delete</a> --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button> 
                    </form>  
            </td>
            </tr>
                
            @endforeach
           
        </table>
         {{$courses->links()}}
   @endsection