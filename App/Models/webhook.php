<?php
namespace App\Models;

use Core\Controller;
use Mollie\Api\MollieApiClient;
use Core\Model;
use PDO;

class webhook extends Model{

    public static function get_payment_status($order_id)
    {
        $sql = "SELECT Status FROM orders_tickets WHERE OrderID = ?";
        $parameters = [$order_id];
        $stmt = self::execute_select_query($sql, PDO::FETCH_ASSOC, $parameters);
        return $stmt->fetch();
    }

    public function updateStatus($paymentId){
        $mollie = new MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");

        $payment = $mollie->payments->get($paymentId);
        $orderId = $payment->metadata->order_id;
        /*
         * Update the order in the database.
         */
        $sql = "UPDATE orders_tickets SET Status = ? WHERE OrderID = ?";
        $parameters = [$payment->status, $orderId];
        self::execute_edit_query($sql, $parameters);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            /*
             * The payment is paid and isn't refunded or charged back.
             * At this point you'd probably want to start the process of delivering the product to the customer.
             */
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

