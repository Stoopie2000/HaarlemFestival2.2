<?php


namespace App\Controllers;

use App\Models\Flash;
use App\Models\AuthLogic;
use App\Models\User;
use Core\Controller;
use Core\View;
use Exception;

class Login extends Controller
{
    /**
     * @throws Exception
     */
    public function newAction()
    {
        View::render('login/new.php');
    }

    /**
     * @throws Exception
     */
    public function createAction()
    {
        $user = User::authenticate($_POST["email"], $_POST["password"]);

        $remember = isset($_POST["remember_me"]);

        if ($user) {
            AuthLogic::on_login($user, $remember);

            Flash::addMessage('Login successful');

            $this->redirect(AuthLogic::getReturnToPage());
        } else {
            Flash::addMessage('Username or password incorrect', Flash::WARNING);
            View::render('Login/new.php', [
                    'email' => $_POST['email'],
                    'remember_me' => $remember
                ]);
        }
    }
}
