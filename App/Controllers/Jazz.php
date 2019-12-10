<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Models\JazzArtist;

class Jazz extends \Core\Controller
{

    /**
     * Show default jazz page
     */
    
    public function indexAction()
    {
        View::render('Jazz/Jazz.php', [
            'jazzArtists' => JazzArtist::getArtistsThursday()
        ]);
    }
    
}