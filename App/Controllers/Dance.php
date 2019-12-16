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
        View::render('Dance/index.php', [
            'artists' => Artist::getAll('dance'),
            'venues' => Venue::getAll('dance'),
            'concerts' => Concert::getAll('dance'),
            'plays_at' => PlaysAt::getAll()
        ]);
    }

    public function locationsAction()
    {
        $location = Venue::find_venue_by_name(str_replace('-', ' ', $this->route_params['location']), 'dance');

        if ($location) {
            $concertsAtLocation = Concert::find_for_location($location->VenueID);
            $concerts = Concert::getAll('dance');
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
        $artist = Artist::find_by_name(str_replace('-', ' ', $this->route_params['artist']), 'dance');
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
