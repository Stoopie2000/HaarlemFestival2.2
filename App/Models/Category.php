<?php

namespace App\Models;

use Core\Model;
use PDO;

class Category extends Model
{
    /** @var array $restaurants */
    protected static $categories = [
        [
            'name' => 'Dutch'
        ],
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM categories';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);

        $results = $stmt->fetchAll();
        if (!count($results)) {
            foreach (self::$categories as $categoryData) {
                self::create($categoryData);
            }

            return self::getAll();
        }

        return $results;
    }

    public static function create(array $attributes = [])
    {
        $sql = "INSERT INTO `categories` (";
        foreach ($attributes as $key => $value) {
            $sql .= '`' . $key . '`, ';
        }

        $sql = rtrim($sql, ', ') . ') VALUES (';

        foreach ($attributes as $key => $value) {
            $sql .= "'" . $value . "',";
        }

        $sql = rtrim($sql, ',') . ');';

        return self::execute_select_query($sql, PDO::FETCH_CLASS);
    }
}
