<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Models\JazzArtist;
use App\Models\AllAccessJazz;

class Jazz extends \Core\Controller
{

    /**
     * Show default jazz page
     */
    
    public function thursdayAction()
    {
        View::render('Jazz/Thursday.php', [
            'jazzArtists' => JazzArtist::getAllArtists(),
            'allAccessJazz' => AllAccessJazz::getAllAccessJazz()
        ]);
    }

    public function fridayAction()
    {
        View::render('Jazz/Friday.php', [
            'jazzArtists' => JazzArtist::getAllArtists(),
            'allAccessJazz' => AllAccessJazz::getAllAccessJazz()
        ]);
    }

    public function saturdayAction()
    {
        View::render('Jazz/Saturday.php', [
            'jazzArtists' => JazzArtist::getAllArtists(),
            'allAccessJazz' => AllAccessJazz::getAllAccessJazz()
        ]);
    }
}