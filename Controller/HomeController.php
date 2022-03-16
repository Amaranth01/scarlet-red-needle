<?php

use App\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * redirected to homepage
     */
    public function index()
    {
        $this->render('home/index');
    }
}