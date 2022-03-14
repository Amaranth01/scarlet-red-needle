<?php

namespace App\Routing;

use AbstractController;
use ErrorController;

abstract class AbstractRouter
{

    /**
     * Initialization of an abstract function for the router
     * @return mixed
     */
    abstract public static function route(?string $action = null);

    /**
     * Remove insecure elements from URL
     * @param string|null $param
     * @return string|null
     */
    public static function clean(?string $param): ?string
    {
        $param = strip_tags($param);
        $param = trim($param);

        return strtolower($param);
    }

    public static function routeWithParam(AbstractController $controller, string $method, array $params): void
    {
        $arguments = [];
        foreach ($params as $item => $type) {
            //Returns an error message if a parameter is missing
            if(!isset($_GET[$item])) {
                (new ErrorController())->missingParameters();
                return;
            }

            $args = self::clean($_GET[$item]);
            //Returns true on success or false on failure.
            settype($arg, $type);
            $arguments[] = $args;
        }
        $controller->$method(...$arguments);
    }
}