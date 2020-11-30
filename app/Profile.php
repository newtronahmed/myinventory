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
    	$imagePath = $this->image ? $this->image :'noImage_1601509481.png';
    	return '/storage/profile_images/'.$imagePath;
    }
}
