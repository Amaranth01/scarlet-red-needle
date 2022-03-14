<?php

class HomeRouter
{
    /**
     * @return void
     */
    public static function route(?string $action = null)
    {
        (new HomeController())->index();
    }
}