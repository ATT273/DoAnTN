<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
     protected $table = 'category';

    public function product_type(){
    	return $this->hasMany('App\ProductType','category_id','id');
    }

    public function product(){
    	return $this->hasManyThrough('App\Product','App\ProductType','category_id','type_id',
    		'id');
    	
    }
}
