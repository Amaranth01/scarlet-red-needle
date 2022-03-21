<?php

use App\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index()
    {

    }

    public function spaceAdmin()
    {
     $this->render('admin/space-admin');
     }

    public function addArticle()
    {
        $this->render('admin/add-article');
    }

    public function userList()
    {
        $this->render('admin/user-list');
    }

}