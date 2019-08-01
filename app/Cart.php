<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart
{
	//
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $discount = 0;

    //khoi tao cart
    public function __construct($oldCart){
        //check neu $oldCart da ton tai
    	if($oldCart){
            //set san pham vao $oldCart
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    //Add to cart
    public function add($item, $id){
        //tao moi san pham voi cac dac diem
    	$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        //kiem tra da co san pham chua
    	if($this->items){

            //kiem tra da ton tai san pham voi id 
    		if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
    			$storedItem = $this->items[$id];
    		}
    	}

        //tang so luong len 1
    	$storedItem['qty']++;

        //sua lai gia tien
    	$storedItem['price'] = $item->price * $storedItem['qty'];

        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
    	$this->items[$id] = $storedItem;

        //sua lai tong so luong
    	$this->totalQty++;

        //sua lai tong gia
    	$this->totalPrice +=$item->price;
    }

    // Add 1
    public function addOne($item, $id){
        //tao moi san pham voi cac dac diem
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        //kiem tra da co san pham chua
        if($this->items){

            //kiem tra da ton tai san pham voi id 
            if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
                $storedItem = $this->items[$id];
            }
        }

        //tang so luong len 1
        $storedItem['qty']++;

        //sua lai gia tien
        $storedItem['price'] = $item->price * $storedItem['qty'];

        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
        $this->items[$id] = $storedItem;

        //sua lai tong so luong
        $this->totalQty++;

        //sua lai tong gia
        $this->totalPrice +=$item->price;
        
    }

    // Sub 1
    public function subOne($item, $id){
         //tao moi san pham voi cac dac diem
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        //kiem tra da co san pham chua
        if($this->items){

            //kiem tra da ton tai san pham voi id 
            if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
                $storedItem = $this->items[$id];
            }
        }

        //giam so luong di 1
        $storedItem['qty']--;

        //sua lai gia tien
        $storedItem['price'] = $item->price * $storedItem['qty'];

        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
        $this->items[$id] = $storedItem;

        //sua lai tong so luong
        $this->totalQty--;

        //sua lai tong gia
        $this->totalPrice -=$item->price;
    }
}