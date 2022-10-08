@extends('layouts.app')

@section('content')

   <p>{{$instructor->id}}</p> 
  <p>{{$instructor->name}}</p>  
   <p>{{$instructor->created_at}}</p>
<p>  {{$instructor->updated_at}}</p>
<img src="/{{$instructor->image}}" style="width: 150px; hieght: 150px;">
<br>
   <div class="pull-left">
                <a class="btn btn-success" href="{{ route('instructor.index') }}"> Back</a>
            </div>
@endsection