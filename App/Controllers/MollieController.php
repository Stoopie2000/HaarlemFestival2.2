<?php


namespace App\Controllers;


use App\Models\webhook;
use Core\Controller;
use Core\View;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\PaymentMethod;

class MollieController extends Controller
{

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

                $payment = $mollie->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => number_format($paymentAmount, 2)
                    ],
                    "description" => implode(', ', $descriptionArray),
                    "redirectUrl" => "http://hfteam6.infhaarlem.nl/order/return?order_id={$orderId}",
                    "webhookUrl" => "http://hfteam6.infhaarlem.nl/mollie/webhook",
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

            $tickets = $webhook->get_tickets_by_order_id($orderId);
            foreach ($tickets as $ticket){
                foreach ($ticket->Artists as $artist) {
                    $ticketArtists[] = $artist->Name;
                }
                $concertArtistsNames = implode(", ", $ticketArtists);
                $descriptionArray[] = date_format($ticket->Date, 'l d F') . " " . $concertArtistsNames . " at " . $ticket->Venue->Name;
            }

            $webhook->send_tickets($orderId, implode(', ', $descriptionArray));

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
}