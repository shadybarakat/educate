<form action="{{ route('instructor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-md-4">
                    <input type="text" name="name" class="form-control">
                </div>
  
                <div class="col-md-4">
                    <input type="file" name="file" class="form-control">
                </div>
                <select name="department" >
            @foreach($categories as $category)

       <option value="{{$category->name}}">{{$category->name}}</option>

            @endforeach
            </select>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
   
            </div>
    </form>