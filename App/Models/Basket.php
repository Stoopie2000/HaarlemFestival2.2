<?php


namespace App\Models;


use Core\Model;

/**
 * Class Basket
 * @package App\Models
 * @property array items
 * @author Bram Bos <brambos27@gmail.com>
 */
class Basket extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function addItem($get)
    {
        $class = ucfirst($get['productType']);
        $class = "App\Models\\" . $class;
        if (class_exists($class)){
            $newItem = $class::makeBasketItem($get);

            if (isset($get['quantity'])){
                $newItem->Quantity = $get['quantity'];
            }else{
                $newItem->Quantity = 1;
            }

            if (!isset($this->items)){
                $this->items = [];
            }
            $matchedItem = false;
            foreach ($this->items as $item){
                if ($item->Item == $newItem->Item){
                   $matchedItem = true;
                   //TODO: Either increase quantity or display message saying the item is already in the shopping basket
                }
            }

            if (!$matchedItem){
                $newItem->ItemID = substr(md5(rand()), 0, 12);
                $this->items[] = $newItem;
            }

        }else{
            //TODO: 404 gooien ofzo idk. Nadenken
        }
    }

    public function removeItem($ItemID){
        foreach ($this->items as $key => $item){
            if ($item->ItemID == $ItemID){
                unset($this->items[$key]);
            }
        }
    }


}