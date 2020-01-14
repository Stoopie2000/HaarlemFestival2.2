<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\User;
use App\Models\AuthLogic;
use App\Models\Flash;
use \Core\View;

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
        $user = User::authenticate($_POST["email"], $_POST["password"]);
        $remember = isset($_POST["remember_me"]);

        if ($user) {
            AuthLogic::on_login($user, $remember);

            Flash::addMessage('Login successful');

            $this->redirect(AuthLogic::getReturnToPage());
        } else {
            Flash::addMessage('Username or password incorrect', Flash::WARNING);
            View::render('CMS/login.php', [
                    'params' => $this->route_params,
                    'email' => $_POST['email'],
                    'remember_me' => $remember
                ]);
        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        } else {
            View::render('CMS/register.php', [
                'params' => $this->route_params
                ]);
        }
    }

    public function eventsAction(){
        var_dump(isset($_SESSION));
        print_r($this->route_params);
        if ($this->route_params["event"] == 'jazz') {
            $this->route_params["event"] = ucfirst($this->route_params["event"]);
        }
        $concerts = Concert::getAll($this->route_params["event"]);

        
        // Wat je mee geeft met deze methode is de Path naar de view 'index', de Path is vanuit de Views map.
        View::render('CMS/events.php', [
            'params' => $this->route_params,
            'concerts' => $concerts
        ]);
    }

    public function ArtistsAction(){
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
    
}
