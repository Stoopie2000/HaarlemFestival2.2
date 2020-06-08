<?php


namespace App\Controllers;

use App\Models\AuthLogic;
use App\Models\User;
use App\Models\UserModel;
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
//        $user = User::find_by_email($_POST['Email']);
//        if ($user){
//            Flash::addMessage("Email Already Taken", 'warning');
//        }else{
//            $user = new User([$_POST['Email'], $_POST['Password'], $_POST['Name']]);
//            if ($user->register_user()) {
//                $user->send_activation_email();
//                $user = User::authenticate($_POST["Email"], $_POST["Password"]);
//                AuthLogic::on_login($user, false);
//
//                $this->redirect($this->get_return_to_page());
//            }
//        }
//
//        View::render('/Register/new.php', [
//            'user' => $user
//        ]);

        if (empty($_POST['g-recaptcha-response']) || !$this->verify_captcha($_POST['g-recaptcha-response'])) {
            Flash::addMessage("Captcha failed please try again", "warning");
            $this->redirect("/login/new");
        }

        $user = new User($_POST);
        $user = $user->register_user();
        $user->send_activation_email();

        if (empty($user->errors)) {
            Flash::addMessage("Successfully registered");

            $this->redirect('/register/success');
        } else {
            foreach ($user->errors as $error){
                Flash::addMessage($error, "warning");
            }

            $this->redirect("/login/new");
        }
    }

    public function successAction(){
        $this->redirect('/login/new');
    }
}
