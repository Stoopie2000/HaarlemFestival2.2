<?php


namespace App\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\DayTicket;
use App\Models\PlaysAt;
use App\Models\Venue;
use Core\Controller;
use Core\View;

/**
 * Class Dance
 * @package App\Controllers
 * @author Bram Bos <brambos27@gmail.com>
 */
class Dance extends Controller
{
    /**
     * Show the index page for Haarlem dance
     *
     */
    public function indexAction()
    {
        $concerts = Concert::get_all_by_event('dance');

        $firstDay = $concerts[0]->Date;
        $lastDay = end($concerts)->Date;



        View::render('Dance/index.php', [
            'artists' => Artist::get_all_by_event('dance'),
            'venues' => Venue::getAll('dance'),
            'concerts' => $concerts,
            'plays_at' => PlaysAt::getAll(),
            'firstDay' => $firstDay,
            'finalDay' => $lastDay
        ]);
    }

    public function locationsAction()
    {
        $location = Venue::find_venue_by_name(str_replace('-', ' ', $this->route_params['location']), 'dance');

        if ($location) {
            $concertsAtLocation = Concert::find_for_location($location->VenueID);
            $concerts = Concert::get_all_by_event('dance');
            $dayTickets = DayTicket::get_all('dance');

            View::render('Dance/locations/detail.php', [
                'venue' => $location,
                'concerts' => $concerts,
                'concertsAtLocation' => $concertsAtLocation,
                'dayTickets' => $dayTickets
            ]);
        }
    }

    public function lineupAction()
    {
        $artist = Artist::find_by_name_and_event(str_replace('-', ' ', $this->route_params['artist']), 'dance');
        $concertsArtistPlaysAt = $artist->get_concerts();
        if ($artist){
            View::render('Dance/lineup/detail.php', [
                'artist' => $artist,
                'concertsArtistPlaysAt' => $concertsArtistPlaysAt
            ]);
        }
        else {
            //TODO 404
        }
    }
}
