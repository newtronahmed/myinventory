<?php

namespace App\Http\Controllers;
use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Order;
use PDF;
use Illuminate\Support\Facades\Hash;
class OrdersController extends Controller
{
    public function create(){
    	$categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
    	return view('create',compact('categories','brands','products'));
    }

    public function store (Request $request){

    	// return $request;
    	// return $quantity;
    	// $products = $request->products;
    	$validated = $request -> validate([
    		'customerName' => 'required',
    		'paid'=>'required',
    		'due'=>'required',
    		'netTotal'=>'required',
            'subtotal'=>'required',
    		'discount'=>'',
            'payment_method'=>'required',
            'address'=>'',
            'phone'=>'required',
    		// 'products'=>'required',
    	]);
    	$order =Order::create([
    		'customer_name' => $validated['customerName'],
    		'paid'=>$validated['paid'],
    		'due'=>$validated['due'],
    		'total'=>$validated['netTotal'],
    		'hash_id'=>Str::random(30),
    		'discount'=>$validated['discount'],
            'subTotal'=>$validated['subtotal'],
            'phone'=>$validated['phone'],
            'address'=>$validated['address'],
            'payment_method'=>$validated['payment_method'],
    	]);
    	$prod = [];
    	$quantity = [];

    	foreach ($request->products as  $product) {
    		$prod[] = $product['item'];
    		$quantity[] = $product['quantity'];
            $productsTotal[]=$product['total'];
    		$Product=Product::find($product['item']);
    		$Product->quantity -= $product['quantity'];
    		$Product->save();
    	}
    	$data=[];
    	for ($i=0;$i<count($prod);$i++){
    		$data[$prod[$i]]= ['quantity'=>$quantity[$i],'productsTotal'=>$productsTotal[$i]];
    	}
    	$order->product()->sync($data);
    	// return redirect()->route('home');

    	return response()->json(['message'=>$order->hash_id,'order'=>$order],200);
    }
    public function show ($hash_id){
    	$data = Order::where('hash_id',$hash_id)->first();
    	// dd($data);
    	return view('download.downloadPDF')->with('data',$data);
    }
    public function createPDF($hash_id){
    	$data = Order::where('hash_id',$hash_id)->first();
    	view()->share('data',$data);
    	$pdf = PDF::loadView('download.PDF');
    	return $pdf->download('order-success.pdf');
    }
}