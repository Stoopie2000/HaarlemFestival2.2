<?php


namespace App\Controllers;

use App\Models\Basket;
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

        View::render('Order/precheckout.php');
    }

    public function checkoutAction(){
        //TODO: Order opslaan in database
        try {
        /*
         * Initialize the Mollie API library with your API key.
         *
         * See: https://www.mollie.com/dashboard/developers/api-keys
         */
            $mollie = new MollieApiClient();
            $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
            if (!isset($_SESSION)) {
                session_start();
            }

        if (empty($_SESSION['basket'])){
            echo "Nothing to checkout";
        }else {
            $paymentAmount = 0;
            $descriptionArray = [];
            $orderId = substr(md5(rand()), 0, 12);

            foreach ($_SESSION['basket']->items as $item) {
                $paymentAmount += $item->Price;
                $descriptionArray[] = $item->Description;
            }
            $description = implode(', ', $descriptionArray);
            $paymentAmount = number_format($paymentAmount, 2);

            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$paymentAmount"
                ],
                "description" => $description,
                "redirectUrl" => "http://hfteam6.infhaarlem.nl/order/return?order_id={$orderId}",
                "webhookUrl" => "http://hfteam6.infhaarlem.nl/order/webhook",
                "method" => PaymentMethod::IDEAL,
                "metadata" => ['order_id' => $orderId]
            ]);

            foreach ($_SESSION['basket']->items as $basketItem) {
                $basketItem->Item->add_order_to_database($orderId, $_SESSION['user_id'], $payment->status);
            }


            header("Location: " . $payment->getCheckoutUrl(), true, 303);
            //TODO Goede redirect pagina maken voor na order
        }
        }catch (ApiException $e){
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function returnAction(){
        View::render('Order/redirect.php');
    }
}