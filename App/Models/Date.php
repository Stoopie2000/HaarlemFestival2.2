<?php


namespace App\Models;


use Core\Model;
use DateTime;
use PDO;

class Date extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function get_by_ID($DateID)
    {
        $sql = 'SELECT Date FROM date WHERE DateID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$DateID]);
        return $date = $stmt->fetch();
    }

    public function get_all(){
        $sql = 'SELECT * FROM date';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $date = $stmt->fetchAll();
    }
}