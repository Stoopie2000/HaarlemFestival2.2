<?php


namespace App\Controllers;

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
        View::render('register/new.php');
    }

    public function createAction()
    {
        $user = new User($_POST);

        if ($user->register_user()) {
            $user->send_activation_email();
            $this->redirect('/register/success');
        } else {
            View::render('register/new.php', [
                'user' => $user
            ]);
        }
    }
}
