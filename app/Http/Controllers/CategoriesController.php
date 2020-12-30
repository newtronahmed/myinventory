<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
class CategoriesController extends Controller
{
    public function store (Request $request){
// dd($request);
    	$validated = $request->validate([
    		'categoryName'=>'required',
    	]);
    	$category = new Category;
    	$category->categories = $validated['categoryName'];
    	$category->save();
    	session()->flash('success','category has been created successfully');
    	return redirect('/');
    }
    public function edit(){
    	$categories = Category::all();
    	$brands = Brand::all();
    	return view('categories.edit',compact('categories','brands'));
    }
    public function update(Request $request ,Category $category){
    	$validated= $request->validate(['categoryName'=>'required']);
    	$category->categories = $validated['categoryName'];
    	$category->save();
    	session()->flash('success','category updated successfully');
    	return redirect('/category/manage');
    }
    public function delete(Category $category){
            $category->delete();
            session()->flash('category has been deleted');
            return redirect()->back();
    }
}
