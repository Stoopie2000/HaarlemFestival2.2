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
    const URLROOT = 'http://localhost';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'hfteam6_DB';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 's633931_Admin';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'Pret9999';

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
