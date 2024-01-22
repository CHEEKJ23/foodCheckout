@extends('layout')
@section('content')
<script>
   function cal() {
      var names = document.getElementsByName('subtotal[]');
      var subtotal = 0;
      var cboxes = document.getElementsByName('cid[]');
      var len = cboxes.length;
      for(var i = 0; i < len; i++) {
         if(cboxes[i].checked) {
            subtotal = parseFloat(names[i].value) + parseFloat(subtotal);
         }
      }
      document.getElementById('sub').value=subtotal.toFixed(2);
   }

   function submitCheckoutForm() {
        document.getElementById('checkoutForm').submit();
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <br><br>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>My Cart</h2></div>
                    <div class="col-sm-4">                        
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Image</th>
                        <th>Name</th>                        
                        <th>Unit Price</th>                         
                        <th>Quantity</th> 
                        <th>Subtotal</th>                         
                        <th>Actions</th>
                    </tr>
                </thead>
                         
                <tbody>
                    <form action="{{ route('payment.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">                    
                        @csrf  
                    @foreach ($carts as $cart)
                    <tr> 
                        <td><input type="checkbox" name="cid[]" id="cid[]" value="{{ $cart->cid }}" onclick="cal()"><input type="hidden" name="subtotal[]" id="subtotal[]" value="{{ $cart->cartQty*$cart->price }}"></td>
                        <td width="10%"><img src="{{asset('images')}}/{{$cart->image}}" width="100" alt="" class="img-fluid"></td> 
                        <td>{{ $cart->name }}</td>                        
                        <td>{{ $cart->price }}</td>                        
                        <td>{{ $cart->cartQty }}</td> 
                        <td>{{ $cart->cartQty*$cart->price }}</td>                         
                        <td>        							
                        <a href="{{route('deleteCartItem',['id'=>$cart->cid])}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                        
                        
                    </tr>
                    @endforeach
                    <tr align="right">
                        <td colspan="5">&nbsp;</td>
                        <td>RM<i> </i> <input type="text" value="0" name="sub" id="sub" size="7" readonly /></td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>              

                
                
            </table>
            <button class="btn btn-primary btn-xs btn-block" type="submit">Check Out</button>

        </div>
    </div>
</div>


@endsection