<?php

namespace Core;

use App\Config;
use Exception;

/**
 * Base controller
 *
 * PHP version 7.0
 */
abstract class Controller
{

    /**
     * Parameters from the matched route
     *
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array  $args Arguments passed to the method
     *
     * @return void
     * @throws Exception
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }

    /**
     * Redirect to a different page
     *
     * @param string $url The relative URL
     *
     * @return void
     */
    public function redirect($url)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }

    /**
     * Get the originally-requested page to return to after requiring login, or default to the homepage
     *
     * @return string
     */
    protected function get_return_to_page()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['return_to'])) {
            return $_SESSION['return_to'];
        } else {
            return '/';
        }
    }

    /**
     * @param $captchaResponse
     * @return bool TRUE on success FALSE otherwise
     */
    public function verify_captcha($captchaResponse)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['secret' => Config::CAPTCHA_SECRET, 'response' => $captchaResponse]);

        curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = json_decode(curl_exec($curl));

        curl_close($curl);

        return $result->success;
    }
}
