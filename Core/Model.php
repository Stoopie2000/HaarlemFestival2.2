<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function get_pdo() : PDO
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

    protected static function execute_edit_query($sql, $parameters){
        $pdo = self::get_pdo();
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($parameters)){
            unset($pdo);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            unset($pdo);
        }
    }

    protected static function execute_select_query($sql, $fetchMode = PDO::FETCH_ASSOC, $parameters = [])
    {
        $stmt = static::get_pdo()->prepare($sql);
        $stmt->setFetchMode($fetchMode, get_called_class());
        if ($stmt->execute($parameters)){
            unset($pdo);
            return $stmt;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            unset($pdo);
            return false;
        }
    }
}
