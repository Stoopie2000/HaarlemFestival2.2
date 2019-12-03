<?php


namespace App\Models\Logic;


use App\Config;
use App\Models\User;
use App\Token;

class AuthLogic
{

    /**
     * Store user_id in session and if $remember is true store a remember_me token in database and set a remember cookie
     *
     * @param $userId
     * @param $email
     * @param $remember
     *
     * @return void
     */
    public static function on_login($userId, $email, $remember)
    {
        if(!isset($_SESSION))
            session_start();
        $_SESSION["user_id"] = $userId;

        if ($remember){
            $token = new Token();
            $cookie = $email . ':' . $token->getValue();
            $mac = hash_hmac('sha256', $cookie, Config::SECRET_KEY);
            $cookie .= ':' . $mac;
            User::store_token_for_user($email, $token->getValue());

            setcookie('rememberme', $cookie, time()+60*60*24*365, '/');
        }
    }

    /**
     * Get the originally-requested page to return to after requiring login, or default to the homepage
     *
     * @return string
     */
    public static function getReturnToPage()
    {
        //return $_SESSION['return_to'] ?? '/';
        if(isset($_SESSION['return_to']))
            return $_SESSION['return_to'];
        else
            return '/';
    }
}