<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Category;
use App\Brand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profile = auth()->user()->profile;
        $categories = Category::all();
        $brands = Brand::all();
        return view('home',compact('profile','categories','brands'));
    }
    public function edit(){
        $profile = auth()->user()->profile;
        return view('profile.edit',compact('profile'));
    }
    public function update(Request $request){
       $validated = $request->validate([
            'image'=>'image',
            'description'=>'max:255|nullable',
            'title'=>'required',
        ]);
       if($request->hasFile('image')){
        // get filename with extensions
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // get filename
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        // GET extension 
        $extension = $request->file('image')->getClientOriginalExtension();
        // filename to store
        $filenameToStore = $filename.time().'.'.$extension;
        // get Image path
        $path = $request->file('image')->storeAs('public/profileImages',$filenameToStore);


       } 
           $profile =auth()->user()->profile;
           
           $profile ->description = $validated['description'] ;
           $profile ->title = $validated['title'] ;
           if($request->hasFile('image')){
            $profile ->image = $filenameToStore;
            // $profile->save();
           }
           $profile->save();
       // auth()->user()->profile()->update([
       //  'image'=> $filenameToStore ?? '',
       //  'description'=>$validated['description'],
       //  'title'=>$validated['title'],
       // ]);

        return redirect('/')->with(['status'=>'successfully updated my bros']);
    }


}
