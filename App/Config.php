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

    const URLROOT = '';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = '';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'hfteam6_DB';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'hfteam6_Group';

    /**
     * Database password
     * @var string
     */

    const DB_PASSWORD = 'tv5rMk4gL';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = false;

    /**
     * Secret key to be used in hashing
     * @var int
     */
    const SECRET_KEY = 42;
}
