<?php

namespace App;

/**
 * Unique random tokens
 *
 * PHP version 7.0
 */
class Token
{
    /**
     * The token value
     * @var array
     */
    protected $token;

    /**
     * Class constructor. Create a new random token or assign an existing one if passed in.
     *
     * @param null $token_value
     */
    public function __construct($token_value = null)
    {
        if ($token_value) {

            $this->token = $token_value;

        } else {

            $this->token = \StoPasswordReset::generateRandomBase62String(128)(); // generate a token, should be 128 - 256 bit

        }
    }

    /**
     * Get the token value
     *
     * @return string The value
     */
    public function getValue()
    {
        return $this->token;
    }
}
