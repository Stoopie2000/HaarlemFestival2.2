<?php


namespace App\Models;
use Core\Model;
use PDO;

class JazzArtist extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function getAllArtists($ID)
    {
        $sql  = "SELECT artists.Name, concerts.ConcertID, concerts.Price, concerts.StartTime, concerts.NumberOfTickets, concerts.DateID, venue.Hall 
            FROM `plays_at` 
                INNER JOIN artists ON plays_at.ArtistID=artists.ArtistID 
                    INNER JOIN concerts ON plays_at.ConcertID=concerts.ConcertID
                        INNER JOIN venue ON concerts.VenueID=venue.VenueID
            WHERE artists.Event LIKE 'Jazz' AND concerts.DateID = ?
            ORDER BY concerts.ConcertID";

        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$ID]);
        return $jazzArtists = $stmt->fetchAll();
    }

    public static function getLineUp(){
        $sql = "SELECT *
        FROM `plays_at` 
            INNER JOIN artists ON plays_at.ArtistID=artists.ArtistID 
                INNER JOIN concerts ON plays_at.ConcertID=concerts.ConcertID
        WHERE artists.Event LIKE 'Jazz'
        ORDER BY concerts.DateID ASC, concerts.VenueID ASC, concerts.StartTime ASC";

        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $jazzArtists = $stmt->fetchAll();
    }
}