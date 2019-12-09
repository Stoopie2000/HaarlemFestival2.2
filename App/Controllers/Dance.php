<?php


namespace App\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\DayTicket;
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

    public function locationsAction()
    {
        $location = Venue::find_venue_by_name(str_replace('-', ' ', $this->route_params['location']));


        if ($location) {
            $concertsAtLocation = Concert::find_for_location($location->VenueID);
            $concerts = Concert::getAll();

            View::render('Dance/locations/detail.php', [
                'venue' => $location,
                'concerts' => $concerts,
                'concertsAtLocation' => $concertsAtLocation,
                'dayTickets' => DayTicket::get_all()
            ]);
        }
    }

    public function lineupAction()
    {
        $artist = Artist::find_by_name(str_replace('-', ' ', $this->route_params['artist']));

        if ($artist){
            $artist->Concerts = $artist->get_concerts();
            View::render('Dance/lineup/detail.php', [
                'artist' => $artist
            ]);
        }
    }
}
