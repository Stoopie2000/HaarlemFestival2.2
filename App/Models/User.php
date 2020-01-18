<?php


namespace App\Models;

use Core\Model;
use PDO;

/**
 * @property int UserID
 * @property string PasswordHash
 * @property string Email
 * @property string Type
 * @property string Name
 * @property string FirstName
 * @property string LastName
 * @property string Password
 * @author Bram Bos <brambos27@gmail.com>
 */
class User extends Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Authenticate user by email and Password.
     *
     * @param string $email
     * @param string $password
     * @return mixed User object if successful or false if email and Password don't match
     */
    public static function authenticate($email, $password)
    {
        $user = self::find_by_email($email);
        if ($user){
            if (password_verify($password, $user->PasswordHash)){
                return $user;
            }
        }
        return false;
    }

    /**
     * Updates user table with $token
     * @param int $token
     */
    public function store_token($token)
    {
        //TODO: Function store_token
//        $sql = 'UPDATE users SET UserTokenHash = ? WHERE UserID = ?';
//        $parameters = [$token, $this->UserID];
//        self::execute_edit_query($sql, $parameters);
    }

    /**
     * @param string $email
     * @return mixed User model if successful, FALSE if unsuccessful
     */
    public static function find_by_email($email)
    {
        $sql = 'SELECT * FROM users WHERE Email = ?'; //TODO Bepaal of ik wel alles uit de users tabel wil halen (*)
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS ,[$email]);
        return $stmt->fetch();
    }

    public static function get_All_Users()
    {
        $sql = 'SELECT UserID, Email, Type, FirstName, LastName FROM users'; //TODO Bepaal of ik wel alles uit de users tabel wil halen (*)
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS);
        return $stmt->fetchAll();
    }

    public static function edit_User($Type, $id){
        $sql = 'UPDATE users SET Type = ? WHERE UserID = ?';
        self::execute_edit_query($sql, [$Type, $id]);
    }
    
    public static function delete_User($id){
        $sql = 'DELETE FROM users WHERE UserID = ?';
        self::execute_edit_query($sql, [$id]);
    }

    //TODO Kijken hoe ik dit kan gebruiken
//    public function profileLink()
//    {
//        return sprintf('<a href="/profile/%s">%s</a>',$this->id,$this->username);
//    }

    /**
     * If properties are valid stores user model in database
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function register_user()
    {
        $this->validate();

        if (empty($this->errors)){
            $fullNameArray = $this->split_name(trim($this->Name));
            $firstName = $fullNameArray[0];
            $lastName = $fullNameArray[1];

            $password_hash = password_hash($this->Password, PASSWORD_DEFAULT);
            //TODO Activation Token

            if (empty($this->Type)){
                $this->Type = 'customer';
            }

            //TODO UserTokenHash

            $sql = 'INSERT INTO users (Email, Type, PasswordHash, FirstName, LastName) VALUES (?, ?, ?, ?, ?)';
            $parameters = [$this->Email, $this->Type, $password_hash, $firstName, $lastName];

            return self::execute_edit_query($sql, $parameters);
        }

        return false;
    }

    /**
     * @param string $name Full name
     * @return array An array with the first name at index 0 and last name at index 1
     */
    private function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }

    /**
     * Validate property values, adding error messages to the errors array property
     * @return void
     */
    private function validate()
    {
        if (strlen($this->Password) < 6)
            $this->errors[] = 'Please enter at least 6 characters for the Password';

        if (preg_match('/.*[a-z]+.*/i', $this->Password) == 0)
            $this->errors[] = 'Password needs at least one letter';

        if (preg_match('/.*\d+.*/i', $this->Password) == 0)
            $this->errors[] = 'Password needs at least one number';
        
    }

    public function send_activation_email()
    {
        //TODO
    }
}