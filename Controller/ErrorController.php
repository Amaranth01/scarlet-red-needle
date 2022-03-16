<?php

class ErrorController
{
    /**
     * Control the error page.
     * @param string $askPage
     * @return void
     */
    public function error404(string $askPage)
    {
        require __DIR__ . '/../View/error/404.html.php';
    }
}