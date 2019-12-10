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

    public static function getArtistsThursday()
    {
        $sql  = 'SELECT artists.Name, concerts.Price, concerts.StartTime, concerts.NumberOfTickets FROM `plays_at` 
        INNER JOIN artists ON plays_at.ArtistID=artists.ArtistID 
        INNER JOIN concerts ON plays_at.ConcertID=concerts.ConcertID 
        WHERE concerts.DateID = 1';

        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $users = $stmt->fetchAll();
    }
}