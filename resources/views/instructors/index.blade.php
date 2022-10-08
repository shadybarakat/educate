@extends('layouts.app')

@section('content')
<div class="pull-left">
                <a class="btn btn-success" href="{{ route('instructor.create') }}"> add new instructor</a>
            </div>
        <table class="table">
            <tr>
                <td>id</td>
                <td>name</td>
                <td>department</td>
                <td>photo</td>

            </tr>
            @foreach ($instructors as $instructor)
            <tr>
                <td>{{$instructor->id}}</td>
                <td>{{$instructor->name}}</td>
                <td>{{$instructor->department}}</td>
                <td><img src="/{{$instructor->image}}" style="width: 150px; hieght: 150px;"></td>
                <td>
                    <form action="{{ route('instructor.destroy',$instructor->id) }}" method="POST">
                <a  class="btn btn-primary" href="{{ route('instructor.show',$instructor->id) }}">show</a>    
                <a class="btn btn-warning" href="{{ route('instructor.edit',$instructor->id) }}">Edit</a>    
                {{--  <a  class="btn btn-danger" href="delete/{{$instructor->id}}">Delete</a>      --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button> 
                    </form>  
            </td>
            </tr>
                
            @endforeach
           
        </table>
         {{$instructors->links()}}
   @endsection