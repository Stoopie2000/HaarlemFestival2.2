<?php


namespace App\Controllers;


use App\Models\Artist;
use App\Models\Venue;
use Core\Controller;
use Core\View;

class Dance extends Controller
{
    /**
     * Show the index page for Haarlem dance
     *
     *
     */
    public function indexAction()
    {
        View::render('Dance/index.php', [
            'artists' => Artist::getAll(),
            'venues' => Venue::getAll()
        ]);
    }
}