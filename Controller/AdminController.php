<?php

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index()
    {

    }

    public function spaceAdmin()
    {
        if ($this->userConnected()) {
            $this->render('admin/space-admin');
        }
        else {
            $this->render('home/index');
        }
    }

}