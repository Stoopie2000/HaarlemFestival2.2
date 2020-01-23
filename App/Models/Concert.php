<?php

namespace App\Models;

use Core\Model;
use DateTime;
use PDO;

/**
 * @property DateTime Date
 * @property DateTime StartTime
 * @property DateTime EndTime
 * @property array Artists
 * @property int  ConcertID
 * @property Venue Venue
 * @property int DateID
 * @property string Event
 * @property int VenueID
 * @property float Price
 * @author Bram Bos <brambos27@gmail.com>
 */
class Concert extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->Date = Date::get_by_ID($this->DateID)->Date;
        $this->StartTime = date_create($this->StartTime);
        $this->EndTime = date_create($this->EndTime);

        $playsAt = PlaysAt::get_from_concert_ID($this->ConcertID);

        foreach ($playsAt as $item) {
            $this->Artists[] = Artist::get_by_ID($item->ArtistID);
        }

        $this->Venue = Venue::get_venue($this->VenueID);

        if (empty($this->Artists)){
            $this->Artists = [];
        }
    }

    /**
     * Get all the concerts as an associative array
     *
     * @param string $event
     * @return array $concerts
     */
    public static function get_all_by_event($event)
    {
        $sql = 'SELECT * FROM concerts where Event = ? order by DateID, StartTime ';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$event]);
        return $concerts = $stmt->fetchAll();
    }

    public static function find_for_location($locationID)
    {
        $sql = 'SELECT * FROM concerts WHERE VenueID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$locationID]);
        return $concerts = $stmt->fetchAll();
    }

    public static function get_for_artist($artistID)
    {
        $sql = "SELECT DateID, concerts.ConcertID, DateID, StartTime, EndTime, NumberOfTickets, Price, VenueID, Event FROM concerts INNER JOIN plays_at pa on concerts.ConcertID = pa.ConcertID WHERE pa.ArtistID = ?";
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$artistID]);
        return $concerts = $stmt->fetchAll();
    }

    public static function get_by_ID($concertID){
        $sql = 'SELECT * FROM concerts where ConcertID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$concertID]);
        return $concerts = $stmt->fetch();
    }

    public static function makeBasketItem($ticketInfo)
    {
        $concert = self::get_by_ID($ticketInfo['productID']);
        $basketItem = new BasketItem();
        $basketItem->Description = $concert->Venue->Name . " Ticket";
        $basketItem->Item = $concert;
        $basketItem->Price = $concert->Price;
        return $basketItem;
    }

    public static function edit_concert($concertid, $dateid, $starttime, $endtime, $price, $venueid, $event){
        $sql = 'UPDATE concerts SET DateID = ?, StartTime = ?, EndTime = ?, Price = ?, VenueID = ?, Event = ? WHERE ConcertID = ?';
        self::execute_edit_query($sql, [$dateid, $starttime, $endtime, $price, $venueid,  $event, $concertid]);
    }

    public function add_order_to_database($orderId, $userId, $paymentStatus, $quantity){
        $sql = "INSERT INTO orders_tickets(UserID, ConcertID, OrderDate, Status, OrderID, Quantity) VALUES (?,?, CURDATE(), ?,?,?)";
        $parameters = [$userId, $this->ConcertID ,$paymentStatus, $orderId, $quantity];

        return self::execute_edit_query($sql, $parameters);
    }
}
