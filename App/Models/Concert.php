<?php

namespace App\Models;
use Core\Model;
use PDO;

class Concert extends Model
{
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Get all the concerts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM concerts';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $users = $stmt->fetchAll();
    }

    public function getArtists(){

    }
}