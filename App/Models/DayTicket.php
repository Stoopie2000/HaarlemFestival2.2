<?php


namespace App\Models;

use Core\Model;
use DateTime;
use PDO;

/**
 * @property array Days
 * @property int DateID
 * @property int DayTicketID
 * @property float Price
 * @author Bram Bos <brambos27@gmail.com>
 */
class DayTicket extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        if (isset($this->DateID)){
            $this->Days[] = date_create(Date::get_by_ID($this->DateID)->Date);
        }else{
            $for = $this->get_days();
            foreach ($for as $day){
                $this->Days[] = date_create(Date::get_by_ID($day['DateID'])->Date);
            }
            unset($this->DateID);
        }

        //unset($this->DateID);
    }

    public static function get_all($Type)
    {
        $sql = 'SELECT * FROM day_tickets WHERE Type = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$Type]);
        return $dayTickets = $stmt->fetchAll();
    }

    private function get_days()
    {
        $sql = 'SELECT DateID FROM `for` where DayTicketID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_ASSOC, [$this->DayTicketID]);
        return $dates = $stmt->fetchAll();
    }

    private static function get_by_ID($dayTicketID){
        $sql = 'SELECT * FROM day_tickets where DayTicketID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$dayTicketID]);
        return $dayTicket = $stmt->fetch();
    }

    public static function makeBasketItem($ticketInfo)
    {
        $dayTicket = self::get_by_ID($ticketInfo['productID']);
        $basketItem = new BasketItem();
        $basketItem->Description = $dayTicket->Name . " " . $dayTicket->Type;
        $basketItem->Item = $dayTicket;
        $basketItem->Quantity = $ticketInfo['quantity'];
        $basketItem->Price = $dayTicket->Price;
        return $basketItem;
    }
}
