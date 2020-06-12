<?php


namespace App\Controllers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\webhook;
use Core\Controller;
use Core\View;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\PaymentMethod;

/**
 * Class Order
 * @package App\Controllers
 * @author Bram Bos <brambos27@gmail.com>
 */
class Order extends Controller
{
    public function addItemsAction(){
        unset($_GET['order/addItems']);

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
        $this->redirect($this->get_return_to_page());
    }

    public function removeItemsAction(){
        unset($_GET['order/addItems']);

        if(!isset($_SESSION))
        {session_start();}

        $basket = $_SESSION['basket'];

        $basket->removeItem($_GET['itemID']);

        $this->redirect($this->get_return_to_page());
    }

    public function basketAction(){
        if(!isset($_SESSION))
        {session_start();}

        if (empty($_SESSION['basket'])){
            $basket = "";
        }else{
            $basket = $_SESSION['basket'];
        }

        View::render('Order/basket.php', [
            'basket' => $basket
        ]);
    }

    public function precheckoutAction(){
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            $_SESSION['return_to'] = $_SERVER['REDIRECT_URL'];
            $this->redirect('/login/new');
        }

        if (empty($_SESSION['basket'])){
            $basket = "";
        }else{
            $basket = $_SESSION['basket'];
        }

        View::render('Order/precheckout.php', [
            'basket' => $basket
        ]);
    }

    public function updateQuantity(){
        if (!isset($_SESSION)) {
            session_start();
        }
        $itemId = $_POST['item_id'];
        $newQuantity = $_POST['new_quantity'];

        if ($newQuantity < 0){
            http_response_code(400);
            exit();
        }
        foreach ($_SESSION['basket']->items as $basketItem){
            if ($basketItem->ItemID == $itemId){
                $basketItem->Quantity = $newQuantity;
            }
        }
    }
}