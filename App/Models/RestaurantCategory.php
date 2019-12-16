<?php

namespace App\Models;

use Core\Model;
use PDO;

class RestaurantCategory extends Model
{
    /** @var array $restaurant_category */
    protected static $restaurant_category = [
        [
            'RestaurantID' => '1',
            'CategoryID' => '1'
        ],
        [
            'RestaurantID' => '1',
            'CategoryID' => '6'
        ],
        [
            'RestaurantID' => '1',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '2',
            'CategoryID' => '2'
        ],
        [
            'RestaurantID' => '2',
            'CategoryID' => '6'
        ],
        [
            'RestaurantID' => '2',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '3',
            'CategoryID' => '1'
        ],
        [
            'RestaurantID' => '3',
            'CategoryID' => '6'
        ],
        [
            'RestaurantID' => '3',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '4',
            'CategoryID' => '1'
        ],
        [
            'RestaurantID' => '4',
            'CategoryID' => '2'
        ],
        [
            'RestaurantID' => '4',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '5',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '5',
            'CategoryID' => '5'
        ],
        [
            'RestaurantID' => '5',
            'CategoryID' => '4'
        ],
        [
            'RestaurantID' => '6',
            'CategoryID' => '1'
        ],
        [
            'RestaurantID' => '6',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '6',
            'CategoryID' => '9'
        ],
        [
            'RestaurantID' => '7',
            'CategoryID' => '1'
        ],
        [
            'RestaurantID' => '7',
            'CategoryID' => '6'
        ],
        [
            'RestaurantID' => '7',
            'CategoryID' => '3'
        ],
        [
            'RestaurantID' => '8',
            'CategoryID' => '7'
        ],
        [
            'RestaurantID' => '8',
            'CategoryID' => '8'
        ],
        [
            'RestaurantID' => '8',
            'CategoryID' => '3'
        ],
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM restaurant_category';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);

        $results = $stmt->fetchAll();
        if (!count($results)) {
            foreach (self::$restaurant_category as $restaurant_categoryData) {
                self::create($restaurant_categoryData);
            }

            return self::getAll();
        }

        return $results;
    }

    public static function create(array $attributes = [])
    {
        $sql = "INSERT INTO `restaurant_category` (";
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
