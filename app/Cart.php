<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Cart
{
	//
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $discountAmount = 0;
    public $totalAfterDiscount = 0;
    public $promoCode = 0;

    //khoi tao cart
    public function __construct($oldCart){
        //check neu $oldCart da ton tai
    	if($oldCart){
            //set san pham vao $oldCart
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
            $this->discountAmount = $oldCart->discountAmount;
            $this->totalAfterDiscount = $oldCart->totalAfterDiscount;
            $this->promoCode = $oldCart->promoCode;
    	}
    }

    //Add to cart
    public function add($item, $id){
        //tao moi san pham voi cac dac diem
        if ($item->promo_price != 0) {
            $storedItem = ['qty' => 0, 'price' => $item->promo_price, 'item' => $item];
        } else {
            $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }
        //kiem tra da co san pham chua
    	if($this->items){
            //kiem tra da ton tai san pham voi id 
    		if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
    			$storedItem = $this->items[$id];
            }
    	}

        $storedItem['qty']++;

        //sua lai gia tien
        if ($item->promo_price != 0) {
           $storedItem['price'] = $item->promo_price * $storedItem['qty'];
        } else {
            $storedItem['price'] = $item->price * $storedItem['qty'];
        }
        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
        $this->items[$id] = $storedItem;

        //sua lai tong so luong
        $this->totalQty++;

        //sua lai tong gia
        if ($item->promo_price != 0) {
           $this->totalPrice +=$item->promo_price;
        } else {
            $this->totalPrice +=$item->price;
        }
        // dd($this->items);
    }

    // Add 1
    public function addOne($item, $id){
        //tao moi san pham voi cac dac diem
        if ($item->promo_price != 0) {
            $storedItem = ['qty' => 0, 'price' => $item->promo_price, 'item' => $item];
        } else {
            $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }
        //kiem tra da co san pham chua
        if($this->items){
            //kiem tra da ton tai san pham voi id 
            if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;

        //sua lai gia tien
        if ($item->promo_price != 0) {
           $storedItem['price'] = $item->promo_price * $storedItem['qty'];
        } else {
            $storedItem['price'] = $item->price * $storedItem['qty'];
        }
        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
        $this->items[$id] = $storedItem;

        //sua lai tong so luong
        $this->totalQty++;

        //sua lai tong gia
        if ($item->promo_price != 0) {
           $this->totalPrice +=$item->promo_price;
        } else {
            $this->totalPrice +=$item->price;
        }
        // dd($this->items);
    }

    // Sub 1
    public function subOne($item, $id){
         //tao moi san pham voi cac dac diem
        if ($item->promo_price != 0) {
            $storedItem = ['qty' => 0, 'price' => $item->promo_price, 'item' => $item];
        } else {
            $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        }

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
        if ($item->promo_price != 0) {
           $storedItem['price'] = $item->promo_price * $storedItem['qty'];
        } else {
            $storedItem['price'] = $item->price * $storedItem['qty'];
        }

        //set san pham da co bang san pham moi (da tang so luong len 1 va doi gia)
        $this->items[$id] = $storedItem;

        //sua lai tong so luong
        $this->totalQty--;

        //sua lai tong gia
        if ($item->promo_price != 0) {
           $this->totalPrice -=$item->promo_price;
        } else {
            $this->totalPrice -=$item->price;
        }
    }
    // delete item
    public function delete($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    // apply promo code
    public function applyPromoCode($discountAmount,$totalAfterDiscount){
        $this->discountAmount = $discountAmount;
        $this->totalAfterDiscount = $totalAfterDiscount;
        $this->promoCode = 1;
    }
}