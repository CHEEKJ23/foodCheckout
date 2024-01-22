<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use DB;
use Session;

class FoodController extends Controller
{
    public function searchProduct() {
        $r=request();
        $keyword=$r->keyword;
        $product=DB::table('foods')->where('name','like','%'.$keyword.'%')->get();
        return view('showFood')->with('foods',$food);
    }    

    public function add(){ 
        $r=request();

        if($r->file('image')!=''){
            $image=$r->file('image');  //get uploaded file from HTML      
            $image->move('images',$image->getClientOriginalName());  //image copy to folder under public/images
            $imageName=$image->getClientOriginalName(); //get uploaded image file name
        }
    
        else{
            $imageName="empty.jpg";//default image
        }
    
        $addFood=Food::create([
            'name'=>$r->name,
            'description'=>$r->description,
            'price'=>$r->price,
            'image'=>$imageName,
            'category'=>$r->category,
        ]);
    
        Session::flash('success',"Added successfully!");
        return redirect()->route('viewFood');
    }

    public function view() {
        $viewAll=Food::all();
        return view('viewFood')->with('foods',$viewAll);
    }

    public function delete($id) {
        $deleteFood=Food::find($id);
        $deleteFood->delete();
        return redirect()->route('viewFood');
    }

    public function deleteSelectedFoods(Request $request){
        $selectedFoods = $request->input('selectedFoods');

        if (!empty($selectedFoods)) {
            // Delete selected foods
            Food::whereIn('id', $selectedFoods)->delete();
            return redirect()->route('viewFood')->with('success', 'Selected foods deleted successfully.');
        }

        return redirect()->route('viewFood')->with('error', 'No foods selected for deletion.');
    }

    public function selectAllFoods(){
        $foods = Food::all();
        return view('viewFood', compact('foods'));
    }

    public function edit($id) {
        $foods=Food::all()->where('id',$id);
        return view('edit')->with('foods',$foods);
    }

    public function update(){
        $r=request();
        $foods =Food::find($r->foodID);   
        if($r->file('image')!=''){
            $image=$r->file('image');        
            $image->move('images',$image->getClientOriginalName());                   
            $imageName=$image->getClientOriginalName(); 
            $foods->image=$imageName;
        }         
        $foods->name=$r->foodName;
        $foods->description=$r->description;
        $foods->price=$r->price;
        $foods->category=$r->category;
        $foods->save();
        return redirect()->route('viewFood');
    }


    public function show() {
        $viewAll=Food::all();
        (new CartController)->cartItem();
        return view('showFood')->with('foods',$viewAll);
    }

    

}
