<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\User;
use App\Models\AuthLogic;
use App\Models\Date;
use App\Models\Flash;
use App\Models\PlaysAt;
use App\Models\Venue;
use \Core\View;
use DateTime;

// Verander de 'Template' met de naam van je eigen controller
class CMS extends \Core\Controller
{

    /**
     * Voor iedere Action maak je hier een niewe methode aan.
     */
    
    // Dit is de Action 'index', de naam van deze methode is dus de naam van je Action met 'Action' erachter.
    public function indexAction() {
        var_dump(isset($_SESSION));
        View::render('CMS/login.php', [
            'params' => $this->route_params
            ]);
    }

    public function loginAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = User::authenticate($_POST["email"], $_POST["password"]);
            $remember = isset($_POST["remember_me"]);

            if ($user) {
                AuthLogic::on_login($user, $remember);

                Flash::addMessage('Login successful');

                $this->redirect('/HF2.2/public/cms/events/jazz');
            } else {
                View::render('CMS/login.php', [
                    'params' => $this->route_params,
                    'email' => $_POST['email'],
                    'remember_me' => $remember
                ]);
            }
        } else {
            View::render('CMS/login.php', [
                'params' => $this->route_params
                ]);
        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pass_err = "";
            $confpass_err = "";
            $email_err = "";

            if ($_POST['email'] == "") {
                $email_err = "please fill in your email address";
            } else if(User::find_by_email($_POST['email'])){
                $email_err = "Email is already in use";
            }

            if ($_POST['password'] == "") {
                $pass_err = "please fill in your password";
            }

            if ($_POST['confpassword'] == "") {
                $confpass_err = "please confirm your password";
            }

            if ($_POST['password'] != $_POST['confpassword']) {
                $confpass_err = "password and confirm password are not the same";
            }

            if ($_POST['firstName'] != "" && $_POST['lastName'] != "" && $email_err == "" && $pass_err == "" && $confpass_err == "") {
                $Name = $_POST['firstName'] . " " . $_POST['lastName'];
                $user = new User([
                    'Name' => $Name,
                    'Email' => $_POST['email'],
                    'Password' => $_POST['password']
                ]);

                if ($user->register_user()) {
                    $this->redirect("/cms/login");
                } else {
                    View::render('CMS/register.php', [
                        'params' => $this->route_params,
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'email' => $_POST['email'],
                        'email_err' => $email_err,
                        'pass_err' => $pass_err,
                        'confpass_err' => $confpass_err,
                        'user_err' => $user->errors
                    ]);
                }
            } else {
                View::render('CMS/register.php', [
                    'params' => $this->route_params,
                    'firstName' => $_POST['firstName'],
                    'lastName' => $_POST['lastName'],
                    'email' => $_POST['email'],
                    'email_err' => $email_err,
                    'pass_err' => $pass_err,
                    'confpass_err' => $confpass_err
                ]);
            }

        } else{
            View::render('CMS/register.php', [
                'params' => $this->route_params
                ]);
        }
    }

    public function eventsAction(){
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["user_id"])) {
            $this->redirect('/cms');
        }

        $concerts = Concert::getAll($this->route_params["event"]);
        $days = Date::get_all();
        $artists = Artist::get_all_by_event($this->route_params["event"]);
        $locations = Venue::getAll($this->route_params["event"]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $playsat = PlaysAt::get_from_concert_ID($_POST["id"]);
            
            foreach ($days as $day) {
                if ($day->Day == explode(" ", $_POST["Date"])[0]) {
                    $dateID = $day->DateID;
                }
            }

            $newArtists = array();
            $newArtists[] = $this->getArtistID($_POST["Artist1"], $artists);
            if (isset($_POST["Artist2"])) {
                $newArtists[] = $this->getArtistID($_POST["Artist2"], $artists);
            } if (isset($_POST["Artist3"])) {
                $newArtists[] = $this->getArtistID($_POST["Artist3"], $artists);
            }

            for ($i=0; $i < count($playsat); $i++) { 
                for ($x=0; $x < count($newArtists); $x++) { 
                    if ($playsat[$i]->ArtistID == $newArtists[$x]) {
                        unset($playsat[$i]);
                        unset($newArtists[$x]);
                    }
                }
            }

            foreach ($playsat as $play) {
                PlaysAt::Delete($play->ConcertID, $play->ArtistID);
            }

            foreach ($newArtists as $artist) {
                if ($artist != null) {
                    PlaysAt::Add($_POST["id"], $artist);
                }
            }

            $StartTime = new DateTime($_POST["BeginTime"]);
            $EndTime = new DateTime($_POST["EndTime"]);
            $Price = (float)$_POST["Price"];
            $VenueID = $this->getVenueID($locations, $_POST["Location"]);

            Concert::edit_concert($_POST["id"], $dateID, $StartTime, $EndTime, $Price, $VenueID, $this->route_params["event"]);
            $locations[$_POST["id"]] = Concert::get_by_ID($_POST["id"]);

        }


        print_r($this->route_params);

        // Wat je mee geeft met deze methode is de Path naar de view 'index', de Path is vanuit de Views map.
        View::render('CMS/events.php', [
            'params' => $this->route_params,
            'concerts' => $concerts,
            'dates' => $days,
            'artists' => $artists,
            'locations' => $locations
        ]);
    }

    public function ArtistsAction(){
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["user_id"])) {
            $this->redirect('/cms');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;

            if (count($post) == 1) {
                Artist::delete_artist($post["id"]);
            }else{
                if ($post["description"] == "") {
                    $post["description"] = " ";
                }

                if ($post["id"] == "") {
                    Artist::add_artist($post["name"], $post["description"], $post["event"]);
                } else {
                    Artist::edit_artist($post["id"], $post["name"], $post["description"], $post["event"]);
                }
                print_r($post);
            }
        }

        View::render('CMS/artists.php', [
            'params' => $this->route_params,
            'artists' => Artist::get_all()
        ]);
    }

    private function getArtistID($name, $artists){
        foreach ($artists as $artist) {
            if ($artist->Name == $name) {
                return $artist->ArtistID;
            }
        }
    }

    private function getVenueID($locations, $Name){
        foreach ($locations as $location) {
            if ($location->Hall == $Name || $location->Name == $Name) {
                return $location->VenueID;
            }
        }
    }
}
