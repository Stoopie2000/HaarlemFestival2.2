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
        }
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

            if (isset($get['DateSelection'])){
                $newItem->DateSelection = $get['DateSelection'];
            }else{
                $newItem->DateSelection = null;
            }

            if (isset($get['TimeSelection'])){
                $newItem->TimeSelection = $get['TimeSelection'];
            }else{
                $newItem->TimeSelection = null;
            }

            if (isset($get['Comments'])){
                $newItem->Extra = $get['Comments'];
            }else{
                $newItem->Extra = null;
            }

            if (!isset($this->items)){
                $this->items = [];
            }
            $matchedItem = false;
            foreach ($this->items as $item){
                if ($item->Item == $newItem->Item && $item->Extra == $newItem->Extra){
                   $matchedItem = true;
                   $item->Quantity++;
                }
            }

            if (!$matchedItem){
                $newItem->ItemID = substr(md5(rand()), 0, 12);
                $this->items[] = $newItem;
            }else{

            }

        }else{
            header('HTTP/1.0 404 Not Found');
            exit;
        }
    }

    public function removeItem($ItemID){
        foreach ($this->items as $key => $item){
            if ($item->ItemID == $ItemID){
                unset($this->items[$key]);
            }
        }
    }

    public function add_order_to_database(){

    }


}