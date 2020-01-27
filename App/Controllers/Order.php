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

        View::render('Order/precheckout.php');
    }

    public function checkoutAction(){
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
                $paymentAmount += ($item->Price * $item->Quantity);

                if ($item->Quantity > 1){
                    $descriptionArray[] = $item->Description . " x " . $item->Quantity;
                }else{
                    $descriptionArray[] = $item->Description;
                }
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

            $paymentId = $payment->id;
            foreach ($_SESSION['basket']->items as $basketItem) {
                $basketItem->Item->add_order_to_database($orderId, $_SESSION['user_id'], $payment->status, $basketItem->Quantity);
            }


            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        }
        }catch (ApiException $e){
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function returnAction(){
        View::render('Order/redirect.php', [
            'paymentStatus' => webhook::get_payment_status($_GET['order_id']),
            'orderid' => $_GET['order_id']
        ]);
    }

    public function webhookAction(){
        $mollie = new MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");

        $payment = $mollie->payments->get($_POST["id"]);
        $orderId = $payment->metadata->order_id;

        $webhook = new webhook();
        $webhook->updateStatus($payment, $orderId);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            /*
             * The payment is paid and isn't refunded or charged back.
             * At this point you'd probably want to start the process of delivering the product to the customer.
             */

            $recipient_address = $webhook->get_user_email_by_order_id($orderId);
            $tickets = $webhook->get_tickets_by_order_id($orderId);
            foreach ($tickets as $ticket){
                foreach ($ticket->Artists as $artist) {
                    $ticketArtists[] = $artist->Name;
                }
                $concertArtistsNames = implode(", ", $ticketArtists);
                $descriptionArray[] = date_format($ticket->Date, 'l d F') . " " . $concertArtistsNames . " at " . $ticket->Venue->Name;
            }
            $ticketDescription = implode(', ', $descriptionArray);

            $message = "Here are you tickets for " . $ticketDescription;
            $subject = $message;
            $webhook->send_tickets($recipient_address, $subject, $message);

        } elseif ($payment->isOpen()) {
            /*
             * The payment is open.
             */
        } elseif ($payment->isPending()) {
            /*
             * The payment is pending.
             */
        } elseif ($payment->isFailed()) {
            /*
             * The payment has failed.
             */
        } elseif ($payment->isExpired()) {
            /*
             * The payment is expired.
             */
        } elseif ($payment->isCanceled()) {
            /*
             * The payment has been canceled.
             */
        } elseif ($payment->hasRefunds()) {
            /*
             * The payment has been (partially) refunded.
             * The status of the payment is still "paid"
             */
        } elseif ($payment->hasChargebacks()) {
            /*
             * The payment has been (partially) charged back.
             * The status of the payment is still "paid"
             */
        }
    }

    public function updateQuantity(){
        if (!isset($_SESSION)) {
            session_start();
        }

        $itemId = $_POST['item_id'];
        $newQuantity = $_POST['new_quantity'];

        foreach ($_SESSION['basket']->items as $basketItem){
            if ($basketItem->ItemID == $itemId){
                $basketItem->Quantity = $newQuantity;
            }
        }
    }
}