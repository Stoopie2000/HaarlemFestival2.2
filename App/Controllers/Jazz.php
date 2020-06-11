<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Models\Date;
use App\Models\JazzArtist;
use App\Models\AllAccessJazz;
use App\Models\Artist;
use App\Models\Event;

class Jazz extends Controller
{

    /**
     * Show default jazz page
     */

    public function ticketsAction()
    {
        $dayID = NULL;
        $dates = Date::get_ALL();
        foreach($dates as $date){
            if(date_format($date->Date, "l") == ucfirst($this->route_params["day"])){
                $dayID = $date->DateID;
            }
        }

        if($dayID){
            View::render('Jazz/tickets.php', [
                'jazzArtists' => JazzArtist::getAllArtists($dayID),
                'allAccessJazz' => AllAccessJazz::get_all('jazz'),
                'dates' => $dates,
                'day' => ucfirst($this->route_params["day"]),
                'event' => Event::get_Event('Jazz')
            ]);
        }
        else{
            view::render('404.html');
        }
    }

    public function indexAction()
    {
        $dates = Date::get_ALL();
    
        View::render('Jazz/index.php', [
            'dates' => Date::get_ALL(),
            'jazzArtists' => JazzArtist::getLineUp(),
            'event' => Event::get_Event('Jazz')
        ]);
    }

    public function artistAction()
    {
        $artistName = $this->route_params["artist"];
        $replaceCharacters = array("-" => " ", "and" => "&");
        $artistName = strtolower(str_replace(array_keys($replaceCharacters), array_values($replaceCharacters), $artistName));

        $artist = Artist::find_by_name_and_event($artistName, 'jazz');

        if($artist){
            $concertsArtist = $artist->get_concerts();

        view::render('Jazz/artist/artist.php', [
            'artist' => $artist,
            'concertsArtist' => $concertsArtist,
            'dates' => Date::get_ALL(),
            'event' => Event::get_Event('Jazz')
        ]);
        }
        else{
            view::render('404.html');
        }
        
    }
}