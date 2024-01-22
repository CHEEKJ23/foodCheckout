<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Models\Food;
use App\Models\myCart;
use App\Models\myOrder;
use Session;

class CartController extends Controller
{

     public function add(){
        $r=request();
        $add=myCart::create([
            'quantity'=>$r->quantity,
            'orderID'=>'',
            'foodID'=>$r->id,
        ]);
        $this->cartItem();
        return redirect()->route('showFood');
    }

    public function showMyCart(){
        $cart = DB::table('my_carts')
            ->leftjoin('food', 'food.id', '=', 'my_carts.foodID')
            ->select('my_carts.quantity as cartQty', 'my_carts.id as cid', 'my_carts.foodID', 'food.*')
            ->where('my_carts.orderID', '=', '')
            ->get();
    
        return view('myCart')->with('carts', $cart);
    }
    
    public function view(){
        $viewAll=myCart::all();
        return view('myCart')->with('my_carts',$viewAll); 
    }

    public function delete($id){
        $deleteItem = myCart::find($id);
        $deleteItem->delete();
        $this->cartItem();
        Session::flash('success', 'Item was removed successfully!');
        return redirect()->route('myCart');
    }

    public function cartItem() {
        $cartItem = 0;
        $noItem = DB::table('my_carts')
            ->leftjoin('food', 'food.id', '=', 'my_carts.foodID')
            ->select(DB::raw('COUNT(DISTINCT my_carts.id) as count_item'))
            ->where('my_carts.orderID', '=' , '')
            ->first();
    
        if ($noItem) {
            $cartItem = $noItem->count_item;
        }
    
        session()->put('cartItem', $cartItem);
    }
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function paymentPost(Request $request) {

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //     Stripe\Charge::create ([
        //             "amount" => $request->sub*100,
        //             "currency" => "MYR",
        //             "source" => $request->stripeToken,
        //             "description" => "This payment is testing purpose of southern online",
        //     ]);
            
            $newOrder=myOrder::Create([
                'orderDate'=>'null',
                'paymentStatus'=>'Done',
                'userID'=>'meow',
                'amount'=>$request->sub,
            ]);
            //get latest orderID just now created
            $orderID=DB::table('my_orders')->where('userID','=','meow')->orderBy('created_at','desc')->first();
            $items=$request->input('cid');
            foreach($items as $item=>$value) {
                $cart=myCart::find($value);
                $cart->orderID=$orderID->id;
                $cart->save();
            }
            (new CartController)->cartItem();
    
            // $email='D210061A@sc.edu.my';
            // Notification::route('mail', $email)->notify(new \App\Notifications\orderPaid($email));
            return back();
            return redirect()->route('myCheckOut');
    
        }

    public function showCheckout(){

        $myorders=DB::table('my_orders')
        ->leftjoin('my_carts', 'my_orders.id', '=', 'my_carts.orderID')
        ->leftjoin('food', 'food.id', '=', 'my_carts.foodID')
        ->select('my_carts.*','my_orders.*','food.*','my_carts.quantity as qty')
        ->where('my_orders.userID','=','meow')
        ->get();   
        return view('checkOut')->with('myorders',$myorders);
    }
    
    
    
}
