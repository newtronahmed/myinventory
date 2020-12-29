<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;

class ItemsController extends Controller
{
    public function index (){

    	return response()->json('you hav hit the products controller');
    }
    public function store(Request $request){
        $date = Carbon::parse($request->date);

       // dd($request);
    	$validated = $request->validate([
    		    'name' =>'required',
    			'category_id'=> 'required',
    			'brand_id'=> 'required',
    			'price'=>'required',
    			'quantity'=>'required',
    			'date'=>''	,
    	]);
        
        $product = new Item;
        $product-> name = $validated['name'];
        $product-> category_id = $validated['category_id'];
        $product-> price = $validated['price'];
        $product-> quantity = $validated['quantity'];
        $product-> brand_id = $validated['brand_id'];
        $product-> date = $date;
        $product->save();
        dd($product);
    		// Product::create([
      //           'name'=>$validated['name'],
      //           'category_id'=>$validated['category_id'],
      //           'brand_id'=>$validated['brand_id'],
      //           'price'=>$validated['price'],
      //           'quantity'=>$validated['quantity'],
      //           'date'=>$date,
      //       ]);
    		// return redirect()->back();
        return redirect('/')->with('success','yeaahh');
    }
}
