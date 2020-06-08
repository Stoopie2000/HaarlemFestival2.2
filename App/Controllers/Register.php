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
        if (empty($_POST['g-recaptcha-response']) || !$this->verify_captcha($_POST['g-recaptcha-response'])) {
            Flash::addMessage("Captcha failed please try again", "warning");
            $this->redirect("/login/new");
        }

        if (User::find_by_email($_POST['Email'])){
            Flash::addMessage("Email Already Taken", 'warning');
        }else{
            $user = new User($_POST);
            $user = $user->register_user();
            $user->send_activation_email();
        }

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
