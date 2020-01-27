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
        View::render('Login/new.php');
    }

    /**
     * @throws Exception
     */
    public function createAction()
    {
        $user = User::authenticate($_POST["Email"], $_POST["Password"]);
        $remember = isset($_POST["Remember_me"]);

        if ($user) {
            AuthLogic::on_login($user, $remember);

            Flash::addMessage('Login successful');

            $this->redirect(AuthLogic::getReturnToPage());
        } else {
            Flash::addMessage('Username or password incorrect', Flash::WARNING);
            View::render('Login/new.php', [
                    'email' => $_POST['Email'],
                    'remember_me' => $remember
                ]);
        }
    }
}
