<?php


namespace App\Controllers;

use App\Models\AuthLogic;
use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Class Register
 * @package App\Controllers
 * @author Bram Bos <brambos27@gmail.com>
 */
class Register extends Controller
{
    public function newAction()
    {
        View::render('Register/new.php');
    }

    public function createAction()
    {
        $user = new User($_POST);

        if ($user->register_user()) {
            $user->send_activation_email();
            $user = User::authenticate($_POST["Email"], $_POST["Password"]);
            AuthLogic::on_login($user, false);

            $this->redirect($this->get_return_to_page());
        } else {
            View::render('/Register/new.php', [
                'user' => $user
            ]);
        }
    }

    public function successAction(){

    }
}
