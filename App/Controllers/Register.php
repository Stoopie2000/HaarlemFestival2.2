<?php


namespace App\Controllers;

use App\Models\AuthLogic;
use App\Models\Flash;
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
        $user = User::find_by_email($_POST['Email']);
        if ($user){
            Flash::addMessage("Email Already Taken", 'warning');
        }else{
            $user = new User([$_POST['Email'], $_POST['Password'], $_POST['Name']]);
            if ($user->register_user()) {
                $user->send_activation_email();
                $user = User::authenticate($_POST["Email"], $_POST["Password"]);
                AuthLogic::on_login($user, false);

                $this->redirect($this->get_return_to_page());
            }
        }

        View::render('/Register/new.php', [
            'user' => $user
        ]);
    }

    public function successAction(){
        //TODO
    }
}
