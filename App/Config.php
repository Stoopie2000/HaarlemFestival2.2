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
<<<<<<< HEAD
    const URLROOT = 'http://localhost:57575/HF2.2/public';
=======
    const URLROOT = 'http://localhost/HF2.2/public/';
>>>>>>> 7477465cdf2b1021953c1d46ac6bef06b6ac32c4

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'hfteam6.infhaarlem.nl';

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
    const SHOW_ERRORS = true;

    /**
     * Secret key to be used in hashing
     * @var int
     */
    const SECRET_KEY = 42;
}
