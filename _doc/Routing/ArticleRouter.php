<?php

use App\Routing\AbstractRouter;

class ArticleRouter extends AbstractRouter {

    /**
     * @param string|null $action
     * @return void
     */
    public static function route(?string $action = null)
    {
        $errorController = new ErrorController();
        $controller = new ArticleController();

        //Redirects to 404-page if action is null
        if(null === $action) {
            $errorController->error404($action);
        }

        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'list-all-articles':
                $controller->listAllArticles();
                break;
            default:
                $errorController->error404($action);
        }
    }
}