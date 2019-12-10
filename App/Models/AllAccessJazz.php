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

    
    public static function getAllAccessJazz()
    {
    $sql = "SELECT * FROM day_tickets WHERE day_tickets.Type LIKE 'Jazz'";

    $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
    return $users = $stmt->fetchAll();
    }
    
}
 