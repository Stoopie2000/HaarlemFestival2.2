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
            'venues' => Venue::get_all_by_event('dance'),
            'concerts' => $concerts,
            'plays_at' => PlaysAt::get_all(),
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
        } else {
            header('HTTP/1.0 404 Not Found');
            exit;
        }
    }

    public function lineupAction()
    {
        $artist = Artist::find_by_name_and_event(str_replace('-', ' ', $this->route_params['artist']), 'dance');
        if ($artist) {
            $concertsArtistPlaysAt = $artist->get_concerts();
            View::render('Dance/lineup/detail.php', [
                'artist' => $artist,
                'concertsArtistPlaysAt' => $concertsArtistPlaysAt
            ]);
        } else {
            header('HTTP/1.0 404 Not Found');
            exit;
        }
    }

    public function searchAction()
    {
        $searchString = $_GET["q"];
        if (strlen($searchString) > 0) {
            $venues = Venue::get_all_by_event("dance");
            $artists = Artist::get_all_by_event("dance");
            $hint = "";
            foreach ($venues as $item){
                if (stristr($item->Name, $searchString)){
                    if ($hint == ""){
                        $hint = "<a href='dance/locations/" . strtolower(str_replace(' ', '-', $item->Name)) . "'> $item->Name </a></li>";
                    }else{
                        $hint .= "<br/><a href='dance/locations/" . strtolower(str_replace(' ', '-', $item->Name)) . "'> $item->Name </a></li>";
                    }
                }
            }
            foreach ($artists as $item){
                if (stristr($item->Name, $searchString)){
                    if ($hint == ""){
                        $hint = "<a href='dance/lineup/" . strtolower(str_replace(' ', '-', $item->UnAccentedName)) . "'> $item->Name </a></li>";
                    }else{
                        $hint .= "<br/><a href='dance/lineup/" . strtolower(str_replace(' ', '-', $item->UnAccentedName)) . "'> $item->Name </a></li>";
                    }
                }
            }

            // Set output to "no suggestion" if no hint was found
// or to the correct values
            if ($hint=="") {
                $response="no suggestion";
            } else {
                $response=$hint;
            }

//output the response
            echo $response;
        }
    }
}
