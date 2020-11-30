<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

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
        return view('home',compact('profile'));
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
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // get Image path
        $path = $request->file('image')->storeAs('public/profile_images',$filenameToStore);


       } 
           $profile =auth()->user()->profile;
           
           $profile ->description = $validated['description'] ;
           $profile ->title = $validated['title'] ;
           if($request->hasFile('image')){
            $profile ->image = $filenameToStore;
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
