<?php


namespace App\Controllers;


use App\Models\Basket;
use Core\Controller;
use Core\View;

/**
 * Class Order
 * @package App\Controllers
 * @author Bram Bos <brambos27@gmail.com>
 */
class Order extends Controller
{
    public function addItemsAction(){
        unset($_GET['order/addItems']);
        var_dump($_GET);

        if(!isset($_SESSION))
        {session_start();}

        if (!isset($_SESSION['basket'])){
           $basket = new Basket();
           $basket->addItem($_GET);
           $_SESSION['basket'] = $basket;
        }else{
           $basket = $_SESSION['basket'];
           $basket->addItem($_GET);
        }

        //TODO: Return to origin page
    }

    public function removeItemsAction(){
        unset($_GET['order/addItems']);

        if(!isset($_SESSION))
        {session_start();}

        $basket = $_SESSION['basket'];

        $basket->removeItem($_GET['itemID']);
    }

    public function basketAction(){
        if(!isset($_SESSION))
        {session_start();}

        View::render('Basket/basket.php', [
            'basket' => $_SESSION['basket']
        ]);
    }
}