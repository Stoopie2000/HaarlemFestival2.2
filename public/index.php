<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

/**  Add the routes
  *     Je hebt een Controller en een Action
  *     Zoals Jazz, Food, Home, winkelwagen zijn Controllers.
  *     Zoals een subpagina van een controller zoals een pagina met info over een restaurant of een artiest is een Action.
  *
  *     De $router->add() methode werkt als volgt:
  *     Als je een adress hebt als www.google.com/Jazz/Evolve dan is Jazz de controller en Evolve de Action.
  *     De add methode wordt dan $router->add('/Jazz/Evolve');
  *
  *     Maar stel je hebt geen Action
  *     Zoals www.google.com/Jazz
  *     Dan geef je met de Add methode zelf de controller en de action mee
  *     Dan word het $router->add('Jazz', ['controller' => 'Jazz', 'action' => 'index']); (Index is dus een Action voor de homepagina van het event Jazz)
  *
  *     Je kan ook variables mee geven in de URL als je dat wilt vraag het dan even.
  */
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('cms', ['controller' => 'CMS', 'action' => 'login']);
$router->add('cms/{action}/{event}', ['controller' => 'cms']);
$router->add('dance', ['controller' => 'Dance', 'action' => 'index']);
$router->add('dance/locations/{location}', ['controller' => 'dance', 'action' => 'locations']);
$router->add('dance/lineup/{artist}', ['controller' => 'dance', 'action' => 'lineup']);
$router->add('{controller}/{action}');

    
$router->dispatch($_SERVER['QUERY_STRING']);
