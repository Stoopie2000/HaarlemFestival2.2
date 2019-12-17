<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Models\Date;
use App\Models\JazzArtist;
use App\Models\AllAccessJazz;

class Jazz extends \Core\Controller
{

    /**
     * Show default jazz page
     */
    
    

    public function indexAction()
    {
        print_r($this->route_params);
        $dates = Date::get_ALL();
        foreach($dates as $date){
            if(date_format($date->Date, "l") == ucfirst($this->route_params["day"])){
                $dayID = $date->DateID;
            }
        }
        View::render('Jazz/index.php', [
            'jazzArtists' => JazzArtist::getAllArtists($dayID),
            'allAccessJazz' => AllAccessJazz::getAllAccessJazz(),
            'dates' => Date::get_ALL(),
            'day' => ucfirst($this->route_params["day"])
        ]);
    }
}