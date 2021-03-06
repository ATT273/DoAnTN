<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";

    public function product_type(){
    	return $this->belongsTo('App\ProductType','type_id','id');
    }
    public function bill(){
        return $this->belongsToMany('App\User','bill_detail');
    }
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','product_id','id');
    }
    public function productimg(){
    	return $this->hasMany('App\ProductImage','product_id','id');
    }
    public function tag(){
        return $this->belongsToMany('App\Tag','product_tag');
    }
    public function comment(){
        return $this->hasMany('App\Comment','product_id','id');
    }
    public function wishlist(){
        return $this->hasMany('App\WishList','product_id','id');
    }
}
