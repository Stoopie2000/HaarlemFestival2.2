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
        };
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM venue';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $users = $stmt->fetchAll();
    }

    public static function find_venue_by_name($venue){
        $sql = 'SELECT * FROM venue WHERE Name = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$venue]);
        return $venue = $stmt->fetch();
    }
}