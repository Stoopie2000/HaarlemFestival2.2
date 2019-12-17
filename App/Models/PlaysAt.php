<?php


namespace App\Models;

use Core\Model;
use PDO;

/**
 * Class PlaysAt
 * @package App\Models
 * @author Bram Bos <brambos27@gmail.com>
 */
class PlaysAt extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM plays_at';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $playsAt = $stmt->fetchAll();
    }

    public static function get_from_concert_ID(int $ConcertID)
    {
        $sql = 'SELECT * FROM plays_at WHERE ConcertID = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS, [$ConcertID]);
        return $playsAt = $stmt->fetchAll();
    }
}
