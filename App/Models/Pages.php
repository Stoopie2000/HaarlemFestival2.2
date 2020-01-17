<?php


namespace App\Models;
use Core\Model;
use PDO;

class Pages extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function get_AllPages(){
        $sql = 'SELECT * FROM pages';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $events = $stmt->fetchAll();
    }

    public static function add_Page($name, $description, $background){
        $sql = 'INSERT INTO pages (Name, Description, Background) VALUES (?, ?, ?)';
        self::execute_edit_query($sql, [$name, $description, $background]);
    }
}