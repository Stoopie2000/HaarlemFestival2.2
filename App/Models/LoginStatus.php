<?php

namespace Model;

abstract class LoginStatus
{
    const __default = self::NO_SUCCESS;

    const SUCCESS = 1;
    const NO_USER = 2;
    const WRONG_PASS = 3;
    const NO_SUCCESS = 4;
}