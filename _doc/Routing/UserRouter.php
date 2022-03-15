<?php

namespace App\Routing;

use ErrorController;
use UserController;

class UserRouter extends AbstractRouter
{

    public static function route(?string $action = null)
    {
        $controller = new UserController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'show-user':
                self::routeWithParam($controller, 'showUser', ['id' => 'int']);
                break;
            case 'edit-user':
                self::routeWithParam($controller, 'editUser', ['id' => 'int', 'category' => 'string']);
                break;
            case 'delete-user':
                self::routeWithParam($controller, 'deleteUser', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }


}