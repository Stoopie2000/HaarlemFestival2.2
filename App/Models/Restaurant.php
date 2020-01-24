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
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '45.00',
            'ReducedPrice' => '22.50',
            'FirstSession' => '18:00:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/Mr. & Mrs..png',
        ],
        [
            'name' => 'Ratatouille',
            'Address' => 'Spaarne 96, 2011 CL',
            'Seats' => 52,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '45.00',
            'ReducedPrice' => '22.50',
            'FirstSession' => '17:00:00',
            'TotalSessions' => '3',
            'SessionDuration' => '2',
            'image'=> '/img/food/Ratatouille.png',
        ],
        [
            'name' => 'Restuarant ML',
            'Address' => 'Kleine Houtstraat 70, 2011 DR',
            'Seats' => 60,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '45.00',
            'ReducedPrice' => '22.50',
            'FirstSession' => '17:00:00',
            'TotalSessions' => '2',
            'SessionDuration' => '2',
            'image'=> '/img/food/Restaurant ML.jpg',
        ],
        [
            'name' => 'Restaurant Fris',
            'Address' => 'Twijnderslaan 7, 2012 BG',
            'Seats' => 45,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '45.00',
            'ReducedPrice' => '22.50',
            'FirstSession' => '17:30:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/Restaurant Fris.jpg',
        ],
        [
            'name' => 'Specktakel',
            'Address' => 'Spekstraat 4, 2011 HM',
            'Seats' => 36,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '35.00',
            'ReducedPrice' => '17.50',
            'FirstSession' => '17:00:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/Specktakel.jpg',
        ],
        [
            'name' => 'Grand Cafe Brinkman',
            'Address' => 'Grote Markt 13, 2011 RC',
            'Seats' => 100,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '35.00',
            'ReducedPrice' => '17.50',
            'FirstSession' => '16:30:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/Grand Cafe Brinkmann.png',
        ],
        [
            'name' => 'Urban Frenchy Bistro Toujours',
            'Address' => 'Oude Groendmarkt 10-12, 2011 HL',
            'Seats' => 48,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '35.00',
            'ReducedPrice' => '17.50',
            'FirstSession' => '17:30:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/Urban Frenchy Bistro Toujours.png',
        ],
        [
            'name' => 'The Golden Bull',
            'Address' => 'Zijlstraat 39, 2011 TK',
            'Seats' => 60,
            'CityAndCountry' => 'Haarlem, Nederland',
            'Price' => '35.00',
            'ReducedPrice' => '17.50',
            'FirstSession' => '17:30:00',
            'TotalSessions' => '3',
            'SessionDuration' => '1.5',
            'image'=> '/img/food/The Golden Bull.png',
        ],
    ];

//    public function __construct()
//    {
//        self::$restaurants = require_once('./../App/fixtures/restaurants.php');
//    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = "SELECT restaurants.*, group_concat(categories.name) as categories, images.url as image_url, images.description as image_description FROM restaurants
                LEFT JOIN restaurant_category ON restaurants.restaurantID = restaurant_category.restaurantID
                LEFT JOIN categories ON categories.categoryID = restaurant_category.categoryID
                LEFT JOIN images ON images.imageID = restaurants.imageID
                GROUP BY restaurants.restaurantID";

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

    public static function makeBasketItem($restaurantinfo)
    {
        $restaurants = self::getAll();
        $r = null;

        foreach ($restaurants as $restaurant) {
            if ($restaurant->RestaurantID == $restaurantinfo['restaurantID'])
            {
                $r = $restaurant;
                $basketItem = new BasketItem();
                $basketItem->Description = $restaurant->Name . " Ticket";
                $basketItem->Item = $restaurant->Name;
                $basketItem->Price = "10";
                return $basketItem;
                break;
            }
        }
        //TODO display error message if $r = null




    }

    public static function create(array $attributes = [])
    {
        $sql = "INSERT INTO `restaurants` (";
        foreach ($attributes as $key => $value) {
            if ($key === 'image') {
                $key = 'imageID';

                $imageSql = "INSERT INTO images (URL, Description, Namespace) VALUES ('" . $value . "', 'restaurant afbeelding', '')";
                self::execute_select_query($imageSql, PDO::FETCH_CLASS);

                $attributes['image'] = self::execute_select_query("SELECT imageID FROM images WHERE URL = '" . $value . "'", PDO::FETCH_CLASS)->fetch()->imageID;
            }

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
