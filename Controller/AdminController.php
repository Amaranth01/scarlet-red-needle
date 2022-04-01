<?php

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index()
    {

    }

    public function spaceAdmin()
    {
        if(self::redirectIfNotConnected()) {

        }
        else {
            $this->render('admin/space-admin');
        }

    }

    public function addArticle()
    {
        if(self::redirectIfNotConnected()) {
        }
        else {
            $this->render('admin/add-article');
        }

    }

    public function userList()
    {
        if(self::redirectIfNotConnected()) {
        }
        else {
            $this->render('admin/user-list');
        }

    }

}