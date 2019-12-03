<?php

namespace App;
/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    // ROOTURL de url van de root map
    // Change the ... to your folder name
    const URLROOT = 'http://localhost/HF2.2/public';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'your-database-host';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'your-database-name';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'your-database-user';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'your-database-password';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}
