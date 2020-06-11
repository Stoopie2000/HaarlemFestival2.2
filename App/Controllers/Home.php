<?php

namespace App\Controllers;

use Core\Controller;
use \Core\View;
use App\Models\Event;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends Controller
{

    /**
     * Show the index page
     *
     *
     */
    public function indexAction()
    {
        View::render('Home/index.php' ,[
            'events' => Event::get_AllEvents(),
            'home' => Event::get_Event('Home')
        ]);
    }
}
