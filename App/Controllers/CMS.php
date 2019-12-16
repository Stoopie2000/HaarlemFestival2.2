<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use Core\Router;
use \Core\View;

// Verander de 'Template' met de naam van je eigen controller
class CMS extends \Core\Controller
{

    /**
     * Voor iedere Action maak je hier een niewe methode aan.
     */
    
    // Dit is de Action 'index', de naam van deze methode is dus de naam van je Action met 'Action' erachter.
    public function LoginAction() {
        print_r($this->route_params);


        //$data =[

        //];

        // Wat je mee geeft met deze methode is de Path naar de view 'index', de Path is vanuit de Views map.
        View::render('CMS/login.php', [
        'params' => $this->route_params
        ]);
    }

    public function EventsAction(){
        print_r($this->route_params);
        $concerts = Concert::getAll($this->route_params["event"]);

        
        // Wat je mee geeft met deze methode is de Path naar de view 'index', de Path is vanuit de Views map.
        View::render('CMS/events.php', [
            'params' => $this->route_params,
            'concerts' => $concerts
        ]);
    }

    public function ArtistsAction(){
        print_r($this->route_params);

        View::render('CMS/artists.php', [
            'params' => $this->route_params,
            'artists' => Artist::getAll()
        ]);
    }
    
}
