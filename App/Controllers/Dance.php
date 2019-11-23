<?php


namespace App\Controllers;


use Core\Controller;
use Core\View;

class Dance extends Controller
{
    /**
     * Show the index page
     *
     *
     */
    public function indexAction()
    {
        View::render('Dance/index.php');
    }
}