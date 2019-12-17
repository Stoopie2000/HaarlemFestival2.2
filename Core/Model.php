<?php

namespace Core;

use PDO;
use App\Config;
use PDOException;
use PDOStatement;


/**
 * Class Model
 * @package Core
 * @author Bram Bos <brambos27@gmail.com>
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return PDO Existing PDO or if PDO doesnt exist yet a new PDO.
     * @author Bram Bos <brambos27@gmail.com>
     */
    protected static function get_pdo()
    {
        static $pdo = null;
        if ($pdo === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $pdo = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD, $options);
            } catch (PDOException $e) {
                //TODO Figure out a way to handle exceptions
                // PDOException($e->getMessage(), (int)$e->getCode());
                die("ERROR: Could not connect. " . $e->getMessage());
            }

            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $pdo;
    }

    /**
     * @param string $sql This must be a valid SQL statement for the target database server.
     * @param array $parameters An Array of parameters to complete the sql quarry. Parameters need to be in the same order as in the SQL statement. <br>
     *                          Example: $sql = INSERT INTO users(Email, Password) VALUES (?, ?) $parameters = [example@gmail.com, Welcome123]
     * @return bool TRUE on success or FALSE on failure.
     */
    protected static function execute_edit_query($sql, $parameters)
    {
        $pdo = self::get_pdo();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($parameters)) {
            unset($pdo);
            return true;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            unset($pdo);
            return false;
        }
    }

    /**
     * @param string $sql This must be a valid SQL statement for the target database server.
     * @param int $fetchMode The fetch mode must be one of the PDO::FETCH_* constants.
     * @param array $parameters An Array of parameters to complete the sql quarry. Parameters need to be in the same order as in the SQL statement. <br>
     *                          Example: $sql = SELECT * FROM users WHERE email = ? AND password = ? $parameters = [example@gmail.com, Welcome123]
     * @return bool|PDOStatement A PDOStatement if successful, FALSE if unsuccessful
     */
    protected static function execute_select_query($sql, $fetchMode = PDO::FETCH_ASSOC, $parameters = [])
    {
        $stmt = static::get_pdo()->prepare($sql);
        if ($fetchMode == 2){
            $stmt->setFetchMode($fetchMode);
        }else{
            $stmt->setFetchMode($fetchMode, get_called_class());
        }
        if ($stmt->execute($parameters)) {
            unset($pdo);
            return $stmt;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            unset($pdo);
            return false;
        }
    }
}
