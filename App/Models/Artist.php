<?php


namespace App\Models;
use Core\Model;
use PDO;

class Artist extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Get all the artists as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM artists';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $users = $stmt->fetchAll();
    }
}