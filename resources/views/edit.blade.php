@extends('layout')
@section('content')

<div class="container my-5">
        
    <div class="row">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-8">
        
            <h3>Edit Food</h3> 

                <form action="{{ route('updateFood')}}" method="post" enctype="multipart/form-data"><br><br> @csrf
                    @foreach($foods as $food)

                    ID: <input name="foodID" type="text" class="form-control" value="{{ $food->id}}" readonly>
                    <br>
                    <img src="{{asset('images/')}}/{{$food->image}}" alt="" width="100" class="img-fluid">
                    <br>
                    Name: <input name="foodName" type="text" class="form-control" value="{{ $food->name}}">
                    <br>
                    Description:<input name="description" type="text" class="form-control" value="{{ $food->description}}">
                    <br>
                    Price: <input name="price" type="number" class="form-control" value="{{ $food->price}}">
                    <br>
                    Image: <input name="image" type="file" class="form-control">
                    <br>
                    Category: <input name="category" type="text" id="" class="form-control" value="{{ $food->category}}">
                    <br>           
                    @endforeach
                    <button type="submit" class="btn btn-info">Update</button><br><br>
                </form>
            </div>
            <div class="col-sm-2">&nbsp;</div>
        </div>
</div>
@endsection