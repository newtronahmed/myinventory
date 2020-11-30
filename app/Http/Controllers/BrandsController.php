<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function store (Request $request){

    	$validated = $request->validate([
    		'brandName'=>'required',
    	]);
    	$brand = new \App\Brand;
    	$brand->name = $validated['brandName'];
    	$brand->save();
    	return redirect('/');
    }
}
