<?php


namespace App\Models;

use Core\Model;
use PDO;

/**
 * Class Venue
 * @package App\Models
 * @author Bram Bos <brambos27@gmail.com>
 */
class Venue extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function get_all_by_event($event)
    {
        $sql = 'SELECT * FROM venue WHERE Event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$event]);
        return $users = $stmt->fetchAll();
    }

    public static function find_venue_by_name($venue, $event)
    {
        $sql = 'SELECT * FROM venue WHERE LOWER(Name) = LOWER(?) AND event = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$venue, $event]);
        return $venue = $stmt->fetch();
    }

    public static function get_venue($VenueID)
    {
        $sql = 'SELECT * FROM venue WHERE VenueID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$VenueID]);
        return $venue = $stmt->fetch();
    }
}
