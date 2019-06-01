<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table = "type_product";

    public function product(){
    	return $this->hasMany('App\Product','type_id','id');
    }

    public function category(){
    	return $this->belongsTo('App\Category','category_id','id');
    }
}
