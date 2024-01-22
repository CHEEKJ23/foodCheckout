@extends('layout')
@section('content')

<div class="container">
    <div class="row mx-5 text-center">
        <div class="col-md-12 mb-3 ">
            <h2>Food Menu</h2>
        </div>

        @foreach ($foods as $food)
        <div class="col-md-4">
            <div class="card shadow" style="height: 500px; width: 100%;">
                <img class="card-img-top" src="{{asset('images')}}/{{$food->image}}" alt=" " style="object-fit: cover; height: 55%; width: 100%;">
                <div class="card-body">
                    <form action="{{ route('addCart') }}" method="post"> @csrf
                        <input type="hidden" name="id" value="{{ $food->id }}">
                        <h4 class="card-title">{{ $food->name}}</h4>
                        <p class="card-text">{{ $food->description}}</p>
                        <h5 class="card-text">RM {{ $food->price}}</h5>
                        <p>Quantity: <input type="number" name="quantity" value="1" min="1"></p>
                        <button class="btn btn-danger btn-xs" type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
   
    
@endsection