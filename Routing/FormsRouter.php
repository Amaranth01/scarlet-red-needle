<?php

class FormsRouter
{
    /**
     * @return void
     */
    public static function route(?string $action = null)
    {
        (new FormsController())->index();
    }
}