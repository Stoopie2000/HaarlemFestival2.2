<?php


namespace App\Models;


use Core\Model;
use DateTime;
use PDO;

/**
 * Class Date
 * @package App\Models
 * @author Bram Bos <brambos27@gmail.com>
 */
class Date extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->Date =date_create($this->Date);
    }

    public static function get_by_ID($DateID)
    {
        $sql = 'SELECT Date FROM date WHERE DateID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$DateID]);
        return $date = $stmt->fetch();
    }

    public static function get_all(){
        $sql = 'SELECT * FROM date';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $date = $stmt->fetchAll();
    }
}