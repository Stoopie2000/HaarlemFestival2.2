<?php


namespace App\Models;
use Core\Model;
use PDO;

class AllAccessJazz extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function get_all($Type)
    {
        $sql = 'SELECT * 
        FROM day_tickets
        WHERE Type = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$Type]);
        return $dayTickets = $stmt->fetchAll();
    }
    
}


 