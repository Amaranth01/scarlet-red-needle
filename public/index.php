<?php

use App\Routing\AbstractRouter;
use App\Routing\UserRouter;

require __DIR__ . '/../includes.php';

$page = isset($_GET['c']) ? AbstractRouter::clean($_GET['c']) : 'home';
$method = isset($_GET['a']) ? AbstractRouter::clean($_GET['a']) : 'index';

// Defining the right controller.
switch ($page) {
    case 'home':
        HomeRouter::route();
        break;
    case 'user':
        UserRouter::route($method);
        break;
    case 'article':
        ArticleRouter::route($method);
        break;
    case 'forms-user' :
        FormsRouter::route();
        break;
    default:
        (new ErrorController())->error404($page);
}