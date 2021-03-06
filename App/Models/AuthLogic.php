<?php


namespace App\Models;

use App\Config;
use App\Token;

/**
 * Class AuthLogic
 * @package App\Models
 * @author Bram Bos <brambos27@gmail.com>
 */
class AuthLogic
{

    /**
     * Store user_id in session and if $remember is true store a remember_me token in database and set a remember cookie
     *
     * @param User $user
     * @param bool $remember
     *
     * @return void
     */
    public static function on_login($user, $remember)
    {
        $_SESSION["user_id"] = $user->UserID;

        if ($remember) {
            $token = new Token();
            $cookie = $user->Email . ':' . $token->getValue();
            $mac = hash_hmac('sha256', $cookie, Config::SECRET_KEY);
            $cookie .= ':' . $mac;
            $user->store_token($token->getValue());

            setcookie('rememberme', $cookie, time()+60*60*24*365, '/');
        }
    }

    public static function logout(){
        unset($_SESSION["user_id"]);
        if (isset($_COOKIE['rememberme'])) {
            unset($_COOKIE['rememberme']);
            setcookie('rememberme', '', time() - 3600, '/');
        }
    }

    /**
     * Get the originally-requested page to return to after requiring login, or default to the homepage
     *
     * @return string
     */
    public static function getReturnToPage()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['return_to'])) {
            return $_SESSION['return_to'];
        } else {
            return '/';
        }
    }
}
