<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compare
{
	//
    public $items;
   
    //khoi tao danh sach
    public function __construct($oldList){
        //check neu $oldList da ton tai
    	if($oldList){
            //set san pham vao $oldList
    		$this->items = $oldList->items;
    	}
    }

    //Add to list
    public function add($item, $id){
        //tao moi san pham voi cac dac diem
    	$comparedItem = ['name' => $item->name, 'price' => $item->price, 'item' => $item];

        //kiem tra da co san pham chua
    	if($this->items){

            //kiem tra da ton tai san pham voi id 
    		if(array_key_exists($id, $this->items)){
                //neu co -> set san pham moi bang san pham da co san
    			$comparedItem = $this->items[$id];
    		}
    	}

    	$this->items[$id] = $comparedItem;

    }

    public function delete($id){
    	unset($this->items[$id]);
    }
    

}