<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = 
	[
		'hash_id','total','customer_name','paid','due','discount','subTotal','phone','address','payment_method' 
	];
    public function product(){
    	return $this->belongsToMany('\App\Product')->withPivot('quantity','productsTotal');
    }
}
