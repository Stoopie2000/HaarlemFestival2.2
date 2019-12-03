<?php


namespace App\Models;


use Core\Model;
use Model\LoginStatus;

class User extends Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function authenticate($email, $password)
    {
        $this->find_by_email($email);

        if ($this->UserId){
            if (password_verify($password, $this->PasswordHash)){
                unset($stmt);
                return LoginStatus::SUCCESS;
            }else{
                unset($stmt);
                return LoginStatus::WRONG_PASS;
            }
        }
        unset($stmt);
        return LoginStatus::NO_USER;
    }

    public static function store_token_for_user($username, $token)
    {
        //TODO Kijken of het beter is om iedere user 1 Token te geven en niet eleke keer een nieuwe te maken.
        $sql = 'INSERT INTO user_tokens(UserName, UserTokenHash) VALUES (?, ?)';
        $parameters = [$username, $token];
        self::execute_edit_query($sql, $parameters);
    }

    public function find_by_email($email)
    {
        $sql = 'SELECT * FROM users WHERE Email = ?'; //TODO Bepaal of ik wel alles uit de users tabel wil halen (*)
        $stmt = self::execute_select_query($sql, [$email]);
        if ($user = $stmt->fetch())
        $this->__construct($user);
    }

    //TODO Kijken hoe ik dit kan gebruiken
//    public function profileLink()
//    {
//        return sprintf('<a href="/profile/%s">%s</a>',$this->id,$this->username);
//    }

}