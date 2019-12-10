<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Class Restaurant
 * @package App\Models
 */
class Restaurant extends Model
{
    /** @var array $restaurants */
    protected static $restaurants = [
        [
            'name' => 'Restaurant Mr. & Mrs',
            'Address' => 'Lange Veerstraat 4, 2011 DB',
            'Seats' => 40,
        ],
        [
            'name' => 'Ratatouille',
            'Address' => 'Spaarne 96, 2011 CL',
            'Seats' => 52,
        ],
        [
            'name' => 'Restuarant ML',
            'Address' => 'Kleine Houtstraat 70, 2011 DR',
            'Seats' => 60,
        ],
        [
            'name' => 'Restaurant Fris',
            'Address' => 'Twijnderslaan 7, 2012 BG',
            'Seats' => 45,
        ],
        [
            'name' => 'Specktakel',
            'Address' => 'Spekstraat 4, 2011 HM',
            'Seats' => 36,
        ],
        [
            'name' => 'Grand Cafe Brinkman',
            'Address' => 'Grote Markt 13, 2011 RC',
            'Seats' => 100,
        ],
        [
            'name' => 'Urban Frenchy Bistro Toujours',
            'Address' => 'Oude Groendmarkt 10-12, 2011 HL',
            'Seats' => 48,
        ],
        [
            'name' => 'The Golden Bull',
            'Address' => 'Zijlstraat 39, 2011 TK',
            'Seats' => 60,
        ],
    ];

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT * FROM restaurants';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);

        $results = $stmt->fetchAll();
        if (!count($results)) {
            foreach (self::$restaurants as $restaurant => $restaurantData) {
                self::create($restaurantData);
            }

            return self::getAll();
        }

        return $results;
    }

    public static function create(array $attributes = [])
    {
        $sql = "INSERT INTO `restaurants` (";
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
