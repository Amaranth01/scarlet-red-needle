<?php

namespace App;

use App\Controller\AbstractController;
use ErrorController;

class Router
{
    /**
     * Getting parameters from $_GET
     * @param string $key
     * @param null $default
     * @return string|null
     */
    private static function param(string $key, $default = null): ?string
    {
        if(isset($_GET[$key])) {
            return filter_var($_GET[$key], FILTER_SANITIZE_STRING);
        }
        return $default;
    }

    /**
     *Avoid errors in URL parameters
     * @param AbstractController $controller
     * @param string|null $action
     * @return string|null
     */
    private static function guessMethod(AbstractController $controller, ?string $action)
    {
        if (strpos($action, '-') !== -1) {
            $action = array_reduce(explode('-', $action), function ($ac, $a) {
                return $ac . ucfirst($a);
            });
        }

        $action = lcfirst($action);
        if(method_exists($controller, $action)) {
          return $action;
        }

        return null;
    }

    /**
     * Check that the controllers are correct, if not, redirect to a 404 page.
     * @param string $controller
     * @return ErrorController|mixed
     */
    private static function guessController(string $controller)
    {
        $controller = ucfirst($controller) . 'Controller';
        if (class_exists($controller)) {
            return new $controller();
        }
        var_dump($controller);
        return new ErrorController();

    }

    /**
     * Brings together all the functions of the router
     */
    public static function route()
    {
        //Initialize the 'c' parameter
        $paramController = self::param('c', 'home');
        $action = self::param('a');
        $controller = self::guessController($paramController);

        //Returns the 404 page if the controller is not found, and we quit the script
        if($controller instanceof ErrorController) {
            $controller->error404($paramController);
            exit();
        }

        //Verification of the presence of controller
        $action = self::guessMethod($controller, $action);
        null === $action ? $controller->index() : $controller->$action();
    }
}