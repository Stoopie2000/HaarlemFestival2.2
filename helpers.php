<?php

if (!function_exists('dd')) {
    function dd(...$vars) {
        dump($vars);
        die();
    }
}

if (!function_exists('dump')) {
    function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $var) {
            print_r($var);
        }
        echo '<pre>';
    }
}
