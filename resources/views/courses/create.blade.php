@extends('layouts.app')

@section('content')

@if ($errors->any())
<ul>
@foreach ( $errors->all() as $error )
   <li>{{$error}}</li> 
@endforeach
  </ul>  
@endif

{!! Form::open( ['route' => ['course.store'],'files'=>true]) !!}

<div class="col-lg-4">
    {{Form::text('name',null,["class"=>"form-control",'placeholder' => 'name'])}}
   
</div>
<div class="col-lg-2">
    {{Form::number('price',null,["class"=>"form-control",'placeholder' => 'price'])}}
   
</div>
<div class="col-lg-3">
    {{Form::number('lectures',null,["class"=>"form-control",'placeholder' => 'lectures'])}}
   
</div>
<div class="col-lg-3">
    {{Form::number('duration',null,["class"=>"form-control",'placeholder' => 'duration'])}}
   
</div>

<div class="col-lg-6">
    {{Form::text('description',null,["class"=>"form-control",'placeholder' => 'description'])}}
   
</div>

<div class="col-lg-6">
    {{Form::number('rating',null,["class"=>"form-control",'placeholder' => 'rating'])}}
   
</div>
<div class="col-lg-6">
    {{Form::text('lang',null,["class"=>"form-control",'placeholder' => 'language'])}}
   
</div>
<div class="col-lg-12">
<p> <h3> course category :</h3>
@foreach($categories as $category)
     <input type="checkbox" name="category_id[]" value="{{$category->id}}" >{{$category->name}}
@endforeach</p>
</div>


<div class="col-lg-6">
<select name="level" >
    <option value="begginer">begginer</option>
    <option value="advanced">advanced</option>
    <option value="professional">professional</option>
</select>

</div>

<div class="col-md-6">
{{Form::file('image')}}
                </div>
<div class="col-lg-12">

     {{Form::submit('Add New Course',['class'=>'btn btn-primary'])}}
</div>





{{ Form::close() }}

@endsection