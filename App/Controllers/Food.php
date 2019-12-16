<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Core\Controller;
use \Core\View;

class Food extends Controller
{
    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $restaurants = Restaurant::getAll();
        $categories = Category::getAll();
        $restaurant_category = RestaurantCategory::getAll();

        View::render('Food/Food.php', compact('restaurants', 'categories', 'restaurant_category'));
    }
}
