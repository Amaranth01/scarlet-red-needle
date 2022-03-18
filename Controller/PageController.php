<?php

use App\Controller\AbstractController;

class PageController extends AbstractController
{

    public function index()
    {
        $this->render('pages/adopt');
    }

    public function piercing()
    {
        $this->render('pages/piercing');
    }

    public function achievements()
    {
        $this->render('pages/achievements');
    }

    public function admin()
    {
        $this->render('admin/conn');

    }

}