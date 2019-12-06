<?php


namespace App\Controllers;


use App\Models\Artist;
use App\Models\Concert;
use App\Models\PlaysAt;
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
            'venues' => Venue::getAll(),
            'concerts' => Concert::getAll(),
            'plays_at' => PlaysAt::getAll()
        ]);
    }

    public function locationsAction(){
        $location = Venue::find_venue_by_name($this->route_params['location']);
        $concerts = Concert::find_for_location($location->VenueID);
        if ($location){
            View::render('Dance/locations/detail.php', [
                'venue' => $location,
                'concerts' => $concerts
            ]);
        }
    }
}