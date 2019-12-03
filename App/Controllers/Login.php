<?php


namespace App\Controllers;


use App\Models\Flash;
use App\Models\Logic\AuthLogic;
use App\Models\User;
use Core\Controller;
use Core\View;
use Model\LoginStatus;

class Login extends Controller
{
    public function newAction()
    {
        View::render('login/new.php');
    }

    public function createAction()
    {
        $user = new User();
        $remember = isset($_POST["keep_logged_in_checked"]);
        switch ($user->authenticate($_POST["email"], $_POST["password"])) {
            case LoginStatus::SUCCESS :
                AuthLogic::on_login($user->UserId, $_POST["email"], $remember);
                Flash::addMessage('Login successful');
                $this->redirect(AuthLogic::getReturnToPage());
                break;
            case LoginStatus::NO_USER :
                Flash::addMessage('Username or password incorrect', Flash::WARNING);
                View::render('Login/login.html', [
                    'remember_me' => $remember
                ]);
                break;
            case LoginStatus::WRONG_PASS :
                Flash::addMessage('Username or password incorrect', Flash::WARNING);

                View::render('Login/login.html', [
                    'email' => $_POST['email'],
                    'remember_me' => $remember
                ]);
                break;
        }
    }
}