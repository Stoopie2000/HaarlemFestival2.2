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
        return $stmt->fetch()['Status'];
    }

    public function updateStatus($payment, $orderId){
        /*
         * Update the order in the database.
         */
        $sql = "UPDATE orders_tickets SET Status = ? WHERE OrderID = ?";
        $parameters = [$payment->status, $orderId];
        self::execute_edit_query($sql, $parameters);
    }

    public function send_tickets($recipient_address, $subject, $message){
        self::send_mail($recipient_address, $subject, $message);
    }

    public static function get_user_email_by_order_id($orderId)
    {
        $sql = "SELECT Email FROM users JOIN orders_tickets ot on users.UserID = ot.UserID WHERE OrderID = ?";
        $stmt = self::execute_select_query($sql, PDO::FETCH_ASSOC, [$orderId]);
        return $email = $stmt->fetch()['Email'];
    }

    public static function get_tickets_by_order_id($orderId){
        $sql = "SELECT ConcertID FROM orders_tickets WHERE OrderID = ?";
        $stmt = self::execute_select_query($sql, PDO::FETCH_ASSOC, [$orderId]);
        $concertIds = $stmt->fetchAll();
        $concerts = [];

        foreach ($concertIds as $concertId){
            $concerts[] = Concert::get_by_ID($concertId['ConcertID']);
        }
        return $tickets = $concerts;
    }
}

