<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
use Phalcon\Mvc\Router;

// Create the router
$router = new Router();

$router->add("/mylogin",array("controller" => "login","action"=> "orglog"));
$router->add("/Mylogin",array("controller" => "login","action"=> "orglog"));

return $router;
