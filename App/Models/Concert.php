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
 * @property  int DateID
 */
class Concert extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->Date = Date::get_by_ID($this->DateID)->Date;
        $this->Date = DateTime::createFromFormat('Y-m-d', $this->Date)->format('l d F');
        $this->StartTime = DateTime::createFromFormat('G:i:s', $this->StartTime)->format('G:i');
        $this->EndTime = DateTime::createFromFormat('G:i:s', $this->EndTime)->format('G:i');

        $playsAt = PlaysAt::get_from_concert_ID($this->ConcertID);

        foreach ($playsAt as $item) {
            $this->Artists[] = Artist::get_from_ID($item->ArtistID);
        }

        $this->Venue = Venue::get_venue($this->VenueID);
    }

    /**
     * Get all the concerts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM concerts where Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, ['dance']);
        return $concerts = $stmt->fetchAll();
    }

    public static function find_for_location($locationID)
    {
        $sql = 'SELECT * FROM concerts WHERE VenueID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$locationID]);
        return $concerts = $stmt->fetchAll();
    }

    public static function get_for_artist(int $ArtistID)
    {
        $sql = "SELECT * FROM concerts INNER JOIN plays_at pa on concerts.ConcertID = pa.ConcertID WHERE pa.ArtistID = ?";
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$ArtistID]);
        return $concerts = $stmt->fetchAll();
    }

    public function getArtists()
    {
    }
}
