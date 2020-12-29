<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  
  use SoftDeletes;
   protected $fillable = ['name','brand_id','category_id','price','quantity','date'];
   public $timestamps = false;
   protected $dates = ['deleted_at'];
   public function order(){
   	return $this->belongsToMany('App\Order')->withPivot('quantity','productsTotal');
   }
}
