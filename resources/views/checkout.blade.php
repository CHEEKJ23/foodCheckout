@extends('layout')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>                        
            <th>Unit Price</th>                         
            <th>Quantity</th> 
            <th>Subtotal</th>                         
            <th>Actions</th>
        </tr>
    </thead>
        
    <tbody>
        <?php $total = 0; ?> <!-- Initialize total outside the loop -->
        @foreach ($myorders as $myorder)
        <tr>
            <td width="10%"><img src="{{ asset('images') }}/{{ $myorder->image }}" width="100" alt="" class="img-fluid"></td> 
            <td>{{ $myorder->name }}</td>                        
            <td>{{ $myorder->price }}</td>                        
            <td>{{ $myorder->qty }}</td> 
            <td>{{ $myorder->qty * $myorder->price }}</td>
            <?php $total += $myorder->qty * $myorder->price; ?> <!-- Add the subtotal to the total -->
        </tr>
        @endforeach
        <tr align="right">
            <td colspan="4">&nbsp;</td>
            <td>Total:</td>
            <td>RM<i>{{ $total }}</i></td>
            <td>&nbsp;</td>
        </tr>
    </tbody>              
</table>
@endsection
