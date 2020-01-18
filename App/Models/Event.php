<?php


namespace App\Models;
use Core\Model;
use PDO;

class Event extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function get_AllEvents(){
        $sql = 'SELECT * FROM event';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $events = $stmt->fetchAll();
    }

    public static function get_AllArtistEvents(){
        
    }
}