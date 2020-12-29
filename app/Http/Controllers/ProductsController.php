<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use Carbon\Carbon;

class ProductsController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
    public function index (){
      $products=Product::where('quantity','>',0)->get();
    	return response()->json($products);
    }
    public function store(Request $request){

        // dd('helo');
    	$validated = $request->validate([
    		  'name' =>'required',
    			'category_id'=> 'required',
    			'brand_id'=> 'required',
    			'price'=>'required',
    			'quantity'=>'required',
    			'date'=>''	,
    	]);
        
        $product = new Product;
        $product-> name = $validated['name'];
        $product-> category_id = $validated['category_id'];
        $product-> price = $validated['price'];
        $product-> quantity = $validated['quantity'];
        $product-> brand_id = $validated['brand_id'];
        $product-> date = $validated['date'];
        $product->save();
              session()->flash('success','product has been successfullly added');

        return redirect('/');
    }
    public function show ($id){
      // return 'hello';
      $product = Product::find($id);
      return $product->toJson();
    }
      public function edit(){
        $products = Product::all();
        $categories = Category::all();
          $brands = Brand::all();
          
        return view('product.manage',compact('categories','brands','products'));
        
      }
      public function update(Product $product){
        $date = Carbon::parse(request('date'));
        $validated = request()->validate([
          'name' =>'required',
          'category_id'=> 'required',
          'brand_id'=> 'required',
          'price'=>'required',
          'quantity'=>'required',
          'date'=>''  ,
      ]);

        $product-> name = $validated['name'];
        $product-> category_id = $validated['category_id'];
        $product-> price = $validated['price'];
        $product-> quantity = $validated['quantity'];
        $product-> brand_id = $validated['brand_id'];
        $product-> date = $date; 
        $product->save();
         session()->flash('success','product information been successfullly updated');
        return redirect()->back(); 
        }
        public function trash (Product $product){
          $product->delete();
           session()->flash('success','product has been moved to trash');
          return redirect()->route('products.manage');
        }
    }
