<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Models\Date;
use App\Models\JazzArtist;
use App\Models\AllAccessJazz;
use App\Models\Artist;

class Jazz extends Controller
{

    /**
     * Show default jazz page
     */

    public function ticketsAction()
    {
        $dates = Date::get_ALL();
        foreach($dates as $date){
            if(date_format($date->Date, "l") == ucfirst($this->route_params["day"])){
                $dayID = $date->DateID;
            }
        }
        View::render('Jazz/tickets.php', [
            'jazzArtists' => JazzArtist::getAllArtists($dayID),
            'allAccessJazz' => AllAccessJazz::get_all('jazz'),
            'dates' => $dates,
            'day' => ucfirst($this->route_params["day"])
        ]);
    }

    public function indexAction()
    {
        $dates = Date::get_ALL();
    
        View::render('Jazz/index.php', [
            'dates' => Date::get_ALL(),
            'jazzArtists' => JazzArtist::getLineUp()
        ]);
    }

    public function artistAction()
    {
        $artistName = $this->route_params["artist"];
        $replaceCharacters = array("-" => " ", "and" => "&");
        $artistName = strtolower(str_replace(array_keys($replaceCharacters), array_values($replaceCharacters), $artistName));

        $artist = Artist::find_by_name_and_event($artistName, 'jazz');
        $concertsArtist = $artist->get_concerts();

        view::render('Jazz/artist/artist.php', [
            'artist' => $artist,
            'concertsArtist' => $concertsArtist,
            'dates' => Date::get_ALL()
        ]);
    }
}