<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store (Request $request){

    	$validated = $request->validate([
    		'categoryName'=>'required',
    	]);
    	$category = new \App\Category;
    	$category->categories = $validated['categoryName'];
    	$category->save();
    	return redirect('/');
    }
}
