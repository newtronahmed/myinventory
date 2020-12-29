<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable =['title','description','image'];
    public function user(){
    	return $this->belongsTo('\App\User');
    }
    public function profileImage(){
    	$imagePath = $this->image ? $this->image :'reactlaravel_1608421945.jpeg';
    	// $imagePath =  '/storage/profile_images/'.$imagePath;
    	// dd($imagePath);
    	// dd(asset('/storage/profile_images/noImage_1601421724.png'));
    	return '/storage/profileImages/'.$imagePath;
    }
}
