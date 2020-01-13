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
    }

    /**
     * Get all the concerts as an associative array
     *
     * @param string $event
     * @return array $concerts
     */
    public static function get_all_by_event($event)
    {
        $sql = 'SELECT * FROM concerts where Event = ?';
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
}
