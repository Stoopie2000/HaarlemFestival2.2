<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 5.6
 */
class Config
{

    // ROOTURL de url van de root map
    // Change the ... to your folder name

    const URLROOT = 'http://dev.school/';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = '127.0.0.1';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'haarlemfestival';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */

    const DB_PASSWORD = '';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * Secret key to be used in hashing
     * @var int
     */
    const SECRET_KEY = 42;
}
