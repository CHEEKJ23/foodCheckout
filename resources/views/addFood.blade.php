@extends('layout')
@section('content')

<div class="container">
    @if(Session::has('success'))           
        <div class="alert alert-success" role="alert" id="sessionMessage">
            {{ Session::get('success') }}
        </div>
    @endif


    <div class="row">
        <div class="col-sm-2">&nbsp;</div>

        <div class="col-sm-8">
        <form action="{{ route('addFood') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3>Add New Food</h3> 
            Name: <input name="name" type="text" class="form-control"><br>
            Description: <input name="description" type="text" class="form-control"><br>
            Price: <input name="price" type="number" class="form-control"><br>
            Image: <input name="image" type="file" class="form-control"><br>
            Category: <input name="category" type="text" class="form-control"><br>        
            <button type="submit" class="btn btn-info">Add</button><br><br>
        </form>

        
    </div>

        <div class="col-sm-2">&nbsp;</div>
    </div>
</div>

<script>
    // JavaScript to hide the session message after 3 seconds
    setTimeout(function() {
        document.getElementById('sessionMessage').style.display = 'none';
    }, 3000); // 3000 milliseconds = 3 seconds
</script>


@endsection