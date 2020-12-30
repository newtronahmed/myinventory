<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;

class BrandsController extends Controller
{
    public function store (Request $request){

    	$validated = $request->validate([
    		'brandName'=>'required',
    	]);
    	$brand = new \App\Brand;
    	$brand->name = $validated['brandName'];
    	$brand->save();
    	 session()->flash('success','Brand has been created successfully');

    	return redirect('/');
    }
    public function edit(){
    	$categories = Category::all();
    	$brands = Brand::all();
    	return view('brand.edit',compact('categories','brands'));
    }
    public function update(Request $request ,Brand $brand){
    	$validated= $request->validate(['brandName'=>'required']);
    	$brand->name = $validated['brandName'];
    	$brand->save();
    	session()->flash('success','Brand updated successfully');
    	return redirect('/brand/manage');
    }
    public function delete(Brand $brand){
    	$brand->delete();
    	session()->flash('success','Brand has been deleted');
    	return redirect()->back();
    }
}
