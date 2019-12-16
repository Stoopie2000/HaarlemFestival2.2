<?php


namespace App\Models;

use Core\Model;
use PDO;

class Venue extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM venue WHERE Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, ['dance']);
        return $users = $stmt->fetchAll();
    }

    public static function find_venue_by_name($venue)
    {
        $sql = 'SELECT * FROM venue WHERE LOWER(Name) = LOWER(?) AND event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$venue, 'dance']);
        return $venue = $stmt->fetch();
    }

    public static function get_venue($VenueID)
    {
        $sql = 'SELECT * FROM venue WHERE VenueID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$VenueID]);
        return $venue = $stmt->fetch();
    }
}
