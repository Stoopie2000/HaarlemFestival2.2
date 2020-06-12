<?php


namespace App\Controllers;

use App\Models\Flash;
use App\Models\AuthLogic;
use App\Models\User;
use Core\Controller;
use Core\View;
use Exception;

/**
 * Class Login
 * @package App\Controllers
 * @author Bram Bos <brambos27@gmail.com>
 */
class Login extends Controller
{
    /**
     * @throws Exception
     */
    public function newAction()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['email'])){
            $email = "";
        }else{
            $email = $_SESSION['email'];
        }

        View::render('Login/new.php' , [
            'email' => $email,
            'remember_me' => isset($_SESSION['remember_me'])
        ]);
    }

    /**
     * @throws Exception
     */
    public function createAction()
    {
        if (!isset($_POST["Email"])){
            $this->redirect("/login/new");
        }
        if (!isset($_SESSION)) {
            session_start();
        }

        if ($user = User::authenticate($_POST["Email"], $_POST["Password"])) {
            AuthLogic::on_login($user, isset($_POST["Remember_me"]));

            Flash::addMessage('Login successful');
            $this->redirect(AuthLogic::getReturnToPage());
        } else {
            Flash::addMessage('Username or password incorrect', Flash::WARNING);

            $_SESSION['email'] = $_POST["Email"];
            $_SESSION['remember_me'] = isset($_POST["Remember_me"]);
            $this->redirect("/login/new");
        }
    }

    public function logoutAction(){
        AuthLogic::logout();
        $this->redirect("/");
    }
}
